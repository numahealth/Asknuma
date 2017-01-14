<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Students;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class Student extends Controller
{
    Public function getForm(){
		return view('student.form');
	}
	public function store(Request $data){
		$validation = Validator::make($data->all(), array(
		'first_name' =>'required| min:3|max:10',
		'last_name' =>'required| min:3|max:10',
		'address' =>'required| min:3|max:500',
		));
		if($validation->fails()){
			return Redirect::to('form')->withErrors($validation);
		}else{
			$table = new students;
			$table->first_name = $data->Input('first_name');
			$table->last_name = $data->Input('last_name');
			$table->address = $data->Input('address');
			$table->save();
			//return Redirect::to('form')->with('message', 'data has been submitted successfully');
			return redirect('form')->with('message', 'New student added successfully.')->with('message-type', 'success');
		}
	}
}
