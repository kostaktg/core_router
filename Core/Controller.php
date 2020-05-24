<?php
namespace Core;

abstract class Controller{
    protected $request, $action, $smarty;


    public function __construct($action , $request){
        // var_dump($action , $request, $_GET);
        $this->action = $action;
        $this->request = $request;
        $this->smarty = Template::getInstance();

    }

    // chenge action verb to a function
    public function executeAction(){
        //return action like function
        return $this->{$this->action}($param = NULL);
    }



}