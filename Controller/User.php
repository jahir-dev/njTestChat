<?php


namespace Controller;


use Repository\UserRepository;

class User extends Base
{
    public $userRepo;
    public function __construct(){
        $this->userRepo = new UserRepository();
    }

    public function index(){
        session_start();
        $username = $_SESSION["username"];
        $users = $this->userRepo->getUsers($username);
        var_dump($users);
        //header('Location:View/login.php');
    }

    /*
    * function used in the chat to list the users
    */
    public function list(){
        session_start();
        $username = $_SESSION["username"];

        $users = $this->userRepo->getUsers($username);
        if($users){
            echo json_encode(['status' => 'ok', 'result' => $users]);
        }else{
            echo json_encode(['status' => 'error', 'result' => "An error has occured"]);
        }
    }

}