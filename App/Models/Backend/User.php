<?php

namespace Models;
use Core\Model;
use \PDO;


class User{
    private static $instance = false;
    private $db;


    function __construct(){
        $this->db = Model::getInstance();
    }


    //   -------------INSTANCE-------------
    public static function getInstance() {
        if (!self::$instance)
                self::$instance =  new self();
        
        return self::$instance;
    }



    
    public function add(){
        $post = filter_Input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $post['password'] = md5($post['password']);
        if($post){
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $this->db->bind('name',            $post['name'],     PDO::PARAM_STR);
            $this->db->bind('email',           $post['email'],     PDO::PARAM_STR);
            $this->db->bind('password',        $post['password'], PDO::PARAM_STR);
            $this->db->execute();
        }
        
    }

    public function get_user($user, $password){
        $db = Model::getInstance();


        $this->db->query('SELECT * FROM users
                            WHERE  `email`=:email && `password`=:password');
        $this->db->bind('email',            $user,     PDO::PARAM_STR);

        $this->db->bind('password',            $password,     PDO::PARAM_STR);

        $row = $this->db->resultset();
  
        return $row;
        
    }
}