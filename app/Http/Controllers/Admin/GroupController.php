<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Group;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use Illuminate\Http\Request;
use DB;


class GroupController extends Controller {

	/**
	 * Display a listing of group
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $group = Group::all();
		$group = DB::table('group')
			->select('group.*')
			->orderBy('group.created_at', 'desc')
			->groupBy('dieases')
            ->get();
		return view('admin.group.index', compact('group'));
	}

	/**
	 * Show the form for creating a new group
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	  
        $status = Group::$status;
	    return view('admin.group.create', compact("status"));
	}
	public function bulk_upload()
	{
	    $status = Group::$status;
		return view('admin.group.excel', compact("status"));
	}
	/**
	 * Store a newly created group in storage.
	 *
     * @param CreateGroupRequest|Request $request
	 */
	public function store(CreateGroupRequest $request)
	{
		
	    $input=($request->all());
		//sprint_r($input); die;
		foreach($input['symptom'] as $value)
		{
			DB::table('group')->insert(
			['name' => $input['name'],'dieases' => $input['dieases'][0],'status' => $input['status'],'symptom' => $value,'mapping'=>json_encode($input['symptom']),'created_at'=>date('Y-m-d H:i:s')
			]
		);
		}
		//Group::create($request->all());

		return redirect()->route('admin.group.index');
	}

	/**
	 * Show the form for editing the specified group.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$status = Group::$status;
		$group = Group::find($id);
	    
	    
		return view('admin.group.edit', compact('group', "status"));
	}

	/**
	 * Update the specified group in storage.
     * @param UpdateGroupRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateGroupRequest $request)
	{
		//$group = Group::findOrFail($id);

        $dieases = DB::table('group')
		->select('dieases')
		->where('id', '=', $id)
		->get();
		//print_r($dieases); die;
		DB::table('group')->where('dieases', '=', $dieases[0]->dieases)->delete();
		 $input=($request->all());
		 DB::table('group')->where('dieases', '=',  $input['dieases'][0])->delete();
		foreach($input['symptom'] as $value)
		{
			DB::table('group')->insert(
			['name' => $input['name'],'dieases' => $input['dieases'][0],'status' => $input['status'],'symptom' => $value,'mapping'=>json_encode($input['symptom']),'created_at'=>date('Y-m-d H:i:s')
			]
		);
		}
		//$group->update($request->all());

		return redirect()->route('admin.group.index');
	}

	/**
	 * Remove the specified group from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		//Group::destroy($id);
		$dieases = DB::table('group')
		->select('dieases')
		->where('id', '=', $id)
		->get();
		DB::table('group')->where('dieases', '=', $dieases[0]->dieases)->delete();
		return redirect()->route('admin.group.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
		//echo $request->get('toDelete'); die;
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
			foreach($toDelete as $deleted_id)
			{
				$dieases = DB::table('group')
				->select('dieases')
				->where('id', '=', $deleted_id)
				->get();
				//print_r($dieases); die;
				DB::table('group')->where('dieases', '=', $dieases[0]->dieases)->delete();
				
			}
            
        } else {
            Group::whereNotNull('id')->delete();
        }
        return redirect()->route('admin.group.index');
    }

}
