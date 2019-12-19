<?php


namespace Model;


class Message
{
    public $message = "";
    public $from = "";
    public $to = "";

    public function __construct($message="",$from="",$to=""){
        $this->message = $message;
        $this->from = $from;
        $this->to = $to;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getFrom(){
        return $this->from;
    }

    public function getTo(){
        return $this->to;
    }

    public function setMessage($message){
        $this->message = $message;
    }

    public function setFrom($from){
        $this->from = $from;
    }

    public function setTo($to){
        $this->to = $to;
    }
}