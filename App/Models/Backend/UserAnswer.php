<?php

namespace Models;
use Core\Model;
use \PDO;


class UserAnswer{
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

        if(isset($_SESSION['question']) && count($_SESSION['question']) > 0){

            $user_id = $_SESSION['user'][0]['id'];

            $this->db->query('INSERT INTO users_answers(user_id, answer_id) VALUES(:user_id, :answer_id)');
            $this->db->bind(':user_id', $user_id);

            foreach($_SESSION['question'] as $question_id){
                if(is_array($question_id) && count($question_id) > 0){
                    foreach($question_id as $answer_id){
                        // $sql .="(".$user_id.", ".$answer_id."),";
                        // $question_id = $answer_id;
                        $this->db->bind(':answer_id', $answer_id);
                        $this->db->execute();
    
                    }
                } elseif(!is_array($question_id) && count($_SESSION['question']) == 1) {
                    $submission = true;
                }

            }
        } else {
            return ['error_answers' => 'No answers entered', 'success' => false];
        }

        if($this->db->get_error()){
            return ['error_db' => $this->db->get_error(), 'success' => false];
        } elseif(!$this->db->get_error() && isset($submission)) {
            return ['error_answers' => 'No answers entered SUBMISSION is not an Answer', 'success' => false];
        } else {
            return ['error_db' => false, 'success' => true];

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

    public function get_statistics(){
        $db = Model::getInstance();


        $this->db->query('SELECT COUNT(u.answer_id) as num, a.text as answer, q.text as question, q.id as question_id FROM users_answers as u
                        LEFT JOIN answers as a ON(a.id = u.answer_id)
                        LEFT JOIN questions as q ON(a.question_id = q.id)

                        GROUP BY u.answer_id');

        $row = $this->db->resultset();
        // var_dump('<pre>',$row);
        return $row;
        
    }
}