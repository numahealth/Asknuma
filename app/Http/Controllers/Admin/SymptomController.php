<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Symptom;
use App\Http\Requests\CreateSymptomRequest;
use App\Http\Requests\UpdateSymptomRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\CreateTestRequest;
use DB;

class SymptomController extends Controller {

	/**
	 * Display a listing of symptom
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
		
        $symptom = Symptom::all();

		return view('admin.symptom.index', compact('symptom'));
	}

	/**
	 * Show the form for creating a new symptom
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
        $status = Symptom::$status;
		return view('admin.symptom.create', compact("status"));
		
	}
	public function bulk_upload()
	{
	    $status = Symptom::$status;
		return view('admin.symptom.excel', compact("status"));
	}
	
	/**
	 * Store a newly created symptom in storage.
	 *
     * @param CreateSymptomRequest|Request $request
	 */
	public function store(CreateSymptomRequest $request)
	{
	    $input=($request->all());
		$id=Symptom::create($request->all())->id;
		foreach($input['search_keyword'] as $value)
		{
			DB::table('symptom_search')->insert(
			['symptom_id' => $id,'search_keyword' => $value,'mapping'=>json_encode($input['search_keyword']),'created_at'=>date('Y-m-d H:i:s')
			]
			);
		}
		return redirect()->route('admin.symptom.index');
	}

	/**
	 * Show the form for editing the specified symptom.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$symptom = Symptom::find($id);
	    $status = Symptom::$status;
		$mapp = DB::table('symptom_search')->where('symptom_id','=',$id)->get();
		$maps=@$mapp[0];
		return view('admin.symptom.edit', compact('symptom', "status",'maps'));
	}

	/**
	 * Update the specified symptom in storage.
     * @param UpdateSymptomRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateSymptomRequest $request)
	{
		$input=($request->all());
		$symptom = Symptom::findOrFail($id);
		$symptom->update($request->all());
		DB::table('symptom_search')->where('symptom_id', '=', $id)->delete();
		foreach($input['search_keyword'] as $value)
		{
			DB::table('symptom_search')->insert(
			['symptom_id' => $id,'search_keyword' => $value,'mapping'=>json_encode($input['search_keyword']),'created_at'=>date('Y-m-d H:i:s')
			]
			);
		}
		return redirect()->route('admin.symptom.index');
	}

	/**
	 * Remove the specified symptom from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Symptom::destroy($id);

		return redirect()->route('admin.symptom.index');
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
            Symptom::destroy($toDelete);
        } else {
            Symptom::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.symptom.index');
    }

}
