<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use DB;
use App\Test;
use App\Http\Requests\CreateTestRequest;
use App\Http\Requests\UpdateTestRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller {

	/**
	 * Display a listing of test
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $test = Test::all();

		return view('admin.test.index', compact('test'));
		
		/*$users = User::select('id', 'name', 'email', 'created_at')->get();
			Excel::create('users', function($excel) use($users) {
			$excel->sheet('Sheet 1', function($sheet) use($users) {
				$sheet->fromArray($users);
			});
			})->export('xls');*/
	}

	/**
	 * Show the form for creating a new test
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    Excel::load('public\uploads\example.xls', function ($reader) {

                foreach ($reader->toArray() as $row) {
                    print_r($row); 
                }
            });
			die;
	    return view('admin.test.create');
	}

	/**
	 * Store a newly created test in storage.
	 *
     * @param CreateTestRequest|Request $request
	 */
	public function store(CreateTestRequest $request)
	{
	    $request = $this->saveFiles($request);
		
		  $condition=$request->all()['condition']; 
		 $input=$request->all()['excel'];
		 $path = 'public/uploads/"'.$input;
		 $path=str_replace('"','',$path);
		 if($condition=='search')
		 {
			Excel::load($path, function ($reader) {

                foreach ($reader->toArray() as $row) {
					//print_r($row);
					  $symptoms = DB::table('searchkeyword')
					 ->select('keyword')
					  ->where('keyword', '=', $row['keyword_name'])->get();
					if(empty($symptoms))
					{
						if($row['keyword_name']!='')
						DB::table('searchkeyword')->insert(
							['keyword' => $row['keyword_name'],'description' => $row['description'],'status' => $row['status'],'created_at'=>date('Y-m-d H:i:s')]
						);
					}
					  
				   
                }
            });
			$Message = 'File is successfully upload.';
			return redirect()->route('admin.searchkeyword.index')->withMessage($Message);
		 }
		 else if($condition=='sym')
		 {
			 $p=0;
			 Excel::load($path, function ($reader) {
				$keyword_name=array();
				$symptom_key_array=array();
				$p=0;
                foreach ($reader->toArray() as $row) {
					$key_array=array();
					//print_r($row);
					 $symptoms = DB::table('symptom')
					 ->select('symptom_name','id')
					  ->where('symptom_name', '=', $row['symptom_name'])->get();
					if(empty($symptoms))
					{
						$insert_id=DB::table('symptom')->insertGetId(
							['symptom_name' => $row['symptom_name'],'symptom_description' => $row['description'],'status' => $row['status'],'created_at'=>date('Y-m-d H:i:s')]
						);
					}
					else{
						$insert_id=$symptoms[0]->id;
					}
					$name_keyword= explode(', ',$row['keyword_name']); 
					
					foreach($name_keyword as $value_symptom)
					{
						$serachkeyword = DB::table('searchkeyword')
						 ->select('keyword','id')
						  ->where('keyword', '=', $value_symptom)->get();
						if(empty($serachkeyword))
						{
							$p=1;
							/*$id_insert=DB::table('symptom')->insertGetId(
								['symptom_name' => $value_symptom,'symptom_description' => $row['description'],'status' => $row['status'],'created_at'=>date('Y-m-d H:i:s')]
							);
							$symptom_array[]=$id_insert;*/
							if($value_symptom=='')
							{
								$value_symptom='blank value';
							}
							$keyword_name[]= $value_symptom;	
						}else{
							
							$key_array[]=$serachkeyword[0]->id;
						}
						$symptom_key_array[$insert_id]=$key_array;
					}
					  
				   
                }
				//print_r($keyword_name);die;
				if($p == 1)
					{
						foreach ($symptom_key_array as $key=>$records)
						{
							DB::table('symptom')->where('id', '=', $key)->delete();
						}
						$keyword_name=array_unique($keyword_name);
						$keyword_names = implode(", ",$keyword_name).' does not exits as search keyword. Please add these Keyword.';
						
						return redirect()->route('users.index')->withMessage($keyword_names);
					}
				
				foreach ($symptom_key_array as $key=>$records)
				{
					DB::table('symptom_search')->where('symptom_id', '=', $key)->delete();
					foreach($records as $symptom_id)
					{
						DB::table('symptom_search')->insert(
						['search_keyword' => $symptom_id,'symptom_id' => $key,'mapping'=>json_encode($records),'created_at'=>date('Y-m-d H:i:s')
						]
					);
					}
				}
            });
			return redirect()->route('admin.symptom.index');
		 }else if($condition=='dis')
		 {
			 Excel::load($path, function ($reader) {

                foreach ($reader->toArray() as $row) {
					//print_r($row); die;
					  $symptoms = DB::table('diseases')
					 ->select('disease_name')
					  ->where('disease_name', '=', $row['diseases_name'])->get();
					if(empty($symptoms))
					{
						if($row['diseases_name']!='')
						{
						DB::table('diseases')->insert(
							['disease_name' => $row['diseases_name'],'description' => $row['description'],'status' => $row['status'],'created_at'=>date('Y-m-d H:i:s')]
						);
						}
					}
					  
				   
                }
            });
			return redirect()->route('admin.diseases.index');
			 
		 }
		 else
		 {
			 $j=0;
			 Excel::load($path, function ($reader) {

				$diseases_array=array();
				$symptom_name=array();
                foreach ($reader->toArray() as $row) {
					$symptom_array=array();	
					$symptoms = DB::table('diseases')
					 ->select('disease_name','id')
					  ->where('disease_name', '=', $row['diseases_name'])->get();
					if(empty($symptoms))
					{
						$id_insert_dis=DB::table('diseases')->insertGetId(
							['disease_name' => $row['diseases_name'],'description' => $row['description'],'status' => $row['status'],'created_at'=>date('Y-m-d H:i:s')]
						);
						//$diseases_array[]=$id_insert;
					}else{
						$id_insert_dis=$symptoms[0]->id;
					}
					$name_symptom= explode(', ',$row['symptom_name']); 
					
					foreach($name_symptom as $value_symptom)
					{
						$symptoms = DB::table('symptom')
						 ->select('symptom_name','id')
						  ->where('symptom_name', '=', $value_symptom)->get();
						if(empty($symptoms))
						{
							$j=1;
							/*$id_insert=DB::table('symptom')->insertGetId(
								['symptom_name' => $value_symptom,'symptom_description' => $row['description'],'status' => $row['status'],'created_at'=>date('Y-m-d H:i:s')]
							);
							$symptom_array[]=$id_insert;*/
							if($value_symptom=='')
							{
								$value_symptom='blank value';
							}
							$symptom_name[]= $value_symptom.' ,';	
						}else{
							$symptom_array[]=$symptoms[0]->id;
						}
						$diseases_array[$id_insert_dis]=$symptom_array;
					}
					
					  
				   
                }
				if($j==1)
					{
						$symptom_name=array_unique($symptom_name);
						$keyword_names = implode(" ",$symptom_name).' does not exits. Please add these symptoms.';
						return redirect()->route('users.index')->withMessage($keyword_names);
					}
				//print_r($diseases_array);
				foreach ($diseases_array as $key=>$records)
				{
					DB::table('group')->where('dieases', '=', $key)->delete();
					foreach($records as $symptom_id)
					{
						DB::table('group')->insert(
						['name' => $row['group_name'],'dieases' => $key,'status' => $row['status'],'symptom' => $symptom_id,'mapping'=>json_encode($records),'created_at'=>date('Y-m-d H:i:s')
						]
					);
					}
				}
			
            });
			return redirect()->route('admin.group.index');
			 
		 }
		
	}

	/**
	 * Show the form for editing the specified test.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$test = Test::find($id);
	    
	    
		return view('admin.test.edit', compact('test'));
	}

	/**
	 * Update the specified test in storage.
     * @param UpdateTestRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTestRequest $request)
	{
		$test = Test::findOrFail($id);

        $request = $this->saveFiles($request);

		$test->update($request->all());

		return redirect()->route('admin.test.index');
	}

	/**
	 * Remove the specified test from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Test::destroy($id);

		return redirect()->route('admin.test.index');
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
            Test::destroy($toDelete);
        } else {
            Test::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.test.index');
    }

}
