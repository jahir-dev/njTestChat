<?php


namespace Repository;


class Config
{
        //config for the db connection
        public $dbname = 'njChat';
        public $user = 'root';
        public $password = '';


        public function getDsn()
        {
            return 'mysql:dbname='. $this->dbname. ';localhost:3308';;
        }
        public function getUser()
        {
            return $this->user;
        }
        public function getPassword()
        {
            return $this->password;
        }
}