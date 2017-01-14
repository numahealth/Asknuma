<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\GoogleAnalyticCode;
use App\Http\Requests\CreateGoogleAnalyticCodeRequest;
use App\Http\Requests\UpdateGoogleAnalyticCodeRequest;
use Illuminate\Http\Request;



class GoogleAnalyticCodeController extends Controller {

	/**
	 * Display a listing of googleanalyticcode
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $googleanalyticcode = GoogleAnalyticCode::all();

		return view('admin.googleanalyticcode.index', compact('googleanalyticcode'));
	}

	/**
	 * Show the form for creating a new googleanalyticcode
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
        $status = GoogleAnalyticCode::$status;

	    return view('admin.googleanalyticcode.create', compact("status"));
	}

	/**
	 * Store a newly created googleanalyticcode in storage.
	 *
     * @param CreateGoogleAnalyticCodeRequest|Request $request
	 */
	public function store(CreateGoogleAnalyticCodeRequest $request)
	{
	    
		GoogleAnalyticCode::create($request->all());

		return redirect()->route('admin.googleanalyticcode.index');
	}

	/**
	 * Show the form for editing the specified googleanalyticcode.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$googleanalyticcode = GoogleAnalyticCode::find($id);
	    
	    
        $status = GoogleAnalyticCode::$status;

		return view('admin.googleanalyticcode.edit', compact('googleanalyticcode', "status"));
	}

	/**
	 * Update the specified googleanalyticcode in storage.
     * @param UpdateGoogleAnalyticCodeRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateGoogleAnalyticCodeRequest $request)
	{
		$googleanalyticcode = GoogleAnalyticCode::findOrFail($id);

        

		$googleanalyticcode->update($request->all());

		return redirect()->route('admin.googleanalyticcode.index');
	}

	/**
	 * Remove the specified googleanalyticcode from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		GoogleAnalyticCode::destroy($id);

		return redirect()->route('admin.googleanalyticcode.index');
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
            GoogleAnalyticCode::destroy($toDelete);
        } else {
            GoogleAnalyticCode::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.googleanalyticcode.index');
    }

}
