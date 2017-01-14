<?php
use Illuminate\Http\Request;
namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateSymptomRequest extends Request {

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
            'symptom_name' => 'required|unique:symptom,symptom_name,'. Request::segment(3),
			'search_keyword'=>'required',
            
		];
	}
	public function messages()
	{
		return [
			'symptom_name.unique'              =>  'The symptom name has already been taken.',
		];
	}
}
