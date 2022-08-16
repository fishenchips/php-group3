<?php

class Message {

    public $id;
    public $customer_id;
    public $user;
    public $message;


    public function __construct($customer_id, $user, $message, $id = 0)
    {
        if($id > 0) {
            $this->id = $id;
        }
        $this->customer_id = $customer_id;
        $this->user = $user;
        $this->message = $message;
    }

    public function __toString() {
        return "{$this->user} {$this->message}";
    }
}