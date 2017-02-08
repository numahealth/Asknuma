<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/symptom/bulk_upload', ['as' => 'symptom.bulk_upload', 'uses' => 'Admin\SymptomController@bulk_upload']);
    Route::get('/reset/{id}', ['as' => 'users.update_password', 'uses' => 'UsersController@update_password']);
    Route::get('users/view/{id}', ['as' => 'users.view', 'uses' => 'UsersController@views']);
    Route::get('admin/symptom/bulk_upload', ['as' => 'symptom.bulk_upload', 'uses' => 'Admin\SymptomController@bulk_upload']);
    Route::get('admin/searchkeyword/bulk_upload', ['as' => 'searchkeyword.bulk_upload', 'uses' => 'Admin\SearchkeywordController@bulk_upload']);
    Route::get('admin/test/store', ['as' => 'admin.test.store', 'uses' => 'Admin\TestController@store']);
    Route::get('admin/test', ['as' => 'admin.test.store', 'uses' => 'Admin\TestController@index']);
    Route::post('admin/test/store', ['as' => 'admin.test.store', 'uses' => 'Admin\TestController@store']);
    Route::get('admin/diseases/bulk_upload', ['as' => 'diseases.bulk_upload', 'uses' => 'Admin\DiseasesController@bulk_upload']);
    Route::get('admin/group/bulk_upload', ['as' => 'group.bulk_upload', 'uses' => 'Admin\GroupController@bulk_upload']);
    Route::get('admin/message/view/{id}', ['as' => 'message.view', 'uses' => 'Admin\MessageController@view']);
    Route::get('admin/message/reply/', ['as' => 'message.new_message', 'uses' => 'Admin\MessageController@view']);
    Route::post('admin/message/store/{id}', ['as' => 'message.store', 'uses' => 'Admin\MessageController@store']);

    Route::get('admin/message/store/', ['as' => 'message.store', 'uses' => 'Admin\MessageController@store']);
    Route::get('admin/setting/', ['uses' => 'Admin\SettingController@edit']);
    Route::get('admin/feedbacks/view_reply/{id}', ['as' => 'admin.feedbacks.show', 'uses' => 'Admin\FeedbacksController@show']);
    Route::get('admin/reset_password/', ['uses' => 'Admin\SettingController@reset_password']);
    Route::post('admin/feedbacks/response', ['as' => 'admin.feedbacks.response', 'uses' => 'Admin\FeedbacksController@saveResponse']);
    Route::post('admin/setting/update', ['as' => 'admin.userssetting.update', 'uses' => 'Admin\SettingController@update']);
    Route::post('admin/setting/pass_update', ['as' => 'admin.userssetting.pass_update', 'uses' => 'Admin\SettingController@pass_update']);
    Route::get('admin/bookmark/', ['as' => 'admin.searchhistory.bookmark', 'uses' => 'Admin\SearchHistoryController@bookmark']);
    Route::post('admin/message/slack/', ['as' => 'message.slack', 'uses' => 'Admin\MessageController@slack']);
    Route::get('admin/history/excel_download/', ['as' => 'test.excel_download', 'uses' => 'Admin\HistoryController@getexcel_download']);
    Route::get('admin/history/audit_excel_download/', ['as' => 'test.audit_excel_download', 'uses' => 'Admin\HistoryController@getaudit_excel_download']);
    Route::get('admin/feedback/excel_download/', ['as' => 'feedback.excel_download', 'uses' => 'Admin\FeedbackController@getexcel_download']);
    Route::get('admin/feedbacks/', ['as' => 'admin.feedbacks.index', 'uses' => 'Admin\FeedbacksController@index']);
    Route::get('admin/faq/{id}', ['as' => 'admin.faq.edit', 'uses' => 'Admin\FaqController@edit']);
    Route::post('admin/welcome/message_deny', ['as' => 'welcome.message_deny', 'uses' => 'Admin\WelcomeController@postMessage_deny']);
    Route::post('admin/welcome/sub_cat', ['as' => 'welcome.sub_cat', 'uses' => 'Admin\WelcomeController@postSub_cat']);
    Route::post('admin/welcome/unread', ['as' => 'welcome.unread', 'uses' => 'Admin\WelcomeController@unread']);
    Route::post('admin/welcome/unread_update', ['as' => 'welcome.unread_update', 'uses' => 'Admin\WelcomeController@unread_update']);
});
Route::post('admin/welcome/search', ['as' => 'welcome.search', 'uses' => 'Admin\WelcomeController@postSearch']);
Route::post('admin/welcome/yes_no', ['as' => 'welcome.yes_no', 'uses' => 'Admin\WelcomeController@postYes_no']);
Route::post('admin/welcome/question', ['as' => 'welcome.question', 'uses' => 'Admin\WelcomeController@postQuestion']);
Route::post('admin/welcome/bookmark', ['as' => 'welcome.bookmark', 'uses' => 'Admin\WelcomeController@postBookmark']);
Route::post('admin/welcome/newsletter', ['as' => 'welcome.newsletter', 'uses' => 'Admin\WelcomeController@postNewsletter']);
Route::post('admin/welcome/feedback', ['as' => 'welcome.feedback', 'uses' => 'Admin\WelcomeController@postFeedback']);
Route::post('admin/faqCategory/category', ['as' => 'faqCategory.category', 'uses' => 'Admin\FaqCategoryController@postCategory']);
Route::post('/signin', ['as' => 'auth.signin', 'uses' => 'Auth\AuthController@postSignin']);
Route::post('/signup', ['as' => 'auth.signup', 'uses' => 'Auth\AuthController@sign_register']);
Route::post('/forget', ['as' => 'auth.forget', 'uses' => 'Auth\AuthController@postForget']);
Route::get('/forget', function () {
    return view('forget');
});
Route::get('/login', function () {
    return view('welcome');
});
Route::get('/signin', function () {
    return view('login');
});
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('who_we_are');
});
Route::get('/FAQ', function () {
    return view('faq');
});
Route::get('/faq/{question}', function () {
    return view('faq');
});
Route::get('/feedback', function () {
    return view('feedback');
});
Route::get('/services', function () {
    return view('what_we_do');
});
Route::get('/blog', function () {
    return view('our_blog');
});
Route::get('/contact_us', function () {
    return view('contact_us');
});
Route::get('/search_result/', function () {
    return view('search_result');
});
Route::get('/article_details/{id}/{any}', function () {
    return view('article_detail');
});
Route::get('/article_details_small/{id}', function () {
    return view('article_detail_short');
});
Route::get('/privacy_policy', function () {
    return view('pp');
});
Route::get('/term_condition', function () {
    return view('tc');
});
Route::get('/map', function () {
    return view('map');
});
//Route::get('/', 'Auth\AuthController@getLogin');
/*  Route::get('form', function(){
  return view('student.form');
  }); */
Route::get('form', 'Student@getForm');
Route::post('insert', 'Student@store');
Route::get('laravel-version', function() {
    $laravel = app();
    return "Your Laravel version is " . $laravel::VERSION;
});
Route::get('/blog/{id}/{any}', function () {
    return view('blog_detail');
});
Route::get('/blog_details_small/{id}', function () {
    return view('blog_detail_short');
});
