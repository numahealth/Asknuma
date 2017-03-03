<?php

namespace App\Http\Controllers\Bots;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use DB;
use App\User;

class FacebookBotController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(Request $request) {
//        // uncomment the code below for Facebook verification
//        $data = $request->all();
//        $challenge = json_encode($data);
//        Log::info($challenge);
//        <span class="fa fa-adjust"></span>
//        echo $data["hub_challenge"];
//        return;

        $input = json_decode(file_get_contents('php://input'), true);
        $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
        //$this->getUserInfoFromFacebook($sender);
        //$messageId = $input['entry'][0]['messaging'][0]['message']['mid'];
        //$time = $input['entry'][0]['time'];
        //$timestamp = $input['entry'][0]['messaging'][0]['timestamp'];
        $this->sendTypingOn($sender);
        $messaging = $input['entry'][0]['messaging'][0];
        if (isset($messaging['message'])) {
            $msg = $messaging['message'];
        } else {
            $msg = $messaging['postback'];
        }

        $isAttachement = FALSE;
        $attach = "";
        if (isset($msg['attachments'])) {
            $isAttachement = TRUE;
            if ($msg['attachments'][0]['type'] == 'location') {
                $coordinates = $msg['attachments'][0]['payload']['coordinates'];
                $message = $msg['attachments'][0]['title']
                        . " (Lat: " 
                        . $coordinates['lat'] 
                        . ", Long: " 
                        . $coordinates['long'] . ")";
            } else {
                $attach = $msg['attachments'][0]['payload']['url'];
                $message = "[". strtoupper($msg['attachments'][0]['type'])  ." Attachment]";
            }
        } else if (isset($msg['quick_reply'])) {
            $reply = $msg['quick_reply'];
            $message = $reply['payload'];
        } else if (isset($msg['text'])) {
            $message = $msg['text'];
        } else {
            $message = $msg['payload'];
        }
        $user = $this->getUser($sender);
        $user['chat_session'] = $this->getChatSession($user['id']);
        $this->saveMessage($user, $message, $attach);

        // Check ChatSession's status
        // if status != ACTIVE, create a new SessionBox and set 
        // FlowBox to System FlowBox SESSION_EXPIRED 


        if ($isAttachement) {
            $buttons = array(
                $this->buildUrlButton("Visit us", url("/")),
                $this->buildPostBackButton("Let's Chat", "Let's Chat"),
            );
            $this->sendButtonResponse($sender, 'Hey ' . $user['firstname']
                    . '! That was a nice attachment but i only understand text.  '
                    . 'Would you select from any of these actions?', $buttons);
            return;
        }
        $message = strtolower($message);
        $this->switchSend($sender, $user, $message);
    }

    public function switchSend($sender, $user, $message) {
        $elementButton = array(
            $this->buildUrlButton("Read more", url("/") . "/article_details/2/you-have-sore-eyes")
        );
        $defaultActionBtn = $this->buildDefaultActionButton(url("/") . "/blog/3/top-tips-for-being-helpful-in-emergency-situations", NULL, "tall");
        $elements = array(
            $this->buildScrollElement("Please dont take my girlfriend!", "Wait till she has got my 5 babes!", url("/") . "/public/uploads/thumb/1479484091-IMG_20160807_164818.jpg", $defaultActionBtn, $elementButton),
            $this->buildScrollElement("DEPRESSION: WHEN THE GOING GETS TOUGH", "How to get help from depression fast", url("/") . "/public/uploads/facebook-image-aspect-ratio.png", $defaultActionBtn, $elementButton),
            $this->buildScrollElement("Babalawo Has Arrived", "He Thinks I wouldnt know but i do", url("/") . "/public/uploads/thumb/1472126490-thyroidglands.jpg", $defaultActionBtn, $elementButton),
            $this->buildScrollElement("The Good, The bad and The Ugly of Medicine", "Prevention is the only cure", url("/") . "/public/uploads/thumb/1486408755-fucked.jpg", $defaultActionBtn, $elementButton)
        );

        switch ($message) {
            case "text":
                $this->sendTextResponse($sender, 'Hey ' . $user['firstname'] . '! How are you doing today? '
                        . ' This is a sample text message. Type the word list and see a miracle. ');
                break;
            case "login":
                $buttons = array(
                    $this->buildLoginButton(url("/facebook_login"))
                );
                $this->sendButtonResponse($sender, 'Login with Facebook', $buttons);
                break;
            case "buttons":
                $buttons = array(
                    $this->buildUrlButton("Visit us", url("/")),
                    $this->buildPostBackButton("Let's Chat", "Let's Chat")
                );
                $this->sendButtonResponse($sender, 'Hey ' . $user['firstname'] . '! How is your day going. '
                        . ' This is a sample button message. By the way, '
                        . ' what would you like to do?', $buttons);
                break;
            case "list":
                $this->sendListResponse($sender, $elements);
                break;
            case "scroll":
                $this->sendGenericResponse($sender, $elements);
                break;
            case "processing":
                $this->sendTypingOn($sender);
                break;
            case "receipt":
                $receiptElements = array(
                    $this->buildReceiptElement("Numa Premium Subscription", "One year Numa Pro subscription for you "
                            . " and your family", url("/") . "/public/uploads/numa_bill.jpg", 1, 3000.0)
                );
                $this->sendReceiptResponse($sender, $receiptElements);
                break;
            case "quick":
                $quickReplyElements = array(
                    $this->buildQuickReplyElement("text", "Connect", NULL, "Connect"),
                    $this->buildQuickReplyElement("text", "Protect", NULL, "Protect"),
                    $this->buildQuickReplyElement("text", "Pro", NULL, "Pro")
                );
                $this->sendQuickReplyResponse($sender, "Please select your desired package:", $quickReplyElements);
                break;
            case "free":
                $quickReplyElementsFree = array(
                    $this->buildQuickReplyElement("text", "Yes", NULL, "Yes, i love free stuff"),
                    $this->buildQuickReplyElement("text", "No", NULL, "No, i'm not from Freetown")
                );
                $this->sendQuickReplyResponse($sender, "You're Oliver Twist huh! You always want more?", $quickReplyElementsFree);
                break;
            case "Yes, i love free stuff":
                $this->sendTextResponse($sender, 'Oh I see! You\'re the dude from Freetown');
                break;
            case "No, i'm not from Freetown":
                $this->sendTextResponse($sender, 'Oh! I see. Lier!!!');
                break;
            case "location":
                $this->sendLocationResponse($sender);
                break;
            case "More random stuffs please":
                $actions = array("list", "scroll", "location", "text", "buttons", "receipt", "quick",
                    "free", "More random stuffs please");
                $rand = mt_rand(0, 8);
                $this->switchSend($sender, $user, $actions[$rand]);
                if ($rand != 7 && $rand != 2 && $rand != 6) {
                    $quickReplyElementsFree = array(
                        $this->buildQuickReplyElement("text", "Yes", NULL, "More random stuffs please")
                    );
                    $this->sendQuickReplyResponse($sender, "More random stuffs?", $quickReplyElementsFree);
                }
                break;
            default:
                $default_buttons = array(
                    $this->buildPostBackButton("Scrolling Articles", "scroll"),
                    $this->buildPostBackButton("Receipt", "receipt"),
                    $this->buildPostBackButton("Random Stuffs", "More random stuffs please")
                );
                $this->sendButtonResponse($sender, 'Hey ' . $user['firstname'] . '! I\'m a young Bot'
                        . ' still under training. '
                        . 'Anyways you can play around by typing any of the words: '
                        . ' Text, Buttons, Scroll, List, Processing, Receipt, Quick, Location'
                        , $default_buttons);
                break;
        }
    }

    public function sendTypingOn($recepient_id) {
        $messageData = array(
            "recipient" => array(
                "id" => $recepient_id
            ),
            "sender_action" => "typing_on"
        );
        $this->sendMessage($messageData);
    }

    public function sendTextResponse($recepient_id, $msg) {
        $messageData = array(
            "recipient" => array(
                "id" => $recepient_id
            ),
            "message" => $this->buildMessage("text", $msg, NULL, NULL)
        );
        $this->sendMessage($messageData);
    }

    public function sendButtonResponse($recepient_id, $msg, $buttons) {
        $messageData = array(
            "recipient" => array(
                "id" => $recepient_id
            ),
            "message" => $this->buildMessage("button", $msg, $buttons, NULL),
        );
        //Log::info(json_encode($messageData));
        $this->sendMessage($messageData);
    }

    public function sendGenericResponse($recepient_id, $elements) {
        $messageData = array(
            "recipient" => array(
                "id" => $recepient_id
            ),
            "message" => $this->buildMessage("generic", NULL, NULL, $elements)
        );
        $this->sendMessage($messageData);
    }

    public function sendListResponse($recepient_id, $elements) {
        $messageData = array(
            "recipient" => array(
                "id" => $recepient_id
            ),
            "message" => $this->buildMessage("list", NULL, NULL, $elements, "large")
        );
        $this->sendMessage($messageData);
    }

    public function sendQuickReplyResponse($recepient_id, $msg, $elements) {
        $messageData = array(
            "recipient" => array(
                "id" => $recepient_id
            ),
            "message" => $this->buildMessage("quick_reply", $msg, NULL, $elements, "large")
        );
        $this->sendMessage($messageData);
    }

    public function sendReceiptResponse($recepient_id, $elements) {
        $messageData = array(
            "recipient" => array(
                "id" => $recepient_id
            ),
            "message" => $this->buildMessage("receipt", NULL, NULL, $elements, "large")
        );
        $this->sendMessage($messageData);
    }

    public function sendLocationResponse($recepient_id) {
        $messageData = array(
            "recipient" => array(
                "id" => $recepient_id
            ),
            "message" => $this->buildMessage("location", NULL, NULL, NULL, "large")
        );
        $this->sendMessage($messageData);
    }

    public function buildLoginButton($url) {
        return [
            "type" => "account_link",
            "url" => $url
        ];
    }

    public function buildUrlButton($title, $url) {
        return ["type" => "web_url",
            "title" => $title,
            "url" => $url,
            "webview_height_ratio" => "full",
            "messenger_extensions" => true
        ];
    }

    public function buildPostBackButton($title, $payload) {
        return ["type" => "postback",
            "title" => $title,
            "payload" => $payload
        ];
    }

    public function buildDefaultActionButton($url, $fallback_url, $height_ratio = "tall") {
        return ["type" => "web_url",
            "url" => $url
        ];
    }

    public function buildScrollElement($title, $subtitle, $image_url, $default_action, $buttons) {
        return ["title" => $title,
            "subtitle" => $subtitle,
            "image_url" => $image_url,
            "default_action" => $default_action,
            "buttons" => $buttons
        ];
    }

    public function buildReceiptElement($title, $subtitle, $image_url, $qty, $price) {
        return ["title" => $title,
            "subtitle" => $subtitle,
            "image_url" => $image_url,
            "quantity" => $qty,
            "price" => $price,
            "currency" => "USD"
        ];
    }

    public function buildQuickReplyElement($contentType, $title, $image_url = NULL, $payload) {
        return [
            "content_type" => $contentType,
            "title" => $title,
            "payload" => $payload
        ];

//        return [
//            "content_type" => $contentType,
//            "title" => $title,
//            "image_url" => $image_url,
//            "payload" => $payload
//        ];
    }

    public function buildMessage($type, $msg = NULL, $buttons = NULL, $elements = NULL, $topElementStyle = "large") {
        if ($type === "text") {
            return array(
                "text" => $msg
            );
        } else if ($type === "button") {
            return array(
                "attachment" => array(
                    "type" => "template",
                    "payload" => array(
                        "template_type" => "button",
                        "text" => $msg,
                        "buttons" => $buttons
                    )
                )
            );
        } else if ($type === "generic") {
            return array(
                "attachment" => array(
                    "type" => "template",
                    "payload" => array(
                        "template_type" => "generic",
                        "elements" => $elements
                    )
                )
            );
        } else if ($type === "list") {
            return array(
                "attachment" => array(
                    "type" => "template",
                    "payload" => array(
                        "template_type" => "list",
                        "top_element_style" => $topElementStyle,
                        "elements" => $elements
                    )
                )
            );
        } else if ($type === "receipt") {
            return array(
                "attachment" => array(
                    "type" => "template",
                    "payload" => array(
                        "template_type" => "receipt",
                        "recipient_name" => "Tunde Michael",
                        "order_number" => "09089282727",
                        "currency" => "USD",
                        "payment_method" => "MasterCard 6626",
                        "order_url" => url("/"),
                        "timestamp" => "1428444852",
                        "elements" => $elements,
                        "summary" => array(
                            "total_cost" => 3000.0
                        )
                    )
                )
            );
        } else if ($type === "quick_reply") {
            return array(
                "text" => $msg,
                "quick_replies" => $elements
            );
        } else if ($type === "location") {
            return array(
                "text" => "Please share your location",
                "quick_replies" => array(
                    array(
                        "content_type" => "location"
                    )
                )
            );
        }
    }

    public function sendMessage($messageData) {
        $access_token = "EAAO5ZBynAs7EBAIm8U3Bk7dR0hThj1sqlV6xAZAx1O4iQfDNZBGAqJM7ZB5LQur5y7CMdzEaRSEZB9um61OBgyEhXfzkuXFNoTm81WJlJO4yirzphWYc3ZAuFctTC33UmipcPdwIM8rKFp83cVbLCLlcKFpeSg4BpVtHt0u0ylEQZDZD";
        $numa_access_token = "EAAXoenlm644BACXNrZCm3nNXXtV0Tc5nvX0ja3nKjXxjioky63GqSE5ceKhZCCKQWR2Q0PmcMl6fq36O71TsW7Dl7hyqpa6cmp0rRXJsZBgutVJT5frbVJhKPgSSnUBvVZCymrbn03ZBPC5o8W4qoCvNYrzhW3pSVqawPTemMTQZDZD";
        $verify_token = "tundemichael";
        $json = json_encode($messageData);
        //Log::info('Message -->  ' . $json);

        $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $numa_access_token;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);

        //Log::info('Facebook Response -->  ' . json_decode($result));
    }

    public function getUserInfoFromFacebook($sender) {
        $numa_access_token = "EAAXoenlm644BACXNrZCm3nNXXtV0Tc5nvX0ja3nKjXxjioky63GqSE5ceKhZCCKQWR2Q0PmcMl6fq36O71TsW7Dl7hyqpa6cmp0rRXJsZBgutVJT5frbVJhKPgSSnUBvVZCymrbn03ZBPC5o8W4qoCvNYrzhW3pSVqawPTemMTQZDZD";
        $url = 'https://graph.facebook.com/v2.6/' . $sender .
                '?fields=first_name,last_name,gender&access_token='
                . '' . $numa_access_token;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        //Log::info('Facebook Response -->  ' . $result);
        return $result;
    }

    public function whiteListDomain() {
        $numa_access_token = "EAAXoenlm644BACXNrZCm3nNXXtV0Tc5nvX0ja3nKjXxjioky63GqSE5ceKhZCCKQWR2Q0PmcMl6fq36O71TsW7Dl7hyqpa6cmp0rRXJsZBgutVJT5frbVJhKPgSSnUBvVZCymrbn03ZBPC5o8W4qoCvNYrzhW3pSVqawPTemMTQZDZD";
        $messageData = array(
            "setting_type" => "domain_whitelisting",
            "whitelisted_domains" => array(
                "https://www.asknuma.com"
            ),
            "domain_action_type" => "add"
        );
        $json = json_encode($messageData);
        Log::info('Message -->  ' . $json);

        $url = 'https://graph.facebook.com/v2.6/me/thread_settings?access_token=' . $numa_access_token;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);

        //Log::info('Facebook Response -->  ' . json_decode($result));
    }

    public function getStartedButtonSetup() {
        $numa_access_token = "EAAXoenlm644BACXNrZCm3nNXXtV0Tc5nvX0ja3nKjXxjioky63GqSE5ceKhZCCKQWR2Q0PmcMl6fq36O71TsW7Dl7hyqpa6cmp0rRXJsZBgutVJT5frbVJhKPgSSnUBvVZCymrbn03ZBPC5o8W4qoCvNYrzhW3pSVqawPTemMTQZDZD";
        $messageData = array(
            "setting_type" => "call_to_actions",
            "thread_state" => "new_thread",
            "call_to_actions" => array(
                array(
                    "payload" => "first_timer"
                )
            )
        );
        $json = json_encode($messageData);
        //Log::info('Message -->  ' . $json);

        $url = 'https://graph.facebook.com/v2.6/me/thread_settings?access_token=' . $numa_access_token;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);

        Log::info('Facebook Response -->  ' . $result);
    }

    public function setupPersistentMenu() {
        $numa_access_token = "EAAXoenlm644BACXNrZCm3nNXXtV0Tc5nvX0ja3nKjXxjioky63GqSE5ceKhZCCKQWR2Q0PmcMl6fq36O71TsW7Dl7hyqpa6cmp0rRXJsZBgutVJT5frbVJhKPgSSnUBvVZCymrbn03ZBPC5o8W4qoCvNYrzhW3pSVqawPTemMTQZDZD";
        $messageData = array(
            "setting_type" => "call_to_actions",
            "thread_state" => "existing_thread",
            "call_to_actions" => array(
                array(
                    "type" => "web_url",
                    "title" => "Numa FAQs",
                    "url" => url("/") . "/FAQ",
                    "webview_height_ratio" => "full",
                    "messenger_extensions" => true
                ),
                array(
                    "type" => "web_url",
                    "title" => "Numa Blog",
                    "url" => url("/") . "/blog",
                    "webview_height_ratio" => "full",
                    "messenger_extensions" => true
                ),
                array(
                    "type" => "web_url",
                    "title" => "Numa Home",
                    "url" => url("/"),
                    "webview_height_ratio" => "full",
                    "messenger_extensions" => true
                )
                ,
                array(
                    "type" => "web_url",
                    "title" => "Sigup to Numa",
                    "url" => url("/signup"),
                    "webview_height_ratio" => "full",
                    "messenger_extensions" => true
                )
                ,
                array(
                    "type" => "web_url",
                    "title" => "Login to Numa",
                    "url" => url("/signin"),
                    "webview_height_ratio" => "compact",
                    "messenger_extensions" => true
                )
            )
        );
        $json = json_encode($messageData);
        Log::info('Message -->  ' . $json);

        $url = 'https://graph.facebook.com/v2.6/me/thread_settings?access_token=' . $numa_access_token;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);

        Log::info('Facebook Response -->  ' . $result);
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

    public function getUser($sender) {
        $users = DB::table('platform_user')
                ->select(['id', 'firstname', 'lastname'])
                ->where('fb_messanger_psid', '=', $sender)
                ->get();
        if (empty($users)) {
            $storeId = $this->getStoreId();
            return $this->registerUser($storeId, $sender);
        }
        return array(
            "id" => $users[0]->id,
            "firstname" => $users[0]->firstname,
            "lastname" => $users[0]->lastname
        );
    }

    public function registerUser($store_id, $sender) {
        $response = $this->getUserInfoFromFacebook($sender);
        $id = $this->getNextId('platform_user');
        //Log::info('Facebook Response -->  ' . $response);
        $data = json_decode($response, TRUE);
        DB::table('platform_user')->insert(
                [
                    'id' => $id,
                    'user_type' => 'HUMAN',
                    'store_id' => $store_id,
                    'fb_messanger_psid' => $sender,
                    'firstname' => $data['first_name'],
                    'lastname' => $data['last_name'],
                    'date_created' => date('Y-m-d H:i:s')
                ]
        );
        return array(
            "id" => $id,
            "firstname" => $data['first_name'],
            "lastname" => $data['last_name']
        );
    }

    public function getChatSession($userId) {
        $conversation = DB::table('conversation')
                ->select('id')
                ->where('owner_id', '=', $userId)
                ->get();
        if (empty($conversation)) {
            $storeId = $this->getStoreId();
            $conversationId = $this->getNextId('conversation');
            DB::table('conversation')->insert(
                    [
                        'id' => $conversationId,
                        'store_id' => $storeId,
                        'owner_id' => $userId,
                        'date_started' => date('Y-m-d H:i:s')
                    ]
            );
            $sessionStarted = date('Y-m-d H:i:s');
            $chatSessionId = $this->getNextId('chat_session');
            DB::table('chat_session')->insert(
                    [
                        'id' => $chatSessionId,
                        'conversation_id' => $conversationId,
                        'chat_session_owner_id' => $userId,
                        'status' => 'ACTIVE',
                        'max_idle_time' => 15,
                        'start_date' => $sessionStarted
                    ]
            );
            return array(
                "id" => $chatSessionId,
                "conversation_id" => $conversationId,
                'status' => 'ACTIVE',
                'max_idle_time' => 15,
                'start_date' => $sessionStarted
            );
        } else {
            $conversationId = $conversation[0]->id;
            $chatSession = DB::table('chat_session')
                    ->select(['id', 'status', 'start_date', 'max_idle_time'])
                    ->where('conversation_id', '=', $conversationId)
                    ->where('status', '=', "ACTIVE")
                    ->orderBy('start_date', "DESC")
                    ->limit(1)
                    ->get();
            if (empty($chatSession)) {
                $sessionStarted = date('Y-m-d H:i:s');
                $chatSessionId = $this->getNextId('chat_session');
                DB::table('chat_session')->insert(
                        [
                            'id' => $chatSessionId,
                            'conversation_id' => $conversationId,
                            'chat_session_owner_id' => $userId,
                            'status' => 'ACTIVE',
                            'max_idle_time' => 15,
                            'start_date' => $sessionStarted
                        ]
                );
                return array(
                    "id" => $chatSessionId,
                    "conversation_id" => $conversationId,
                    'status' => 'ACTIVE',
                    'max_idle_time' => 15,
                    'start_date' => $sessionStarted
                );
            } else {
                $chatSessionId = $chatSession[0]->id;
                return array(
                    "id" => $chatSessionId,
                    "conversation_id" => $conversationId,
                    'status' => $chatSession[0]->status,
                    'max_idle_time' => $chatSession[0]->max_idle_time,
                    'start_date' => $chatSession[0]->start_date
                );
            }
        }
    }

    public function saveMessage($user, $message, $attach) {
        $sessionStarted = date('Y-m-d H:i:s');
        $botId = $this->getBotId();
        $messageId = $this->getNextId('message');
        DB::table('message')->insert(
                [
                    'id' => $messageId,
                    'message' => $message,
                    'attachment_url' => $attach,
                    'conversation_id' => $user['chat_session']['conversation_id'],
                    'sender_id' => $user['id'],
                    'msg_type' => 'SINGLE',
                    'msg_group_id' => NULL,
                    'receiver_id' => $botId,
                    'chat_session_id' => $user['chat_session']['id'],
                    'date_sent' => $sessionStarted
                ]
        );
    }

}
