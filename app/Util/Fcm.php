<?php

namespace App\Util;



class Fcm{

    static function sendPush($deviceToken, $title, $body){
        $firebaseToken  = [$deviceToken];
        $SERVER_API_KEY = env('FCM_SERVER_API_KEY');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,  
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];


        try{

            $ch = curl_init();
      
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = json_decode(curl_exec($ch));
            if ($response->success == 1) {
                return true;
            }else{
                return false;
            }
        }catch(\Exception $e){
            return false;
        }


    }
   
}
