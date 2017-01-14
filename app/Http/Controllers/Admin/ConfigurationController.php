<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Configuration;
use App\Http\Requests\CreateConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use Illuminate\Http\Request;

use App\Menus;


class ConfigurationController extends Controller {

	/**
	 * Display a listing of configuration
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $configuration = Configuration::with("Menus")->get();


		return view('admin.configuration.index', compact('configuration'));
	}

	/**
	 * Show the form for creating a new configuration
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $symptom = Menus::lists("title", "id")->prepend('Please select', '');
	    $status = Configuration::$status;
            $position = Configuration::$position ;
	    $type= Configuration::$type;

	    
	    return view('admin.configuration.create', compact("symptom",'status','type','position'));
	}

	/**
	 * Store a newly created configuration in storage.
	 *
     * @param CreateConfigurationRequest|Request $request
	 */
	public function store(CreateConfigurationRequest $request)
	{
	    
		Configuration::create($request->all());

		return redirect()->route('admin.configuration.index');
	}

	/**
	 * Show the form for editing the specified configuration.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$configuration = Configuration::find($id);
		$status = Configuration::$status;
               $position = Configuration::$position ;
	       $type= Configuration::$type;
	    $symptom = Menus::lists("title", "id")->prepend('Please select', '');

	    
		return view('admin.configuration.edit', compact('configuration', "symptom",'status','type','position'));
	}

	/**
	 * Update the specified configuration in storage.
     * @param UpdateConfigurationRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateConfigurationRequest $request)
	{
		$configuration = Configuration::findOrFail($id);

        

		$configuration->update($request->all());

		return redirect()->route('admin.configuration.index');
	}

	/**
	 * Remove the specified configuration from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Configuration::destroy($id);

		return redirect()->route('admin.configuration.index');
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
            Configuration::destroy($toDelete);
        } else {
            Configuration::whereNotNull('id')->delete();
        }

        return redirect()->route('admin.configuration.index');
    }

}
