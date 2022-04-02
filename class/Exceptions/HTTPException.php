<?php

class HTTPException extends Exception {

    public function __construct($data)
    {
        $data = json_decode($data, true);
        $this->message = $data['message'];
        $this->code = $data['cod'];
    }

}