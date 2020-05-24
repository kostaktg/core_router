<?php

namespace App\Controllers;

use Models\User;
use Core\Controller;


class LoginController extends Controller{



    public function read(){
        session_start();

        $this->smarty->show('register/login');
    }

  // Routers can make all ptotected methods has been load only by Ajax XMLHttpRequest    
  protected function login(){

        $response=[];
        if(isset($_POST)){
            $model = new User;

            $user = $_POST['email'];
            $pass = md5($_POST['password']);

            $user = $model->get_user($user, $pass);

            if(isset($user) && count($user) > 0){
                $response['success'] = 'Now go to Survey To DO Test';

                // Start the session
                session_start();
                $_SESSION['log_in'] = TRUE;
                $_SESSION['user'] = $user;
                // End the session

            } else {
                $response['errors'][] ='Error Email or Password ';
            }

        print json_encode($response);
        }
    }

  // Routers can make all ptotected methods has been load only by Ajax XMLHttpRequest    
  protected function logout(){
        session_start();
        $response=[];

        if (isset($_SESSION['log_in'])) {
            unset($_SESSION);
            session_destroy();
            $response['success'] = 'Logout';
        }else{
            $response['errors'][] ='You are not Log in ';

        }
        print json_encode($response);

    }



}