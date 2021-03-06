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
use Illuminate\Support\Facades\Log;
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

use AuthenticatesAndRegistersUsers;

use ThrottlesLogins;

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
        $message = 'Hello ' . $data['first_name'] . ', your username is : ' . $data['email'] . '.  Password : ' . $password 
                . '. Login and change it now at ' . url('/');

        $user = User::create([
                    'name' => $data['first_name'] . ' ' . $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'phone_code' => $data['phone_code'],
                    'age' => $data['age'],
                    'role_id' => 2,
                    'password' => Hash::make($password),
                    'gender' => $data['gender']
        ]);

        $blackList = array(
            'localhost',
            '127.0.0.1',
            '::1'
        );

        if (!in_array($_SERVER['REMOTE_ADDR'], $blackList)) {
            try {
                Twilio::message($number, $message);
                Mail::send('admin.users.view', ['user_detail' =>
                    array('name' => $data['first_name'], 'username' => $data['email'], 
                        'password' => $password)], function ($message) use ($data) {
                    $message->from('info@numa.io', 'Numa Health');

                    $message->to($data['email'])->subject('Welcome to your Numa account');
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
            } catch (Exception $exc) {
                //echo $exc->getTraceAsString();
            } catch (ErrorException $exc) {
                //echo $exc->getTraceAsString();
            }
        }
        return $user;
    }

    public function sign_register(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect('/signup')
                            ->withErrors($validator, 'signup')
                            ->withInput();
        }
        //$this->signup($request->all());
        Auth::guard($this->getGuard())->login($this->create($request->all()));
        if (Auth::user()->subscribed == TRUE) {
            return redirect('admin/setting');
        } else {
            return redirect('subscriptions');
        }
        
    }
    
    public function postRegister(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect('/signup')
                            ->withErrors($validator, 'signup')
                            ->withInput();
        }
        $this->signup($request->all());
        //Auth::guard($this->getGuard())->login($this->create($request->all()));
//        if (Auth::user()->subscribed == TRUE) {
//            return redirect('admin/setting');
//        } else {
//            return redirect('subscriptions');
//        }
        $request->session()->put('click', 1);
        return redirect()->back()->withMessage('You’re awesome! Please check your email inbox in the next few minutes & follow the instructions to verify your account');
    }
    

    protected function signup(array $data) {
        $password = rand(150000, 150000000);
        $number = '+' . $data['phone_code'] . '' . $data['phone'];
        $message = 'Hello ' . $data['first_name'] . ', your username is : ' . $data['email'] 
                . '.  Password : ' . $password 
                . '. Login and change it now at ' . url('/');
        
        $user = User::create([
                    'name' => $data['first_name'] . ' ' . $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'phone_code' => $data['phone_code'],
                    'age' => $data['age'],
                    'role_id' => 2,
                    'password' => Hash::make($password),
                    'gender' => $data['gender']
        ]);

        $blackList = array(
            'localhost',
            '127.0.0.1',
            '::1'
        );

        if (!in_array($_SERVER['REMOTE_ADDR'], $blackList)) {
            try {
                Twilio::message($number, $message);
                Mail::send('admin.users.view', ['user_detail' => array('name' => $data['first_name'],
                        'username' => $data['email'], 'password' => $password)], function ($message) use ($data) {
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
            } catch (Exception $exc) {
                //echo $exc->getTraceAsString();
            } catch (ErrorException $exc) {
                //echo $exc->getTraceAsString();
            }
        }
        return $user;
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

                if (Auth::user()->subscribed == TRUE) {
                    return redirect('admin/setting');
                } else {
                    return redirect('subscriptions');
                }
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

                if (Auth::user()->subscribed == TRUE) {
                    return redirect('admin/setting');
                } else {
                    return redirect('subscriptions');
                }
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
        Mail::send('admin.users.view_forget', ['user_detail' => array('name' => $user_d->name, 
            'username' => $user_d->email, 'password' => $password)], function ($message) use ($user_d) {
            $message->from('info@numa.io', 'Numa Password Recovery');

            $message->to($user_d->email)->subject('Numa Password Reset Request');
        });

        $user = User::findOrFail($id);

        $user->update($input);
        return redirect('forget')->withMessage('Password reset link has been sent to your email.'
                . ' Please check your Spam folder if it does not show up in your Inbox in 5 mins. '
                . ' Thank you!');
    }

    public function loginWithFacebook() {

//        $values = array();
//        $symptom = DB::table('country_code')->get();
//        if (!empty($symptom)) {
//            foreach ($symptom as $records) {
//                $values[$records->phonecode] = $records->nicename . ' +' . $records->phonecode;
//            }
//        }

        $id = $_POST['id'];
        $email = $_POST['email'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $age = $_POST['age'];
        $country = $_POST['country'];
        $raw = json_encode($_POST['raw']);

        Log::info($raw->first_name);
    }

}
