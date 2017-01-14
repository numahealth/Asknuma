<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\CheckImage;
use App\Http\Requests\CreateCheckImageRequest;
use App\Http\Requests\UpdateCheckImageRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class CheckImageController extends Controller {

	/**
	 * Display a listing of checkimage
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $checkimage = CheckImage::all();

		return view('admin.checkimage.index', compact('checkimage'));
	}

	/**
	 * Show the form for creating a new checkimage
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.checkimage.create');
	}

	/**
	 * Store a newly created checkimage in storage.
	 *
     * @param CreateCheckImageRequest|Request $request
	 */
	public function store(CreateCheckImageRequest $request)
	{
	    $request = $this->saveFiles($request);
		CheckImage::create($request->all());

		return redirect()->route('admin.checkimage.index');
	}

	/**
	 * Show the form for editing the specified checkimage.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$checkimage = CheckImage::find($id);
	    
	    
		return view('admin.checkimage.edit', compact('checkimage'));
	}

	/**
	 * Update the specified checkimage in storage.
     * @param UpdateCheckImageRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateCheckImageRequest $request)
	{
		$checkimage = CheckImage::findOrFail($id);

        $request = $this->saveFiles($request);

		$checkimage->update($request->all());

		return redirect()->route('admin.checkimage.index');
	}

	/**
	 * Remove the specified checkimage from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		CheckImage::destroy($id);

		return redirect()->route('admin.checkimage.index');
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
            CheckImage::destroy($toDelete);
        } else {
            CheckImage::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.checkimage.index');
    }

}
