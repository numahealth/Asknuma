<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Reason;
use App\Http\Requests\CreateReasonRequest;
use App\Http\Requests\UpdateReasonRequest;
use Illuminate\Http\Request;



class ReasonController extends Controller {

	/**
	 * Display a listing of reason
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $reason = Reason::all();

		return view('admin.reason.index', compact('reason'));
	}

	/**
	 * Show the form for creating a new reason
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
        $status = Reason::$status;
        $type= Reason::$type;

	    return view('admin.reason.create', compact("status",'type'));
	}

	/**
	 * Store a newly created reason in storage.
	 *
     * @param CreateReasonRequest|Request $request
	 */
	public function store(CreateReasonRequest $request)
	{
	    
		Reason::create($request->all());

		return redirect()->route('admin.reason.index');
	}

	/**
	 * Show the form for editing the specified reason.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$reason = Reason::find($id);
	    
	    
        $status = Reason::$status;
         $type= Reason::$type;

		return view('admin.reason.edit', compact('reason', "status",'type'));
	}

	/**
	 * Update the specified reason in storage.
     * @param UpdateReasonRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateReasonRequest $request)
	{
		$reason = Reason::findOrFail($id);

        

		$reason->update($request->all());

		return redirect()->route('admin.reason.index');
	}

	/**
	 * Remove the specified reason from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Reason::destroy($id);

		return redirect()->route('admin.reason.index');
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
            Reason::destroy($toDelete);
        } else {
            Reason::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.reason.index');
    }

}
