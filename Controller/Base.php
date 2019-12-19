<?php
namespace Controller;

class Base
{
    public function index()
    {
        $this->render('404');
    }

    public function render($view, $vars = null){
        if($vars) extract($vars);
        require ROOT.'View/'.$view.'.php';
    }

    /**
     * //verify if there is already an authentified user then redirect him to his panel
     */
    public function verifyAuth(){
        session_start();
        if (isset($_SESSION['username'])) {
            header('Location:/njTestChat/message');
        }
    }
}
