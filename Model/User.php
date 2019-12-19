<?php


namespace Model;


class User
{
    public $name = "";
    public $password = "";
    public $online = 0;

    public function __construct($name="",$password="", $online = 0){
        $this->name = $name;
        $this->password = $password;
        $this->online = $online;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getOnline(){
        return $this->online;
    }

    public function setOnline($online){
        $this->online = $online;
    }
}