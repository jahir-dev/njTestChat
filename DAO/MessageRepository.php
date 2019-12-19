<?php


namespace Repository;

use Repository\Config;
use Model\Message;
class MessageRepository
{
    /**
     *	pdo connection instance
     */
    public $pdo;

    public function __construct ()
    {
        $config = new Config();
        try {
            $this->pdo = new \PDO($config->getDsn(), $config->getUser(), $config->getPassword());
        } catch (PDOException $e) {
            echo 'Connection failed : ' . $e->getMessage();
        }
    }

    /**
     * get all the messages of the connected user and who's chatting with
     */
    public function getMessages($connectedUser, $selectedUser){
        $query = $this->pdo->prepare("SELECT * FROM message where (user_from = :connectedUser or user_from = :selectedUser) and (user_to = :connectedUser or user_to = :selectedUser) ORDER BY id ASC");
        $query->execute([':connectedUser' => $connectedUser, ":selectedUser" => $selectedUser]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);

    }

    /*
    * save a sent message in the database
    */
    public function saveMessage($connectedUser, $selectedUser, $message){
        $query = $this->pdo->prepare("INSERT INTO message (user_from, user_to, message) VALUES (:connectedUser, :selectedUser, :message)");
        $query->execute([':connectedUser' => $connectedUser, ':selectedUser' => $selectedUser, ':message' => $message]);
        if($query->rowCount() > 0){
            //message saved in the database
            return true;
        }else{
            return false;
        }

    }
}