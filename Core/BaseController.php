<?php

namespace Core;

class BaseController extends Controller{

    protected $router;
    protected $controller, $action, $request;


    public function __construct(){

        //------- ruter ---------
        $this->router = Router::getInstance();
        parent::__construct($this->action, $_GET);
        $this->defaultSettings();
        session_start();

        // var_dump(ROOT_DIR);
        // exit;
        // if(!isset($_SESSION['log_in'])){
        //     header("Location: ".ROOT_DIR);
        // }

    }

    protected function defaultSettings(){

        //default controller homeController 
        if($this->router->controller == ""){
            $this->controller = 'App\Controllers\HomeController';
        } else {
            // init controller
            $this->controller = 'App\Controllers\\'.$this->router->controller;
        }
        //default action
        if($this->router->action == ""){
            $this->action = 'index';
        } else {
            // init action
            $this->action = $this->router->action;
        }
    }
}