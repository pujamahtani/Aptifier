<?php
class Message{
public function sendMessage($mobile_no, $message){

        $url = "http://api.msg91.com/api/sendhttp.php?country=91&sender=APPTII&route=4&mobiles=".$mobile_no."&authkey=264565AfyMHL3iHV5c724fbe&message=".$message;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    }
}


?>