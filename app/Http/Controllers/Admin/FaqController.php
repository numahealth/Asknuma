<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use DB;
use App\Faq;
use App\FaqCategory;

class FaqController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $faqs = App\Faq::all();
        return view('admin.faq.index', compact('faqs'));
    }

    public function store(Request $request) {
        $create_dt = date("Y-m-d H:i:s");
        $input = $request->all();
        DB::table('faq')->insert(
                [
                    'question' => $input['question'],
                    'answer' => $input['answer'],
                    'category_id' => $input['category_id'],
                    'created_at' => $create_dt,
                    'status' => $input['status']
                ]
        );
        return redirect()->route('admin.faq.create')
                        ->with('message', 'FAQ added successfully!');
    }

    public function create() {
        $status = Faq::$status;
        $categories = App\FaqCategory::all();
        return view('admin.faq.new', compact("status", "categories"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $selectedFaq = App\Faq::find($id);

        if ($selectedFaq == null) {
            $error = array(
                'status' => 'not found'
            );
            echo json_encode($error);
            return;
        }

        $res = array(
            'question' => $selectedFaq->question,
            'answer' => $selectedFaq->answer,
            'category_id' => $selectedFaq->category->id,
            'category_name' => $selectedFaq->category->category_name,
            'status' => $selectedFaq->status
        );
        $response = json_encode($res);
        echo $response;
    }

    /**
     * Show the form for editing the specified faq.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(Request $request) {
        $input = $request->all();
        $id = $input['id'];
        $status = Faq::$status;
        $faq = Faq::find($id);
        if ($faq == null) {
            return redirect()->route('admin.faq.index');
        }
        $categories = FaqCategory::pluck('category_name', 'id');
        return view('admin.faq.edit', compact('faq', 'categories', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $faq = Faq::findOrFail($id);
        if ($faq != null) {
            $input = $request->all();
            $cat_id = $input['category_id'];
            $faq->category_id = $cat_id;
        }
        $faq->update($request->all());
        return redirect()->route('admin.faq.index');
    }

}
