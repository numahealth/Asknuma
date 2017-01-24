<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Mail\Mailer;
use Mail;
use Twilio;

class UsersController extends Controller {

    /**
     * Show a list of users
     * @return \Illuminate\View\View
     */
    public function index() {
        //$users = User::all();
        //$users = DB::table('users')->get();
        //Twilio::message('+919810488993', "hello");				
        $users = DB::table('users')
                ->leftJoin('numa_search_history', 'users.id', '=', 'numa_search_history.user_id')
                ->select('users.*', 'numa_search_history.seach_keyword', 'numa_search_history.created_date as data')
                ->where('users.role_id', '!=', 1)
                ->orderBy('numa_search_history.created_date', 'desc')
                ->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show a page of user creation
     * @return \Illuminate\View\View
     */
    public function create() {
        $status = User::$status;
        $gender = User::$gender;
        $roles = Role::lists('title', 'id');

        return view('admin.users.create', compact('roles', 'status', 'gender'));
    }

    /**
     * Insert new user into the system
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request) {
        $request = $this->saveFiles($request);
        $input = $request->all();
        $password = rand(150000, 150000000);
        $input['password'] = Hash::make($password);
        $user = User::create($input);
        Mail::send('admin.users.view', ['user_detail' => array('name' => $input['name'], 'username' => $input['email'], 'password' => $password)], function ($message) use ($input) {
            $message->from('info@numa.io', 'Numa Health');
            $message->to($input['email'])->subject('Welcome to your AskNuma account!');
        });
        DB::table('numa_user_locations')->insert(
                ['country' => $input['country'], 'address1' => $input['address1'], 'address2' => $input['address2'], 'lat' => $input['lat'], 'long' => $input['long'],
                    'updated_by' => $input['updated_by'], 'created_by' => $input['updated_by'], 'user_id' => $user->id, 'created_at' => date('Y-m-d H:i:s')]
        );
        return redirect()->route('users.index')->withMessage(trans('quickadmin::admin.users-controller-successfully_created'));
    }

    /**
     * Show a user edit page
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $status = User::$status;
        $gender = User::$gender;
        $user = User::findOrFail($id);
        $roles = Role::lists('title', 'id');
        $location = DB::table('numa_user_locations')->where('user_id', '=', $id)->get();
        return view('admin.users.edit', compact('user', 'roles', 'location', 'status', 'gender'))->with('location', $location);
        ;
    }

    public function views($id) {
        $status = User::$status;
        $gender = User::$gender;
        $user = User::findOrFail($id);
        $roles = Role::lists('title', 'id');
        $location = DB::table('numa_user_locations')->where('user_id', '=', $id)->get();
        return view('admin.users.view1', compact('user', 'roles', 'location', 'status', 'gender'))->with('location', $location);
        ;
    }

    /**
     * Update our user information
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, $id) {
        $user = User::findOrFail($id);
        $request = $this->saveFiles($request);
        $input = $request->all();
        //print_r($input); die;
        // $input['password'] = Hash::make($input['password']);
        $user->update($input);
        if ($input['locaton_check'] !== '') {
            DB::table('numa_user_locations')
                    ->where('user_id', $id)
                    ->update(['country' => $input['country'], 'address1' => $input['address1'], 'address2' => $input['address2'], 'lat' => $input['lat'], 'long' => $input['long'],
                        'updated_by' => $input['updated_by'], 'updated_at' => date('Y-m-d H:i:s')]);
        } else {
            DB::table('numa_user_locations')->insert(
                    ['country' => $input['country'], 'address1' => $input['address1'], 'address2' => $input['address2'], 'lat' => $input['lat'], 'long' => $input['long'],
                        'updated_by' => $input['updated_by'], 'created_by' => $input['updated_by'], 'user_id' => $id, 'created_at' => date('Y-m-d H:i:s')]
            );
        }
        return redirect()->route('users.index')->withMessage(trans('quickadmin::admin.users-controller-successfully_updated'));
    }

    public function update_password($id) {

        $user_d = User::find($id);
        $email = $user_d->email;
        $password = rand(150000, 15000000);
        $input['password'] = Hash::make($password);
        Mail::send('admin.users.reset', ['user_detail' => array('name' => $user_d->name, 'username' => $user_d->email, 'password' => $password)], function ($message) use ($user_d) {
            $message->from('info@numa.io', 'Numa Health');
            $message->to($user_d->email)->subject('Numa Health : Password Reset Mail');
        });
        $user = User::findOrFail($id);
        $user->update($input);
        return redirect()->route('users.index')->withMessage('Password is Reset Succesfully and an email is sent to user .');
    }

    /**
     * Destroy specific user
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) {
        $user = User::findOrFail($id);
        User::destroy($id);

        return redirect()->route('users.index')->withMessage(trans('quickadmin::admin.users-controller-successfully_deleted'));
    }

}
