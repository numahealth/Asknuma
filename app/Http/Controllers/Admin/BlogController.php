<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Blog;
use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class BlogController extends Controller {

	/**
	 * Display a listing of blog
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $blog = Blog::all();

		return view('admin.blog.index', compact('blog'));
	}

	/**
	 * Show the form for creating a new blog
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
        $status = Blog::$status;

	    return view('admin.blog.create', compact("status"));
	}

	/**
	 * Store a newly created blog in storage.
	 *
     * @param CreateBlogRequest|Request $request
	 */
	public function store(CreateBlogRequest $request)
	{
	    $request = $this->saveFiles($request);
		Blog::create($request->all());

		return redirect()->route('admin.blog.index');
	}

	/**
	 * Show the form for editing the specified blog.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$blog = Blog::find($id);
	    
	    
        $status = Blog::$status;

		return view('admin.blog.edit', compact('blog', "status"));
	}

	/**
	 * Update the specified blog in storage.
     * @param UpdateBlogRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBlogRequest $request)
	{
		$blog = Blog::findOrFail($id);

        $request = $this->saveFiles($request);

		$blog->update($request->all());

		return redirect()->route('admin.blog.index');
	}

	/**
	 * Remove the specified blog from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Blog::destroy($id);

		return redirect()->route('admin.blog.index');
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
            Blog::destroy($toDelete);
        } else {
            Blog::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.blog.index');
    }

}
