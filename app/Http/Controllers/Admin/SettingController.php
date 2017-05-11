<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\PasswordSettingRequest;
use Illuminate\Mail\Mailer;
use Auth;
use Mail;

class SettingController extends Controller {

    public function view() {
        $main_message = Auth::user();
        $status = User::$status;
        $gender = User::$gender;
        $user = User::findOrFail(Auth::user()->id);
        $roles = Role::lists('title', 'id');
        $location = DB::table('numa_user_locations')->where('user_id', '=', Auth::user()->id)->get();
        return view('admin.userssetting.view2', compact('user', 'roles', 'location', 'status', 'gender', 'main_message'))->with('location', $location);
    }

    /**
     * Show a user edit page
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit() {
        $main_message = Auth::user();
        $status = User::$status;
        $gender = User::$gender;
        $user = User::findOrFail(Auth::user()->id);
        $roles = Role::lists('title', 'id');
        $location = DB::table('numa_user_locations')->where('user_id', '=', Auth::user()->id)->get();
        return view('admin.userssetting.edit', compact('user', 'roles', 'location', 'status', 'gender', 'main_message'))->with('location', $location);
    }

    public function reset_password() {
        $main_message = Auth::user();
        $status = User::$status;
        $gender = User::$gender;
        $user = User::findOrFail(Auth::user()->id);
        $roles = Role::lists('title', 'id');
        $location = DB::table('numa_user_locations')->where('user_id', '=', Auth::user()->id)->get();
        return view('admin.userssetting.reset_password', compact('user', 'roles', 'location', 'status', 'gender', 'main_message'))->with('location', $location);
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
    public function update(UpdateSettingRequest $request) {
        $user = User::findOrFail(Auth::user()->id);
        $request = $this->saveFiles($request);
        $input = $request->all();
        //print_r($input); die;
        $input['name'] = $input['first_name'] . ' ' . $input['last_name'];

        $user->update($input);
        if ($input['locaton_check'] !== '') {
            DB::table('numa_user_locations')
                    ->where('user_id', Auth::user()->id)
                    ->update(['country' => $input['country'], 'address1' => $input['address1'], 'address2' => $input['address2'], 'lat' => $input['lat'], 'long' => $input['long'],
                        'updated_by' => $input['updated_by'], 'updated_at' => date('Y-m-d H:i:s')]);
        } else {
            DB::table('numa_user_locations')->insert(
                    ['country' => $input['country'], 'address1' => $input['address1'], 'address2' => $input['address2'], 'lat' => $input['lat'], 'long' => $input['long'],
                        'updated_by' => $input['updated_by'], 'created_by' => $input['updated_by'], 'user_id' => Auth::user()->id, 'created_at' => date('Y-m-d H:i:s')]
            );
        }
        return redirect()->back()->withMessage(trans('quickadmin::admin.users-controller-successfully_updated'));
    }

    public function pass_update(PasswordSettingRequest $request) {
        $user = User::findOrFail(Auth::user()->id);
        $input = $request->all();  // 
        if (Hash::check($input['current_password'], $user->password)) {
            $input['password'] = Hash::make($input['password']);
            $user->update($input);
            return redirect()->back()->withMessage('Password successfully updated.');
        }
        return redirect()->back()->withErrors('The current password supplied is incorrect.');
    }

    public function update_password($id) {

        $user_d = User::find($id);
        $email = $user_d->email;
        $input['password'] = Hash::make('anshulbhardwaj');
        /* Mail::send('admin.users.view', ['user_detail' => array('username'=>$user_d->email,'password'=>'anshulbhardwaj')], function ($message) use ($user_d)
          {
          $message->from('anshul@unyscape.com', 'Asknuma : Password Reset Mail');

          $message->to($user_d->email)->subject('Asknuma : Password Reset Mail');

          }); */

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

    public function removeAccount(Request $request) {
        $deleteData = $request->get('delete_data');
        //$reason = $request->get('reason');
        //$message = $request->get('message');
        $data_status = "intact";
        if ($deleteData == 'Yes') {
            // this database operation to be removed 
            DB::table('users')->where('id', Auth::user()->id)->update(
                    ['status' => 3, 'subscribed' => FALSE, 'flag' => FALSE]
            );
            //User::destroy(Auth::user()->id);
            $data_status = "deleted";
        } else {
            DB::table('users')->where('id', Auth::user()->id)->update(
                    ['status' => 3, 'subscribed' => FALSE, 'flag' => FALSE]
            );
        }

        $blackList = array(
            'localhost',
            '127.0.0.1',
            '::1'
        );

        if (!in_array($_SERVER['REMOTE_ADDR'], $blackList)) {
            Mail::send('admin.users.reply_acct_cancel', ['user' =>
                array(
                    'name' => Auth::user()->name,
                    'date_subscribed' => Auth::user()->date_subscribed,
                    'delete_data' => $deleteData
                )], function ($message) {
                $message->from('info@numa.io', 'Numa Health');
                $message->to(Auth::user()->email)->subject("Your Numa Subscription Cancellation!");
            });
        }

        Auth::logout();
        echo $data_status;
        //return redirect()->route('/')->withMessage(trans('quickadmin::admin.users-controller-successfully_deleted'));
    }

}
