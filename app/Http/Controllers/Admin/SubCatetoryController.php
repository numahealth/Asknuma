<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\SubCatetory;
use App\Http\Requests\CreateSubCatetoryRequest;
use App\Http\Requests\UpdateSubCatetoryRequest;
use Illuminate\Http\Request;

use App\Category;


class SubCatetoryController extends Controller {

	/**
	 * Display a listing of subcatetory
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
               
               $subcatetory = SubCatetory::with("category")->get();

		return view('admin.subcatetory.index', compact('subcatetory'));
		
	}

	/**
	 * Show the form for creating a new subcatetory
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $category = Category::where('status','=','Active')->lists("category_name", "id")->prepend('Please select', '');

	    
        $status = SubCatetory::$status;

	    return view('admin.subcatetory.create', compact("category", "status"));
	}

	/**
	 * Store a newly created subcatetory in storage.
	 *
     * @param CreateSubCatetoryRequest|Request $request
	 */
	public function store(CreateSubCatetoryRequest $request)
	{
	    
		SubCatetory::create($request->all());

		return redirect()->route('admin.subcatetory.index');
	}

	/**
	 * Show the form for editing the specified subcatetory.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$subcatetory = SubCatetory::find($id);
	    $category = Category::where('status','=','Active')->lists("category_name", "id")->prepend('Please select', '');

	    
        $status = SubCatetory::$status;

		return view('admin.subcatetory.edit', compact('subcatetory', "category", "status"));
	}

	/**
	 * Update the specified subcatetory in storage.
     * @param UpdateSubCatetoryRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateSubCatetoryRequest $request)
	{
		$subcatetory = SubCatetory::findOrFail($id);

        

		$subcatetory->update($request->all());

		return redirect()->route('admin.subcatetory.index');
	}

	/**
	 * Remove the specified subcatetory from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		SubCatetory::destroy($id);

		return redirect()->route('admin.subcatetory.index');
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
            SubCatetory::destroy($toDelete);
        } else {
            SubCatetory::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.subcatetory.index');
    }

}
