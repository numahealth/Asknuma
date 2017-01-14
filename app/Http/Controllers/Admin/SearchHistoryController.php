<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\History;
use App\Bookmark;
use App\DiseasesArticle;
class SearchHistoryController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function getIndex()
    {
		$main_message=Auth::user();
		$history = History::where('user_id', Auth::user()->id)->get();
		return view('admin.searchhistory.index', compact('main_message','history'));
	}
	public function bookmark()
    {
		$main_message=Auth::user();
		$bookmark = Bookmark::where('user_id', Auth::user()->id)->where('status','Active')->orderBy('created_date', 'desc')->get();
		//print_r($bookmark); die;
		return view('admin.searchhistory.bookmark', compact('main_message','bookmark'));
	}

}