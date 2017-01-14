<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Pages;
use App\Http\Requests\CreatePagesRequest;
use App\Http\Requests\UpdatePagesRequest;
use Illuminate\Http\Request;



class PagesController extends Controller {

	/**
	 * Display a listing of pages
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $pages = Pages::all();

		return view('admin.pages.index', compact('pages'));
	}

	/**
	 * Show the form for creating a new pages
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
        $status = Pages::$status;

	    return view('admin.pages.create', compact("status"));
	}

	/**
	 * Store a newly created pages in storage.
	 *
     * @param CreatePagesRequest|Request $request
	 */
	public function store(CreatePagesRequest $request)
	{
	    
		Pages::create($request->all());

		return redirect()->route('admin.pages.index');
	}

	/**
	 * Show the form for editing the specified pages.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$pages = Pages::find($id);
	    
	    
        $status = Pages::$status;

		return view('admin.pages.edit', compact('pages', "status"));
	}

	/**
	 * Update the specified pages in storage.
     * @param UpdatePagesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePagesRequest $request)
	{
		$pages = Pages::findOrFail($id);

        

		$pages->update($request->all());

		return redirect()->route('admin.pages.index');
	}

	/**
	 * Remove the specified pages from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Pages::destroy($id);

		return redirect()->route('admin.pages.index');
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
            Pages::destroy($toDelete);
        } else {
            Pages::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.pages.index');
    }

}
