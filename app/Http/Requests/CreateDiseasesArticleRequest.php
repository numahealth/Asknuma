<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateDiseasesArticleRequest extends Request {

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
            'diseases_id' => 'required', 
            'article_title' => 'required', 
            'meta_title' => 'required', 
            
		];
	}
}
