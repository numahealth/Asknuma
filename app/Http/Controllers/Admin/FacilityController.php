<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Facility;
use App\Http\Requests\CreateFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use Illuminate\Http\Request;

use App\Category;
use App\SubCatetory;


class FacilityController extends Controller {

	/**
	 * Display a listing of facility
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $facility = Facility::with("category")->with("subcatetory")->get();

		return view('admin.facility.index', compact('facility'));
	}

	/**
	 * Show the form for creating a new facility
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $category = Category::where('status','=','Active')->lists("category_name", "id")->prepend('Please select', '');
		$subcatetory = SubCatetory::where('status','=','1')->lists("sub_category_name", "id")->prepend('Please select', '');

	    $status = Facility::$status;
	    $verified = Facility::$verified;
	    return view('admin.facility.create', compact("category", "subcatetory","status","verified"));
	}

	/**
	 * Store a newly created facility in storage.
	 *
     * @param CreateFacilityRequest|Request $request
	 */
	public function store(CreateFacilityRequest $request)
	{
		if(isset($request->all()['Sun']))
		{
				$sun=array($request->all()['Sun_open']=>$request->all()['Sun_close']);
		}else{
			$sun=array();
		}
		if(isset($request->all()['Mon']))
		{
				$mon=array($request->all()['Mon_open']=>$request->all()['Mon_close']);
		}else{
			$mon=array();
		}
		if(isset($request->all()['Tue']))
		{
				$tues=array($request->all()['Tue_open']=>$request->all()['Tue_close']);
		}else{
			$tues=array();
		}
		if(isset($request->all()['Wed']))
		{
				$wed=array($request->all()['Wed_open']=>$request->all()['Wed_close']);
		}else{
			$wed=array();
		}
		
		if(isset($request->all()['Thu']))
		{
				$thu=array($request->all()['Thu_open']=>$request->all()['Thu_close']);
		}else{
				$thu=array();
		}
		if(isset($request->all()['Fri']))
		{
				$fri=array($request->all()['Fri_open']=>$request->all()['Fri_close']);
		}else{
			$fri=array();
		}
		if(isset($request->all()['Sat']))
		{
				$sat=array($request->all()['Sat_open']=>$request->all()['Sat_close']);
		}else{
			$sat=array();
		}
		$storeSchedule=array('Sun'=>$sun,'Mon'=>$mon,'Tue'=>$tues,'Wed'=>$wed,'Thu'=>$thu,'Fri'=>$fri,'Sat'=>$sat);
		//$request->all()['timing']=json_encode($storeSchedule);
		$request->request->add(['timing' => json_encode($storeSchedule)]);
		//print_r($request->all()); die;
		Facility::create($request->all());

		return redirect()->route('admin.facility.index');
	}

	/**
	 * Show the form for editing the specified facility.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$facility = Facility::find($id);
		
	    $category = Category::lists("category_name", "id")->prepend('Please select', '');
            $subcatetory = SubCatetory::where('category_id','=',$facility['category_id'])->where('status','=','Active')->lists("sub_category_name", "id")->prepend('Please select', '');

	    $status = Facility::$status;
	     $verified= Facility::$verified;
		return view('admin.facility.edit', compact('facility', "category", "subcatetory","status","verified"));
	}

	/**
	 * Update the specified facility in storage.
     * @param UpdateFacilityRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFacilityRequest $request)
	{
		if(isset($request->all()['Sun']))
		{
				$sun=array($request->all()['Sun_open']=>$request->all()['Sun_close']);
		}else{
			$sun=array();
		}
		if(isset($request->all()['Mon']))
		{
				$mon=array($request->all()['Mon_open']=>$request->all()['Mon_close']);
		}else{
			$mon=array();
		}
		if(isset($request->all()['Tue']))
		{
				$tues=array($request->all()['Tue_open']=>$request->all()['Tue_close']);
		}else{
			$tues=array();
		}
		if(isset($request->all()['Wed']))
		{
				$wed=array($request->all()['Wed_open']=>$request->all()['Wed_close']);
		}else{
			$wed=array();
		}
		
		if(isset($request->all()['Thu']))
		{
				$thu=array($request->all()['Thu_open']=>$request->all()['Thu_close']);
		}else{
				$thu=array();
		}
		if(isset($request->all()['Fri']))
		{
				$fri=array($request->all()['Fri_open']=>$request->all()['Fri_close']);
		}else{
			$fri=array();
		}
		if(isset($request->all()['Sat']))
		{
				$sat=array($request->all()['Sat_open']=>$request->all()['Sat_close']);
		}else{
			$sat=array();
		}
		$storeSchedule=array('Sun'=>$sun,'Mon'=>$mon,'Tue'=>$tues,'Wed'=>$wed,'Thu'=>$thu,'Fri'=>$fri,'Sat'=>$sat);
		//$request->all()['timing']=json_encode($storeSchedule);
		$request->request->add(['timing' => json_encode($storeSchedule)]);
		$facility = Facility::findOrFail($id);

        

		$facility->update($request->all());

		return redirect()->route('admin.facility.index');
	}

	/**
	 * Remove the specified facility from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Facility::destroy($id);

		return redirect()->route('admin.facility.index');
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
            Facility::destroy($toDelete);
        } else {
            Facility::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.facility.index');
    }

}
