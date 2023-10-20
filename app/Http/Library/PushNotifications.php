<?php

namespace App\Http\Library;

class PushNotifications {

    public static function android($topic, $message_data, $type) {
        $SERVER_KEY = "AAAAPmvsrKo:APA91bGyREbvzVD3PofxYwBsRKNDaghYgfeElmHycFBaIRxvGtib7PLUhfH2Rs85AgcUPJs8oeWX2TNYXvsbe4z4TIJk0I_DqojqnblRcde2LOQKbJxw4inJHAqNbgtmoHThC4CQ5nGG";
// Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        if ($type == 'topic') {
            $fields = array(
                'data' => $message_data,
                'to' => "/topics/" . $topic
            );
        } elseif ($type == 'many') {
            $fields = array(
                'data' => $message_data,
                'registration_ids' => $topic
            );
        } else {
            $fields = array(
                'data' => $message_data,
                'registration_ids' => [$topic]
            );
        }

        $headers = array(
            'Authorization: key=' . $SERVER_KEY,
            'Content-Type: application/json'
        );
// Open connection
        $ch = curl_init();
// Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
// Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
// Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            $res = 0;
        } else {
            $res = 1;
        }
// Close connection
        curl_close($ch);
        return $res;
    }

    public static function ios($topic, $message_data, $type) {
        $SERVER_KEY = "AAAAPmvsrKo:APA91bGyREbvzVD3PofxYwBsRKNDaghYgfeElmHycFBaIRxvGtib7PLUhfH2Rs85AgcUPJs8oeWX2TNYXvsbe4z4TIJk0I_DqojqnblRcde2LOQKbJxw4inJHAqNbgtmoHThC4CQ5nGG";

// Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
        $body = $message_data['alert'];
        $title = $message_data['title'];
        if($message_data['action'] == 'cart'){
            $notification = ["body" => $body, "title" => $title, "sound" => ""];
        }else{
            $notification = ["body" => $body, "title" => $title, "sound" => "default"];
        }
        if ($type == 'topic') {
            $fields = array(
                'notification' => $notification,
                'data' => $message_data,
                'to' => "/topics/" . $topic,
            );
        } elseif ($type == 'many') {
            $fields = array(
                'notification' => $notification,
                'data' => $message_data,
                'registration_ids' => $topic,
            );
        } else {
            $fields = array(
                'notification' => $notification,
                'data' => $message_data,
                'registration_ids' => [$topic],
            );
        }

        $headers = array(
            'Authorization: key=' . $SERVER_KEY,
            'Content-Type: application/json'
        );
// Open connection
        $ch = curl_init();
// Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
// Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
// Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            $res = 0;
        } else {
            $res = 1;
        }
// Close connection
        curl_close($ch);
        return $res;
    }

}

?>