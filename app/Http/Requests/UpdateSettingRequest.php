<?php
use Illuminate\Http\Request;
namespace App\Http\Requests;
use Auth;
use App\Http\Requests\Request;

class UpdateSettingRequest extends Request {

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
            'first_name'=>'required|max:50' ,
			'last_name'=>'required|max:50' ,
			'email'=>'required|unique:users,email,'. Auth::user()->id,
			'age'=>'required',
                         'dob'=>'required|before:today',
                        'phone'=>'required|min:10',
			'address1'=>'required',
			'address2'=>'required',
			 'profile_pic' => 'mimes:jpg,png,jpeg,gif,PNG,JPG,JPEG,GIF', 
            
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
