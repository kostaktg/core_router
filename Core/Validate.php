<?php

namespace Core;
use Core\Model;


class Validate {
    private static $instance = false;
    private $_passed = false,
            $_errors = array(),
            $_db     = null;

    

    public function __construct() {
        if(!isset($_POST['gender'])){$_POST['gender']='';}
    }


    //   -------------INSTANCE-------------
    public static function getInstance() {
        if (!self::$instance)
            self::$instance =  new self();

    return self::$instance;
    }




    public function check($source, $items = array()){
        foreach ($items as $item => $rules) {
            foreach ($rules as $rules => $rule_value) {
                if ( !isset($source[$item]) ) {
                    $this->addError($item.' is required');
                    continue;
                }
                $value = trim($source[$item]);
                                
                if($rules === 'required' && empty($value)){
                    $this->addError("{$item} is required");
                }else if(!empty($value)){
                    switch($rules){
                       
                        case 'min':
                        $new = explode(" ", $value);
                        $new = implode("", $new);
                            if(strlen($new) < $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} characters");
                            }

                        break;
                        case 'max':
                        if(strlen($value) > $rule_value){
                            $this->addError("{$item} must be a maximum of {$rule_value} characters");
                        }

                        break;
                        case 'matches':
                            if($value != $source[$rule_value])
                                $this->addError("{$rule_value} must match {$item}");

                        break;
                        case 'unique':
                            $database = new Model;
                            // ADD TABLE NAME VERABLE TO USE ANATHER TABLE
                            $database->query("SELECT name FROM {$rule_value} WHERE {$item} = '$value' ");
                            $check = $database->resultset();
                            if(count($check)){
                                $this->addError("{$item} alredy exists.");   
                            }
                            

                        break;
                        case 'phone':
                        
                       
                            if (!preg_match("/^([0-9 \+]*)$/" , $value)){
                                 $this->addError("{$item} must by numerix");
                            }
                        
                        break;
                        case 'email':

                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
                            $this->addError("{$item} must by valid email");
                        }


                    }

                }
            }
            # code...
        }

        if(empty($this->_errors)){
            $this->_passed = true;
        }
        return $this;
    }

    public function addError($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }





}