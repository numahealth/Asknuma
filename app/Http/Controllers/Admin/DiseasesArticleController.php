<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\DiseasesArticle;
use App\Http\Requests\CreateDiseasesArticleRequest;
use App\Http\Requests\UpdateDiseasesArticleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Diseases;


class DiseasesArticleController extends Controller {

	/**
	 * Display a listing of diseasesarticle
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $diseasesarticle = DiseasesArticle::with("diseases")->get();

		return view('admin.diseasesarticle.index', compact('diseasesarticle'));
	}

	/**
	 * Show the form for creating a new diseasesarticle
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $diseases = Diseases::lists("disease_name", "id")->prepend('Please select', '');

	    $status = Diseases::$status;
	    return view('admin.diseasesarticle.create', compact("diseases",'status'));
	}

	/**
	 * Store a newly created diseasesarticle in storage.
	 *
     * @param CreateDiseasesArticleRequest|Request $request
	 */
	public function store(CreateDiseasesArticleRequest $request)
	{
	    $request = $this->saveFiles($request);
		DiseasesArticle::create($request->all());

		return redirect()->route('admin.diseasesarticle.index');
	}

	/**
	 * Show the form for editing the specified diseasesarticle.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$status = DiseasesArticle::$status;
		$diseasesarticle = DiseasesArticle::find($id);
	    $diseases = Diseases::lists("disease_name", "id")->prepend('Please select', '');

	    
		return view('admin.diseasesarticle.edit', compact('diseasesarticle', "diseases",'status'));
	}

	/**
	 * Update the specified diseasesarticle in storage.
     * @param UpdateDiseasesArticleRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDiseasesArticleRequest $request)
	{
		$diseasesarticle = DiseasesArticle::findOrFail($id);

        $request = $this->saveFiles($request);

		$diseasesarticle->update($request->all());

		return redirect()->route('admin.diseasesarticle.index');
	}

	/**
	 * Remove the specified diseasesarticle from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		DiseasesArticle::destroy($id);

		return redirect()->route('admin.diseasesarticle.index');
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
            DiseasesArticle::destroy($toDelete);
        } else {
            DiseasesArticle::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.diseasesarticle.index');
    }

}
