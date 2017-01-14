<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use DB;
use App\Test;
use App\Http\Requests\CreateTestRequest;
use App\Http\Requests\UpdateTestRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
USE Session;

class WelcomeController extends Controller {

	 public function postSearch(Request $request)
		{
			$request->session()->put('key', $request->all()['dieases']);
			return redirect('/search_result')->with('id_search', $request->all()['dieases']);
		}
	 public function postQuestion(Request $request)
	 {
		 $user_id=Auth::user()->id;
		 $exist_user= DB::table('numa_message_user')
			->select('id')
			->where('user', '=',$user_id)
            ->get();
			if(empty($exist_user))
			{
				DB::table('numa_message_user')->insert(
				['user'=>$user_id,'admin'=>1,'status'=>'Active']
				);
			}
			DB::table('numa_message')->insert(
				['diseases_article_id'=>$_POST['article_id'],'user_id'=>$user_id,'user_to'=>1,'age'=>$_POST['age'],'message' => $_POST['comment'],'gender' => $_POST['gender'],'created_at'=>date('Y-m-d H:i:s')]
				);
			echo "done";
		 
	 }
	 public function postBookmark(Request $request)
	 {
		 $user_id=Auth::user()->id;
		 $exist_user= DB::table('numa_bookmark')
			->select('id')
			->where('user_id', '=',$user_id)
			->where('diseases_article_id', '=',$_POST['article_id'])
            ->get();
			if(empty($exist_user))
			{
				DB::table('numa_bookmark')->insert(
				['user_id'=>$user_id,'diseases_article_id'=>$_POST['article_id'],'status'=>$_POST['status']]
				);
			}else{
				DB::table('numa_bookmark')
				->where('user_id', '=',$user_id)
				->where('diseases_article_id', '=',$_POST['article_id'])
				->update(['status'=>$_POST['status']]);
			}
	}
	 public function postYes_no(Request $request)
		{
			if (Auth::check())
			{
				$user_id=Auth::user()->id; 
			}
			else
			{
				ECHO  $user_id =Session::getId(); 
			}
			$feedback= DB::table('feedback')
			->select('id')
			->where('diseasesarticle_id', '=',$_POST['id'])
			->where('user_id', '=',$user_id)
            ->get();
			if(!empty($feedback))
			{
				if($_POST['message']=='Yes')
				{
					$reason_id='';
					$reasons='';
				}else{
						$reason_id=$_POST['reason_id'];
					$reasons=$_POST['reasons'];
				}
				DB::table('feedback')
				->where('diseasesarticle_id', $_POST['id'])
				->where('user_id', $user_id)
				->update(['feedback' => $_POST['message'],'reason_id' => $reason_id,'reasons' => $reasons,'updated_at'=>date('Y-m-d H:i:s')]);
			}
			else
			{
				if($_POST['message']=='Yes')
				{
					$reason_id='';
					$reasons='';
				}else{
					$reason_id=$_POST['reason_id'];
					$reasons=$_POST['reasons'];
				}
				DB::table('feedback')->insert(
				['status'=>'Active','user_id'=>$user_id,'diseasesarticle_id'=>$_POST['id'],'feedback' => $_POST['message'],'reason_id' => $reason_id,'reasons' => $reasons,'created_at'=>date('Y-m-d H:i:s')]
				);
			}

		}
}
