<?php 

namespace Core;



class Init{
    protected $router;
    private static $instance = false;
    private $controller, $action, $request;



// Check if is exists method and action 
    public function __construct(){
        //------- ruter ---------
        $this->router = Router::getInstance();
        $this->router->getController();
        //------- ruter END---------
     
        $this->defaultSettings();
        $this->createController();
    }


    //------------- create controller --------------
    protected function createController(){
        //Check is it a class exists
        if(class_exists($this->controller)){

            $parent = class_parents($this->controller);
            //Check Extend
            if(in_array("Core\Controller", $parent)){
                //Check is action exists
                if(method_exists($this->controller, $this->action)){

                    $controller = new $this->controller($this->action, $this->request);
                    $controller->executeAction();
                } else {
                    //Method does not exist
                    echo '<h1>Method does not exists</h1>';
                    return;
                }
            } else {
                // Base controller not found
                echo '<h1>Base controller does not found or does not Extended</h1>';
                return;
            }
        } else {
            // Controller Class Does Not Exist
            echo '<h1>Controller class does not exist</h1>';
            return;
        }

    }


    protected function defaultSettings(){
        $this->request = $_GET;

        //default controller homeController 
        if($this->router->controller == ""){
            $this->controller = FRONTEND_CONTROLLER_DIR.'\HomeController';
        } else {
            // init controller
            $this->controller = FRONTEND_CONTROLLER_DIR.'\\'.$this->router->controller;
        }
        //default action
        if($this->router->action == ""){
            $this->action = 'read';
        } else {
            // init action
            $this->action = $this->router->action;
        }
    }


}