<?php

class CurlException extends Exception {

    public function __construct($curl) 
    {
        $error = curl_error($curl);
        curl_close($curl);
        $this->message = $error;
    }

}