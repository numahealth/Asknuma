<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class FaqCategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$categories = App\FaqCategory::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCategory(Request $request) {
        $create_dt = date("Y-m-d H:i:s");
        $input = $request->all();
        DB::table('faq_category')->insert(
                [
                    'category_name' => $input['category'],
                    'created_at' => $create_dt,
                    'status' => 'Active'
                ]
        );
        $res = array(
            'id' => DB::getPdo()->lastInsertId(),
            'name' => $input['category']
        );
        echo json_encode($res);
    }

    public function deleteCategory(Request $request) {
        $input = $request->all();
        $id = $input['id'];
        $faqs = DB::table('faq')->where('category_id', '=', $id)->get();
        if ($faqs != null) {
            $res = array(
                'status' => 'error',
                'msg' => 'Category cannot be deleted as F.A.Q under it will become orphans!'
            );
            echo json_encode($res);
            return;
        }
        \App\FaqCategory::destroy($id);
        $res = array(
            'status' => 'success',
            'msg' => 'Category deleted successfully. Please refresh page to see the change!'
        );
        echo json_encode($res);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }

}
