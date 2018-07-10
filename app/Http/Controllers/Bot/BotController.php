<?php

/**
 * Created by PhpStorm.
 * User: SARAY
 * Date: 3/10/2018
 * Time: 3:25 PM
 */
namespace App\Http\Controllers\Bot;
use App\Http\Controllers\Controller;
class BotController extends Controller
{

    private $accessToken;
    private $senderId;
    private $recipient_id;
    private $messageArray;
    public function __construct()
    {
        $this->verifyBot();
        $this->accessToken = "EAAdRg1oVYy4BADZCW9I7jhhIma55B0EHDbMfREhYHt6rJwonbSTYwRQl2eWz9MX8To4sTBkJgHfhfrjlCGdYz9kZCooyqNmHplXy6SqRIkncaj2NBEZB5YEfaQfvZCAhbrHccBoqQJqBch2JG2kUq6GkWkg7HZBjxaq39p7UclVbRVrqSEDYG";
        $input = json_decode(file_get_contents('php://input'),true);
        var_dump($input);
        $this->senderId = $input["entry"][0]["messaging"][0]["sender"]["id"];
//        $this->messengerID = $input["entry"][0]["id"];
        $this->recipient_id = $input["entry"][0]["messaging"][0]["recipient"]["id"];
        $this->messageArray = $input["entry"][0]["messaging"][0];
    }

    public function botGetWay(){
        //        echo $recipient_id;
// $message = $input["entry"][0]["messaging"][0]["message"]["text"];


        if($this->isTextSendFirstTime($this->messageArray)){
            $this->send($this->accessToken,$this->sendFirstMessage($this->senderId,"Sarier is bras, undies, swim and more for every girl. We're here to help you feel like your best self, inside & out."));
            $this->send($this->accessToken,$this->sendFirstPostBackBtn($this->senderId,$this->recipient_id));
        }else{
            if(isset($this->messageArray["postback"]["payload"] ) && $this->messageArray["postback"]["payload"] == "SHOP_SARIER"){
                $this->send($this->accessToken,$this->sendFirstPostBackBtn($this->senderId));
            }
            if(isset($this->messageArray["postback"]["payload"]) && $this->messageArray["postback"]["payload"] == "CUSTOMER_SERVICE"){
                $this->send($this->accessToken,$this->customerService($this->senderId));
            }
        }

        if(isset($this->messageArray["message"])){
            if(isset($this->messageArray["message"]["is_echo"])){
                die();
            }else{
                $this->send($this->accessToken,$this->senderAction($this->senderId));
                $this->send($this->accessToken,$this->sendText($this->senderId,$this->messageArray["message"]["text"]));
            }
        }
    }


    private function verifyBot(){
        if(isset($_REQUEST['hub_challenge'])){
            $challenge = $_REQUEST['hub_challenge'];
            $verify_token = $_REQUEST['hub_verify_token'];
            if ($verify_token === 'sarier_token_code') {
                echo $challenge;
            }
        }
    }

    private function isTextSendFirstTime($messageArray){
        if(isset($messageArray["postback"])){
            if($messageArray["postback"]["payload"] == "GET_STARTED_PAYLOAD"){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    private function sendFirstMessage($senderId,$message){
        $jsonData = '{
      "recipient":{
        "id":"'.$senderId.'"
      },
      "message":{
        "text":"'.$message.'"
      }
    }';

        return $jsonData;
    }
    private function sendFirstPostBackBtn($senderId){

        $jsonData = '{
  "recipient":{
    "id":"'.$senderId.'"
  },
  "message":{
    "text": "What are you looking for today?",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Bra",
        "payload":"BRA",
        "image_url":"http://example.com/img/red.png"
      },
      {
        "content_type":"text",
        "title":"Underware",
        "payload":"UNDERWARE",
        "image_url":"http://example.com/img/red.png"
      },
      {
        "content_type":"location"
      },
      {
        "content_type":"text",
        "title":"Something Else",
        "payload":"SOMETHING_ELSE"
      }
    ]
  }
}';

        return $jsonData;
    }

    private function customerService($senderId){


        $jsonData = '{
  "recipient":{
    "id":"'.$senderId.'"
  },
  "message": {
    "attachment": {
      "type": "template",
      "payload": {
        "template_type": "button",
        "text": "Have a question about an order or need a little extra help? Our customer service team is here for you! You can call or email us any time. You can also email custserv@sarier.com directly and they\'ll get back to you asap.",
        "buttons": [
          {
            "type":"phone_number",
            "title":"📲 Call",
            "payload":"+85515704480"
          },
          { "type": "postback", "title": "📧 Email", "payload": "CUSTOMER_SERVICE_EMAIL" }
        ]
      }
    }
  }
}';

        return $jsonData;
    }

    private function sendText($senderId, $message){
        //
        $reply = "Right now I can understand only send, tell, give . and I can only reply you my name";
        if(preg_match('/(send|tell|text|give)(.*?)your/', $message)){

            $res = json_decode(file_get_contents("https://cambobot.herokuapp.com/json-data.php"),true);

            $reply = $res["first-name"];
        }

        $jsonData = '{
      "recipient":{
        "id":"'.$senderId.'"
      },
      "message":{
        "text":"'.$reply.'"
      }
    }';

        return $jsonData;

    }

    private function sendCard($senderId, $messagae){

        $jsonData = '{
      "recipient":{
        "id":"'.$senderId.'"
      },
      "message":{
        "attachment":{
          "type":"image", 
          "payload":{
            "url":"https://cloud.netlifyusercontent.com/assets/344dbf88-fdf9-42bb-adb4-46f01eedd629/68dd54ca-60cf-4ef7-898b-26d7cbe48ec7/10-dithering-opt.jpg"
          }
        }
      }
    }';

        return $jsonData;
    }

    private function senderAction($senderId){
        $jsonData ='{
  "recipient":{
    "id":"'.$senderId.'"
  },
  "sender_action":"typing_on"
}';
        return $jsonData;
    }

// echo $message." and ".$senderId;
    private function send($accessToken, $jsonData){

        // https://graph.facebook.com/v2.6/me/messages?access_token=<PAGE_ACCESS_TOKEN>
        $url = "https://graph.facebook.com/v2.6/me/messages?access_token=".$this->accessToken;

        $ch =curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        // if(!empty($input["entry"][0]["messaging"][0]["message"])){
        curl_exec($ch);
        // }
    }
}