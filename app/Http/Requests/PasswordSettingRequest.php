<?php
use Illuminate\Http\Request;
namespace App\Http\Requests;
use Auth;
use App\Http\Requests\Request;

class PasswordSettingRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
	$d=mktime(1,1,1,01, 01, 2015);
		return [
            'password'=>'required' ,
             'confirm_password'  =>  'required|same:password',
		];
	}
	public function messages()
	{
		return [
			'email.unique'              =>  'Oops! Email Id already exits.',
			'address2.required'=>'Town/City is required.',
			'dob.required'=>'Date Of Birth is required.'
		];
	}
}
