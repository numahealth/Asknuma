<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMessageRequest;
use Auth;
use Mail;
use App\Http\Controllers\Traits\FileUploadTrait;
class MessageController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	
	public function getIndex()
    {
		
		$message= DB::table('numa_message_user')
			->select('user')
			->groupBy('user')
			->orderBy('numa_message_user.created_date', 'desc')
            	->get();
            	//print_r($message); die;
		 return view('admin.message.index',compact('message'));
	}
	public function getView($id)
    {
		@$main_message=$id;
		$message= DB::table('numa_message')
			->select('numa_message.*')
			->where('status', '=','Active')
			->where('user_id', '=',$id)
			 ->orWhere('user_to', '=',$id)
			->orderBy('numa_message.created_at', 'asc')
            ->get();
			//print_r($message);die;
		 return view('admin.message.view',compact('message','main_message'));
	}
	public function getReply()
    {
		 return view('admin.message.reply');
	}
	public function postStore(CreateMessageRequest $request)
	{
	        $request = $this->saveFiles($request);
		$input=$request->all();
		//print_r($input);die;
		DB::table('numa_message')->insert(
			['user_to' => $input['user_to'],'message' => $input['message'],'user_id' => Auth::user()->id,'created_at'=>date('Y-m-d H:i:s'),'status'=>'Active',
			'parent_id'=>$input['parent_id'],'profile_pic'=>@$input['profile_pic'],'embedded'=>@$input['embedded']]
		);
		if(@$input['sent_by']==1)
		{
			DB::table('numa_message_user')->insert(
			['user' => $input['user_to'],'admin' => Auth::user()->id,'status'=>'Active',]
				);
		    $exist_user= DB::table('numa_message_user')
			->select('id')
			->where('user', '=',$input['user_to'])
             ->get();
			
			if(empty($exist_user))
			{
				DB::table('numa_message_user')->insert(
				['created_date'=>date('Y-m-d H:i:s'),'user'=>$input['user_to'],'admin'=>1,'status'=>'Active']
				);
			}
			else{
			DB::table('numa_message_user')->where('user', $input['user_to'])->update(
				['created_date'=>date('Y-m-d H:i:s')]
				);
			}
			 $user_send_detail= DB::table('users')
			->select('name','email')
			->where('id', '=',$input['user_to'])
             ->get();
            Mail::send('admin.users.reply_by_doc', ['user_detail' => array('name'=>$user_send_detail[0]->name,'username'=>$user_send_detail[0]->email)], function ($message) use ($user_send_detail)
		{
			$message->from('anshul@unyscape.com', 'Numa Health');

        	$message->to($user_send_detail[0]->email)->subject('Numa Health : Answer on your query.');

		});
		return redirect()->route('admin.message.index')->withMessage('Message has been sent');	
		}
		$exist_user= DB::table('numa_message_user')
			->select('id')
			->where('user', '=',$input['user_to'])
             ->get();
			
			if(empty($exist_user))
			{
				DB::table('numa_message_user')->insert(
				['created_date'=>date('Y-m-d H:i:s'),'user'=>$input['user_to'],'admin'=>1,'status'=>'Active']
				);
			}
			else{
			DB::table('numa_message_user')->where('user', $input['user_to'])->update(
				['created_date'=>date('Y-m-d H:i:s')]
				);
			}
		
	  // print_r();
	 $user_send_detail= DB::table('users')
			->select('name','email')
			->where('id', '=',$input['user_to'])
             ->get();
            Mail::send('admin.users.reply_by_doc', ['user_detail' => array('name'=>$user_send_detail[0]->name,'username'=>$user_send_detail[0]->email)], function ($message) use ($user_send_detail)
		{
			$message->from('anshul@unyscape.com', 'Numa Health');

        	$message->to($user_send_detail[0]->email)->subject('Numa Health : Answer on your query.');

		});
	    return redirect()->back()->withMessage('Message has been sent');;
		
	}
	public function postSlack()
	{
		$ch = curl_init("https://slack.com/api/chat.postMessage");
		$data = http_build_query([
			"token" => "xoxp-53548687746-53542895381-68049938758-1dc58b0fb4",
			"channel" => "#general", //"#mychannel",
			"text" => $_POST['message'], //"Hello, Foo-Bar channel message.",
			"username"=>'Tobi'
		]);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		$result=(json_decode($result));
		curl_close($ch);
		if($result->ok)
		{
			DB::table('numa_message')
            ->where('id', $_POST['id'])
            ->update(['sent_by' =>1]);
			return 1;
		}else{
			return 0;
		}
	}
	

}