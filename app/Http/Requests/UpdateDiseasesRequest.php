<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateDiseasesRequest extends Request {

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
            'disease_name' => 'required|unique:diseases,disease_name,'. Request::segment(3),  
            
		];
	}
	public function messages()
	{
		return [
			'disease_name.unique'              =>  'The disease name has already been taken.',
		];
	}
}
