<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Searchkeyword;
use App\Http\Requests\CreateSearchkeywordRequest;
use App\Http\Requests\UpdateSearchkeywordRequest;
use Illuminate\Http\Request;



class SearchkeywordController extends Controller {

	/**
	 * Display a listing of searchkeyword
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
    	
        $searchkeyword = SearchKeyword::all();

		return view('admin.searchkeyword.index', compact('searchkeyword'));
	}

	/**
	 * Show the form for creating a new searchkeyword
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    $status = SearchKeyword::$status;
	    return view('admin.searchkeyword.create', compact("status"));
	}

	/**
	 * Store a newly created searchkeyword in storage.
	 *
     * @param CreateSearchKeywordRequest|Request $request
	 */
	public function store(CreateSearchKeywordRequest $request)
	{
	    
		SearchKeyword::create($request->all());

		return redirect()->route('admin.searchkeyword.index');
	}

	/**
	 * Show the form for editing the specified searchkeyword.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$status = SearchKeyword::$status;
		$searchkeyword = SearchKeyword::find($id);
	    
	    
		return view('admin.searchkeyword.edit', compact('searchkeyword','status'));
	}
	public function bulk_upload()
	{
	    	$status = SearchKeyword::$status;
		return view('admin.searchkeyword.excel', compact("status"));
	}
	/**
	 * Update the specified searchkeyword in storage.
     * @param UpdateSearchKeywordRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateSearchKeywordRequest $request)
	{
		$searchkeyword = SearchKeyword::findOrFail($id);

        

		$searchkeyword->update($request->all());

		return redirect()->route('admin.searchkeyword.index');
	}

	/**
	 * Remove the specified searchkeyword from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		SearchKeyword::destroy($id);

		return redirect()->route('admin.searchkeyword.index');
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
            SearchKeyword::destroy($toDelete);
        } else {
            SearchKeyword::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.searchkeyword.index');
    }

}
