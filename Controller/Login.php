<?php


namespace Controller;

use Repository\UserRepository;

class Login extends Base
{
    public $userRepo;
    public function __construct(){
        $this->userRepo = new UserRepository();
    }
    public function index(){
        $this->verifyAuth();
        $this->render('login');
    }

    /**
	*	Login function
	*/
    public function auth(){
        $this->verifyAuth();
        if(empty($_POST["username"]) ||  empty($_POST["password"])){
            return $this->render('login', ["errorLogin" => "Please specify a user and a password!!"]);
        }
        $username = $_POST["username"];
        $password = $_POST["password"];
        $user = $this->userRepo->auth($username,$password);
        if($user){
            //user found
            //start a session and redirect him to chat page
            $_SESSION["username"]=$username;
            $this->userRepo->setOnline($_SESSION['username'], 1);
            //$this->render('list');
            header('Location:/njTestChat/message');
        }else{
            return $this->render('login', ["errorLogin" => "Bad Credentials"]);
        }

    }

    /**
		* logout function
		* unset hte session and redirect to login page
		*/
    public function deauth(){
        session_start();
        if(isset($_SESSION['username'])){
            $this->userRepo->setOnline($_SESSION['username'], 0);
            unset($_SESSION['username']);
        }
        return $this->render('login');
    }

    /**
	* action used to register the user
	*/
    public function register(){
        //verify if there is already an authentified user then redirect to his panel
        $this->verifyAuth();
        if(empty($_POST["username"]) ||  empty($_POST["password"])){
            return $this->render('login', ["errorRegister" => "Please specify a user and a password!!"]);
        }

        $username = $_POST["username"];
        $password = $_POST["password"];
        $userExist = $this->userRepo->checkUser($username);

        if(!$password != "" || !$username != "")
            return $this->render('login', ["errorRegister" => "Please enter a username and a password"]);

        //check if the username is used
        if(!$userExist){
            //register the user
            $user = $this->userRepo->register($username, $password);
            if($user){
                //if the user has been registered then log him in
                $_SESSION["username"]=$username;
                header('Location:/njTestChat/message');
//                return $this->render('list');
            }else{
                //error while creating the user, go back to login/register
                return $this->render('login', ["errorRegister" => "An error occurred while registering! Please retry"]);
            }

        }else{
            //user already exists, go back to login
            return $this->render('login', ["errorRegister" => "Username taken"]);
        }
    }
}