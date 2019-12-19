<?php
require_once "vendor/autoload.php";

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));


$params = (isset($_GET['params'])) ? explode('/', $_GET['params']) : [];

//get the controller or set Login controller
$controller = "Controller\\" . ((isset($params[0])) ? ucfirst($params[0]) : 'Login');
$action = (isset($params[1])) ? $params[1] : 'index';
//var_dump($_GET['params']);
//die($controller);
if (class_exists($controller, true)) {
    if (!method_exists($controller, $action)) {
        //if the action doesn't exist then go to the index
        $action = 'index';
    }
    //create object $controller,
    // else call_user_fun_array will make a static call
    //and I cant use $this in the controller
    $controller = new $controller();
    call_user_func_array([$controller, $action], $params);
} else {
    $controller = "Controller\\Base";
    //create object $controller
    $controller = new $controller();
    call_user_func_array([$controller, $action], $params);
}