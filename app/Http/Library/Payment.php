<?php

namespace App\Http\Library;

use URL;

class Payment {

    public static function get_url($data) {
        $access_token = 'sk_test_XKokBfNWv6FIYuTMg5sLPjhJ';
        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, "https://api.tap.company/v2/charges");
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_POST, true);
        curl_setopt($soap_do, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer ' . $access_token));
        $req_result = curl_exec($soap_do);
        $req_json = json_decode($req_result, true);
        $RedirectUrl = $req_json['transaction']['url'];
        curl_close($soap_do);
        return $RedirectUrl;
    }
    
    public static function check($id) {
        $access_token = 'sk_test_XKokBfNWv6FIYuTMg5sLPjhJ';
        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, "https://api.tap.company/v2/charges/".$id);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($soap_do, CURLOPT_POST, false);
        curl_setopt($soap_do, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer ' . $access_token));
        $req_result = curl_exec($soap_do);
        $req_json = json_decode($req_result, true);
        return $req_json;
    }

}

?>