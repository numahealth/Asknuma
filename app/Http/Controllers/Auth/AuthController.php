<?php

namespace App\Http\Controllers\Auth;

use App\User;
use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Mail\Mailer;
use Twilio;
use Mail;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    protected $redirectAfterLogout = 'login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->redirectAfterLogout = config('quickadmin.homeRoute');
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'first_name' => 'required|max:50',
                    'last_name' => 'required|max:50',
                    'phone' => 'required',
                    'email' => 'required|email|max:100|unique:users',
                    'age' => 'required|max:999|min:1',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data) {
        $password = rand(150000, 150000000);
        $number = '+' . $data['phone_code'] . '' . $data['phone'];
        $message = 'Hello ' . $data['first_name'] . ', your username is : ' . $data['email'] . '.  Password : ' . $password . '. Login and change it now at https://asknuma.com/asknuma';
        ///Twilio::message($number,$message);
//        Twilio::message($number, $message);
//        Mail::send('admin.users.view', ['user_detail' => array('name' => $data['first_name'], 'username' => $data['email'], 'password' => $password)], function ($message) use ($data) {
//            $message->from('info@numa.io', 'Numa Health');
//
//            $message->to($data['email'])->subject('Welcome to your AskNuma account!');
//        });
        $apikey = '8954af9a4315019f1d0f8082f8925744-us9';
        $auth = base64_encode('user:' . $apikey);

        $datas = array(
            'apikey' => $apikey,
            'email_address' => $data['email'],
            'status' => 'subscribed',
            'merge_fields' => array(
                'FNAME' => $data['first_name'] . ' ' . $data['last_name']
            )
        );
        $json_data = json_encode($datas);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://us9.api.mailchimp.com/3.0/lists/d29163d261/members/');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Basic ' . $auth));
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        $result = curl_exec($ch);
        return User::create([
                    'name' => $data['first_name'] . ' ' . $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'phone_code' => $data['phone_code'],
                    'age' => $data['age'],
                    'role_id' => 2,
                    'password' => Hash::make($password),
                    'gender' => $data['gender']
        ]);
    }

    public function sign_register(Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect('/signup')
                            ->withErrors($validator, 'signup')
                            ->withInput();
        }
        $this->signup($request->all());
        // Auth::guard($this->getGuard())->login($this->create($request->all()));
        return redirect()->back()->withMessage('You’re awesome! Please check your email inbox in the next few minutes & follow the instructions to verify your account');
    }

    protected function signup(array $data) {
        $password = rand(150000, 150000000);
        $number = '+' . $data['phone_code'] . '' . $data['phone'];
        $message = 'Hello ' . $data['first_name'] . ', your username is : ' . $data['email'] . '.  Password : ' . $password . '. Login and change it now at https://asknuma.com/asknuma';
        ///Twilio::message($number,$message);
        Twilio::message($number, $message);
        Mail::send('admin.users.view', ['user_detail' => array('name' => $data['first_name'], 'username' => $data['email'], 'password' => $password)], function ($message) use ($data) {
            $message->from('info@numa.io', 'Numa Health');

            $message->to($data['email'])->subject('Welcome to your AskNuma account!');
        });
        $apikey = '8954af9a4315019f1d0f8082f8925744-us9';
        $auth = base64_encode('user:' . $apikey);

        $datas = array(
            'apikey' => $apikey,
            'email_address' => $data['email'],
            'status' => 'subscribed',
            'merge_fields' => array(
                'FNAME' => $data['first_name'] . ' ' . $data['last_name']
            )
        );
        $json_data = json_encode($datas);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://us9.api.mailchimp.com/3.0/lists/d29163d261/members/');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
            'Authorization: Basic ' . $auth));
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        $result = curl_exec($ch);
        return User::create([
                    'name' => $data['first_name'] . ' ' . $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'phone_code' => $data['phone_code'],
                    'age' => $data['age'],
                    'role_id' => 2,
                    'password' => Hash::make($password),
                    'gender' => $data['gender']
        ]);
    }

    public function postLogin(Request $request) {
        //pass through validation rules
        //$this->validate($request, ['email' => 'required', 'password' => 'required']);
        $val = Validator::make($request->all(), ['email' => 'required', 'password' => 'required']);
        if ($val->fails()) {

            return redirect('/')
                            ->withErrors($val, 'login')
                            ->withInput();
        }

        $credentials = [
            'email' => trim($request->get('email')),
            'password' => trim($request->get('password'))
        ];

        $credentials = $request->only('email', 'password');
        //echo $this->redirectPath(); die;
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->role_id == 1) {
                return redirect()->route('users.index');
            } else {
                $direction = $_SERVER['HTTP_REFERER'];
                if ($direction == 'https://asknuma.com/asknuma/login' || $direction == 'https://asknuma.com/asknuma/') {
                    return redirect('admin/usermessage');
                } else {
                    return redirect()->back();
                }

                //
            }
        }

        return redirect('/')
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            'login' => $this->getFailedLoginMessage(),
                                ], 'login');

        //log in the user
    }

    public function postSignin(Request $request) {
        //pass through validation rules
        //$this->validate($request, ['email' => 'required', 'password' => 'required']);
        $val = Validator::make($request->all(), ['email' => 'required', 'password' => 'required']);
        if ($val->fails()) {

            return redirect('/signin')
                            ->withErrors($val, 'logins')
                            ->withInput();
        }

        $credentials = [
            'email' => trim($request->get('email')),
            'password' => trim($request->get('password'))
        ];

        $credentials = $request->only('email', 'password');
        //echo $this->redirectPath(); die;
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->role_id == 1) {
                return redirect()->route('users.index');
            } else {

                return redirect('admin/usermessage');


                //
            }
        }

        return redirect('/signin')
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            'logins' => $this->getFailedLoginMessage(),
                                ], 'logins');

        //log in the user
    }

    public function postForget(Request $request) {

        $val = Validator::make($request->all(), ['email' => 'required|email']);
        if ($val->fails()) {
            return redirect('/forget')
                            ->withErrors($val)
                            ->withInput();
        }
        $users = DB::table('users')
                ->select('users.id')
                ->where('users.email', '=', $request->all()['email'])
                ->get();
        if (empty($users)) {
            return redirect('/forget')
                            ->withErrors(['email' => 'Email does not exist.'])
                            ->withInput();
        }
        $id = @$users[0]->id;
        $user_d = User::find($id);
        $email = $user_d->email;
        $password = rand(150000, 15000000);
        $input['password'] = Hash::make($password);
        Mail::send('admin.users.view_forget', ['user_detail' => array('name' => $user_d->name, 'username' => $user_d->email, 'password' => $password)], function ($message) use ($user_d) {
            $message->from('anshul@unyscape.com', 'Asknuma : Forgot Password');

            $message->to($user_d->email)->subject('Asknuma :Forgot Password');
        });

        $user = User::findOrFail($id);

        $user->update($input);
        return redirect('forget')->withMessage('Email sent.');
    }

}
