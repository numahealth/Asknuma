<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use DB;
use App\History;
use App\Http\Requests\CreateHistoryRequest;
use App\Http\Requests\UpdateHistoryRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
class HistoryController extends Controller {

	/**
	 * Display a listing of history
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $history = History::all();

		return view('admin.history.index', compact('history'));
	}

	/**
	 * Show the form for creating a new history
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.history.create');
	}

	/**
	 * Store a newly created history in storage.
	 *
     * @param CreateHistoryRequest|Request $request
	 */
	public function store(CreateHistoryRequest $request)
	{
	    
		History::create($request->all());

		return redirect()->route('admin.history.index');
	}

	/**
	 * Show the form for editing the specified history.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$history = History::find($id);
	    
	    
		return view('admin.history.edit', compact('history'));
	}

	/**
	 * Update the specified history in storage.
     * @param UpdateHistoryRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateHistoryRequest $request)
	{
		$history = History::findOrFail($id);

        

		$history->update($request->all());

		return redirect()->route('admin.history.index');
	}

	/**
	 * Remove the specified history from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		History::destroy($id);

		return redirect()->route('admin.history.index');
	}
	public function getExcel_download()
	{
		/*$users = History::select('id','user_id as User ID','name' ,'seach_keyword as Search Keyword', 'created_date as Date')
		->with("user_name")->get();
		/*$users = DB::table('numa_search_history')
            ->join('users', 'numa_search_history.user_id', '=', 'users.id')
            ->select('numa_search_history.id','user_id as User ID','users.name','numa_search_history.seach_keyword as Search Keyword', 'numa_search_history.created_date as Date')
            ->get();*/
		Excel::create('History Details', function($excel) 	 {
			$excel->sheet('Sheet 1', function($sheet)  {
				$users = DB::table('numa_search_history')
            ->leftJoin('users', 'numa_search_history.user_id', '=', 'users.id')
            ->select('numa_search_history.location','numa_search_history.id','numa_search_history.ip_address','user_id','users.name','numa_search_history.seach_keyword', 'numa_search_history.created_date')
            ->get();
				
				
				$arr =array();
				$i=1;
                foreach($users as $employee) {
						if($employee->name=='')
						{
							$type="Guest User";
						}else{
							$type='User';
						}
                        $data =  array($i,$employee->user_id,$type,$employee->name,$employee->seach_keyword,$employee->ip_address,$employee->location,date('d M Y h:iA',strtotime($employee->created_date)));
                        array_push($arr, $data);
                    $i++;
                }
			$sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                       'ID', 'User Id', 'Type', 'Name', 'Search Keyword','IP Address','Location', 'Date')

                );
			});
			})->export('xls');
	}
	public function getAudit_excel_download()
	{
		/*$users = History::select('id','user_id as User ID','name' ,'seach_keyword as Search Keyword', 'created_date as Date')
		->with("user_name")->get();
		/*$users = DB::table('numa_search_history')
            ->join('users', 'numa_search_history.user_id', '=', 'users.id')
            ->select('numa_search_history.id','user_id as User ID','users.name','numa_search_history.seach_keyword as Search Keyword', 'numa_search_history.created_date as Date')
            ->get();*/
		Excel::create('Audit Details', function($excel) 	 {
			$excel->sheet('Sheet 1', function($sheet)  {
				$users = DB::table('users_logs')
            ->leftJoin('users', 'users_logs.user_id', '=', 'users.id')
            ->select('users_logs.*','users.name')
            ->get();
				
				
				$arr =array();
				$i=1;
                foreach($users as $employee) {
						
                        $data =  array($i,$employee->name,$employee->action,$employee->action_model,date('d M Y h:iA',strtotime($employee->created_at)));
                        array_push($arr, $data);
                    $i++;
                }
			$sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                       'ID', 'User Name', 'Action', 'Action Model', 'Date')

                );
			});
			})->export('xls');
	}
    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            History::destroy($toDelete);
        } else {
            History::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.history.index');
    }

}
