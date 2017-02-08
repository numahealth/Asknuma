<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Mail;
use DB;

class FeedbacksController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $size = $request->get('size');
        $offset = $request->get('offset');
        $feedbacks = DB::table('user_feedback')
                ->orderBy('created_at', 'asc')
                ->offset($offset === null ? 0 : $offset)
                ->limit($size === null ? 200 : $size)
                ->get();

        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $selectedFeedback = DB::table('user_feedback')
                ->join('users', 'user_feedback.user_id', '=', 'users.id')
                ->select('user_feedback.*', 'users.name', 'users.email', 'users.age', 'users.profile_pic', 'users.phone', 'users.gender')
                ->where('user_feedback.id', '=', $id)
                ->get();

        $selectedResponses = DB::table('user_feedback_response')
                ->where('user_feedback_id', '=', $id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        //print_r($message);die;
        return view('admin.feedbacks.view_reply', compact('selectedFeedback', 'selectedResponses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveResponse(Request $request) {
        $create_dt = date("Y-m-d H:i:s");
        $input = $request->all();
        DB::table('user_feedback_response')->insert(
                [
                    'responded_user_id' => Auth::user()->id,
                    'response' => $input['message'],
                    'user_feedback_id' => $input['feedback_id'],
                    'created_at' => $create_dt,
                    'status' => 'Active'
                ]
        );

        // send mail only on production
        $blackList = array(
            'localhost',
            '127.0.0.1',
            '::1'
        );
        if (!in_array($_SERVER['REMOTE_ADDR'], $blackList)) {
            Mail::send('admin.users.reply_by_doc', ['user_detail' =>
                array(
                    'name' => Auth::user()->name,
                    'username' => Auth::user()->email
                )], function ($message) {
                $message->from('tobi@numa.io', 'Numa Health');
                $message->to(Auth::user()->email)->subject('Numa Health : Thanks for your feedback.');
            });
        }
        echo 'Message sent successfully!';
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
