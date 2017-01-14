<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Bulkuplaod;
use App\Http\Requests\CreateBulkuplaodRequest;
use App\Http\Requests\UpdateBulkuplaodRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class BulkuplaodController extends Controller {

	/**
	 * Display a listing of bulkuplaod
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $bulkuplaod = Bulkuplaod::all();

		return view('admin.bulkuplaod.index', compact('bulkuplaod'));
	}

	/**
	 * Show the form for creating a new bulkuplaod
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.bulkuplaod.create');
	}

	/**
	 * Store a newly created bulkuplaod in storage.
	 *
     * @param CreateBulkuplaodRequest|Request $request
	 */
	public function store(CreateBulkuplaodRequest $request)
	{
	    $request = $this->saveFiles($request);
		Bulkuplaod::create($request->all());

		return redirect()->route('admin.bulkuplaod.index');
	}

	/**
	 * Show the form for editing the specified bulkuplaod.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$bulkuplaod = Bulkuplaod::find($id);
	    
	    
		return view('admin.bulkuplaod.edit', compact('bulkuplaod'));
	}

	/**
	 * Update the specified bulkuplaod in storage.
     * @param UpdateBulkuplaodRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBulkuplaodRequest $request)
	{
		$bulkuplaod = Bulkuplaod::findOrFail($id);

        $request = $this->saveFiles($request);

		$bulkuplaod->update($request->all());

		return redirect()->route('admin.bulkuplaod.index');
	}

	/**
	 * Remove the specified bulkuplaod from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Bulkuplaod::destroy($id);

		return redirect()->route('admin.bulkuplaod.index');
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
            Bulkuplaod::destroy($toDelete);
        } else {
            Bulkuplaod::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.bulkuplaod.index');
    }

}
