<?php
use Illuminate\Http\Request;
namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request {

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
		return [
            'name' => 'required', 
			'email'=>'required|unique:users,email,'. Request::segment(2),
			'age'=>'required',
			'phone'=>'required',
                         'dob'=>'required|before:today',
			'address1'=>'required',
			'address2'=>'required',
			 'profile_pic' => 'mimes:jpg,png,jpeg,gif,PNG,JPG,JPEG,GIF',
            
		];
	}
	public function messages()
	{
		return [
			'email.unique'              =>  'Email Id already exits.',
			'profile_pic.mimes'  =>  'Only jpg, png, gif image format required.',
			'address2.required'=>'Town/City is required.',
		];
	}
}
