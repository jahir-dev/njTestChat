<?php


namespace Repository;

use Repository\Config;
use Model\User;

class UserRepository
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
            echo 'Connexion failed : ' . $e->getMessage();
        }
    }

    /**
     * get all the users
     */
    public function getUsers($username){
        //$query = $this->pdo->query("SELECT * FROM user");
        $query = $this->pdo->prepare("SELECT username, online  FROM user WHERE username != :username");
        $query->execute([':username' => $username]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * verify user credentials
     */
    public function auth($username, $password){
        $query = $this->pdo->prepare("SELECT * FROM user where username = :username and password = md5(:password)");
        $query->execute([':username' => $username, ':password' => $password]);
        $query->setFetchMode(\PDO::FETCH_CLASS, 'User');
        return $query->fetch();

    }

    /**
    * check if a username is used
    */
    public function checkUser($username){
        //$query = $this->pdo->query("SELECT * FROM user");
        $query = $this->pdo->prepare("SELECT username FROM user WHERE username = :username");
        $query->execute([':username' => $username]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
    * insert a user in the database
    */
    public function register($username, $password){
        $query = $this->pdo->prepare("INSERT INTO user (username, password) VALUES (:username, md5(:password))");
        $query->execute([':username' => $username, ':password' => $password]);
        if($query->rowCount() > 0){
            //user registred in the database
            return true;
        }else{
            return false;
        }
    }

    /**
     * Set the user status 'online' to true or false;
     */
    public function setOnline($username, $status){
        $query = $this->pdo->prepare("Update user set online = :status where username = :username");
        $query->execute([':status' => $status, ':username' => $username]);
        //var_dump($query->errorCode());
        if($query->rowCount() > 0){
            //user's status changed
            return true;
        }else{
            return false;
        }
    }
}