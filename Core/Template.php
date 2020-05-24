<?php

namespace Core;

require_once 'Config/Config.php';
require_once dirname(__fILE__).'/smarty/Smarty.class.php';

class Template extends \Smarty  {
    private static $instance;
    private  $viewdir;



    public function __construct(){
        parent::__construct();
        $this->setTemplateDir(VIEW_DIR);
        $this->setCompileDir(VIEW_DIR_COMPILE);
        // $this->setCacheDir(CACHE_DIR);
        // $this->setCacheDir(CACHE_DIR);



        // $this->debugging = false;
        // $this->caching = false;
    }



    public static function getInstance($init = 0){
        if(empty(self::$instance)){
            self::$instance = new template($init);
        }
        return self::$instance;
    }

    public function show($name){
        $path = VIEW_DIR.'/'.$name.'.tpl';
        if (file_exists($path) == false) {
            throw new Exception('View not found in '. $path);
            return false;
        } else{
            $this->display($path);
        }

    }

}