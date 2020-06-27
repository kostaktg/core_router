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


    public static function set($route, $controller=null, $action=null, $slug=null, $function=null){
        self::$validRoutes[] = $route;

        $url=explode('/',$_GET['url']??null);
        if(isset($url[1]) && $url[1]==='')unset($url[1]);
        if(isset($url[0]) &&  ltrim($url[0], '/') === ltrim($route , '/')){


            $url[0] = rtrim($url[0], '/');

            // if(isset($function)){
            //     $function->__invoke();
            // }
            /** Controoler */
            if(isset($controller)){
                self::$contr = ucfirst($controller).'Controller';
            } else {
                self::$contr = 'HomeController';
            }
            /** Action */
            if(isset($action) && isset($url[1]) && $action==$url[1]){
                self::$act = ucfirst($action);
            } elseif(isset($action) && isset($url[1]) && isset($slug) && $slug ==':slug' && $action!=$url[1]){
                self::$act = ucfirst($action);
            } else {
                self::$act = 'index';
            }

        } 

        if(!isset($url[0])){
            self::$contr = 'HomeController';
            self::$act = 'index';
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