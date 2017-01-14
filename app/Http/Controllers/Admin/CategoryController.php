<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;



class CategoryController extends Controller {

	/**
	 * Display a listing of category
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $category = Category::all();

		return view('admin.category.index', compact('category'));
	}

	/**
	 * Show the form for creating a new category
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	   $status = Category::$status; 
	    return view('admin.category.create',compact('status'));
	}

	/**
	 * Store a newly created category in storage.
	 *
     * @param CreateCategoryRequest|Request $request
	 */
	public function store(CreateCategoryRequest $request)
	{
	    
		Category::create($request->all());

		return redirect()->route('admin.category.index');
	}

	/**
	 * Show the form for editing the specified category.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$category = Category::find($id);
	    
	    	$status = Category::$status; 
		return view('admin.category.edit', compact('category','status'));
	}

	/**
	 * Update the specified category in storage.
     * @param UpdateCategoryRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateCategoryRequest $request)
	{
		$category = Category::findOrFail($id);

        

		$category->update($request->all());

		return redirect()->route('admin.category.index');
	}

	/**
	 * Remove the specified category from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Category::destroy($id);

		return redirect()->route('admin.category.index');
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
            Category::destroy($toDelete);
        } else {
            Category::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.category.index');
    }

}
