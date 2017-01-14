<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Feedback;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\DiseasesArticle;
use App\User;
use App\Reason;
use DB;


class FeedbackController extends Controller {

	/**
	 * Display a listing of feedback
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
    //with("diseasesarticle")->
        $feedback = Feedback::with("user")->with("reason")->get();

		return view('admin.feedback.index', compact('feedback'));
	}
	
	/**
	 * Show the form for creating a new feedback
	 *
     * @return \Illuminate\View\View
	 */
	

	/**
	 * Store a newly created feedback in storage.
	 *
     * @param CreateFeedbackRequest|Request $request
	 */
	

	/**
	 * Show the form for editing the specified feedback.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	

	/**
	 * Update the specified feedback in storage.
     * @param UpdateFeedbackRequest|Request $request
     *
	 * @param  int  $id
	 */
	
	/**
	 * Remove the specified feedback from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Feedback::destroy($id);

		return redirect()->route('admin.feedback.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
	public function getExcel_download()
	{
		/*$users = History::select('id','user_id as User ID','name' ,'seach_keyword as Search Keyword', 'created_date as Date')
		->with("user_name")->get();
		/*$users = DB::table('numa_search_history')
            ->join('users', 'numa_search_history.user_id', '=', 'users.id')
            ->select('numa_search_history.id','user_id as User ID','users.name','numa_search_history.seach_keyword as Search Keyword', 'numa_search_history.created_date as Date')
            ->get();*/
		Excel::create('Feedback Details', function($excel) 	 {
			$excel->sheet('Sheet 1', function($sheet)  {
			$users = DB::table('feedback')
            ->leftJoin('users', 'feedback.user_id', '=', 'users.id')
            ->select('feedback.*','users.name')
            ->get();
				
				
				$arr =array();
				$i=1;
                foreach($users as $employee) {
					if($employee->type=='blog')
							{
								$detail = DB::table('blog')
								->select('blog_name')
								->where('id', '=',$employee->diseasesarticle_id)
								->get();
								$name= $detail[0]->blog_name;
							}else{
								$detail = DB::table('diseasesarticle')
								->select('article_title')
								->where('id', '=',$employee->diseasesarticle_id)
								->get();
								$name=$detail[0]->article_title;
						}
					//print_r($diseasesarticle); 
					$reason = DB::table('reason')
					->select('reason.reason')
					->where('id', '=',$employee->reason_id)
					->get();
                        $data =  array($i,$name,$employee->type,$employee->name,$employee->feedback,@$reason[0]->reason,$employee->reasons,date('d M Y h:iA',strtotime($employee->created_at)));
                        array_push($arr, $data);
                    $i++;
                }
			$sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                       'ID','Article','Type','User Name', 'Feedback', 'Reason', 'Comment', 'Date')

                );
			});
			})->export('xls');
	}
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Feedback::destroy($toDelete);
        } else {
            Feedback::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.feedback.index');
    }

}
