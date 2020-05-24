<?php

namespace Models;
use Core\Model;

class Survey{
    private static $instance = false;
    private $db;

    function __construct(){
        $this->db     = Model::getInstance();
    }


    public static function getInstance() {
		if (!self::$instance)
			self::$instance =  new self();

	return self::$instance;
	}

    public function get_questions(){

        $db = Model::getInstance();
        $db->query('SELECT * FROM questions');
        $rows = $db->resultset();
  
    return $rows;
        
    }

    public function get_answers(){

        $db = Model::getInstance();
        $db->query('SELECT * FROM answers');
        $rows = $db->resultset();
  
    return $rows;
        
    }
}