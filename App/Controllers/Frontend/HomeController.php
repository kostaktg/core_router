<?php

namespace App\Controllers\Frontend;

use Models\Survey;
use Models\UserAnswer;
use Core\BaseController;


class HomeController extends BaseController{



    public function index(){
        
        // destroy the session JUST FOR EXAMPLE AND TESTS
        $this->smarty->show('/Frontend/home');

    }


    // Routers can make all ptotected methods has been load only by Ajax XMLHttpRequest    
    protected function create(){
        $model = UserAnswer::getInstance();
        $result = $model->add();
        echo json_encode($result);
        
    }


    // Routers can make all ptotected methods has been load only by Ajax XMLHttpRequest    
    protected function update(){
        // Start the session
        foreach($_GET['question'] as $key=>$question){
            if($question === 'submission'){
                $_SESSION['question'][$key] = $question;
            } else {
                foreach($question as $answer){
                    $answers[] = $answer;
                }
                $_SESSION['question'][$key] = $answers;
            }
        }

        echo json_encode($_SESSION);
    }
}