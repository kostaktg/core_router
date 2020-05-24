<?php

namespace Core;


class Router {

    private static $instance;
    private $path, $noerr;
    protected $args = array() , $file;
    public $controller, $action;
    protected static $contr, $act;
    public static $validRoutes= [];


    function __construct(){
    }


    public static function set($route, $controller=null, $action=null, $function){
        self::$validRoutes[] = $route;

       
        if(isset($_GET['url']) && $_GET['url'] === $route){
            $function->__invoke();
            /** Controoler */
            if(isset($controller)){
                self::$contr = ucfirst($controller).'Controller';
            } else {
                self::$contr = 'HomeController';
            }
            /** Action */
            if(isset($action)){
                self::$act = ucfirst($action);
            } else {
                self::$act = 'Index';
            }

        } 

    }


    public static function getInstance(){
        if(empty(self::$instance)){
            self::$instance = new router();
        }

        return self::$instance;
    }


    public function getController(){

        if(!isset(self::$contr) && !isset(self::$act )) {
            self::$contr = 'Error404Controller';
            self::$act = 'Error';
        }
        
        $this->controller   = self::$contr;
        $this->action       = self::$act;
    }







}