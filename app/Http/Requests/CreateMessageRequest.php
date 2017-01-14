<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateMessageRequest extends Request {

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
            'message' => 'required_without_all:profile_pic,embedded',   
            'profile_pic' => 'required_without_all:message,embedded|mimes:jpg,png,gif,jpeg', 
            'embedded'=>'required_without_all:message,profile_pic', 
		];
	}
        public function messages()
	{
		return [
			'required_without_all'  =>  'Either Message field is required or attachment.',
			'profile_pic.mimes'  =>  'Only jpg, png, jpeg, gif image format required.',
                        
		];
	}
}
