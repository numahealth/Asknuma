<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;

class BotConfigController extends Controller {

    public function index() {
        $flows = DB::table('chat_flow')
                ->select(['id', 'flow_name'])
                ->get();
        return view('admin.bot.index', compact('flows', $flows));
    }

    public function saveChatFlow(Request $request) {
        $input = $request->all();
        $flowName = $input['flowName'];
        $storeId = $this->getStoreId();
        $id = $this->getNextId('chat_flow');
        DB::table('chat_flow')->insert(
                [
                    'id' => $id,
                    'store_id' => $storeId,
                    'flow_name' => $flowName
                ]
        );

        $flows = DB::table('chat_flow')
                ->select(['id', 'flow_name'])
                ->get();
        $html = view('admin.bot.flows', compact('flows', $flows))->render();
            $res = array(
                "success" => true,
                "message" => "Flow created successfully!",
                'html' => $html
            );
        return json_encode($res);
    }

    public function updateChatFlow(Request $request, $id) {
        //
    }

    public function boxes(Request $request) {
        $input = $request->all();
        $id = $input['id'];
        //Log::info('Chat Flow ID -->  ' . $id);
        $boxes = DB::table('flow_box')
                ->select(['id', 'box_name','message'])
                ->where('chat_flow_id', '=', $id)
                ->get();
        return view('admin.bot.boxes', compact('boxes', $boxes));
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function getStoreId() {
        $stores = DB::table('store')
                ->select('id')
                ->limit(1)
                ->get();
        if (empty($stores)) {
            return NULL;
        }
        return $stores[0]->id;
    }

    public function getNextId($tableName) {
        $keys = DB::table('primary_key_gen')
                ->select('next_key')
                ->where('table_name', '=', $tableName)
                ->limit(1)
                ->get();
        $next_key = $keys[0]->next_key;

        DB::table('primary_key_gen')
                ->where('table_name', '=', $tableName)
                ->update(['next_key' => ($next_key + 1)]);

        return $next_key;
    }

    public function getBotId() {
        $bots = DB::table('platform_user')
                ->select('id')
                ->where('user_type', '=', 'BOT')
                ->limit(1)
                ->get();
        if (empty($bots)) {
            return NULL;
        }
        return $bots[0]->id;
    }

}
