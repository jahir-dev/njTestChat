<?php


namespace Controller;

use Repository\MessageRepository;
class Message extends Base
{
    public $msgRepo;

    public function __construct(){
        $this->msgRepo = new MessageRepository();
    }

    public function index(){
        session_start();
        if(!isset($_SESSION['username'])){
            header('Location:/njTestChat/login');
        }else{
            $this->render("list");
        }
    }

    /*
	* action used by ajax to list the messages
	*/
    public function list(){
        session_start();
        $connectedUser = $_SESSION['username'];
        $userTo = $_POST['user_to']; //user to which we are talking
        $messages = $this->msgRepo->getMessages($connectedUser, $userTo);

        if($messages){
            echo json_encode(['status' => 'ok', 'result' => $messages]);
        }else{
            echo json_encode(['status' => 'error', 'result' => "An error has occured"]);
        }
    }

    /*
    * action used by ajax to send the messages in the chat
    */
    public function send(){
        session_start();
        if (!isset($_SESSION['username']) || empty($_POST["user_to"]) || empty($_POST["message"])) {
            echo json_encode(['status' => 'error', 'result' => 'error']);
            return;
        }
        // the actual connected user
        $from = $_SESSION['username'];
        // the user we are talking to
        $to = $_POST["user_to"];
        $msg = $_POST["message"];

        $res = $this->msgRepo->saveMessage($from,$to,$msg);

        //if the message is sent the return sent else return error
        if($res){
            echo json_encode(['status' => 'ok', 'result' => 'sent']);
        }else{
            echo json_encode(['status' => 'error', 'result' => 'error']);
        }
    }

}