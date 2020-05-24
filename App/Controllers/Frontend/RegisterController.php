<?php

namespace App\Controllers;

use Models\User;
use Core\Controller;
use Core\Validate;



class RegisterController extends Controller{



    public function read(){

        $this->smarty->show('register/register');

    }

    // Routers can make all ptotected methods has been load only by Ajax XMLHttpRequest
    protected function create(){
        $response = [];

        if(isset($_POST)){
            $validate = Validate::getInstance();
            $validate = $validate->check($_POST, array(
                'name' => array(
                    'required'      => true,
                    'min'           => 2,
                    'max'           =>191,
                ),

                'email' => array(
                    'required'      => true,
                    'email'         => true,
                    'max'           => 191,
                    'unique'        => 'users',
                ),

                'password' => array(
                    'required'      => true,
                    'min'           => 6,
                    'max'           => 191,
                ),

                'password_confurm' => array(
                    'required'      =>true,
                    'min'           =>6,
                    'max'           =>191,
                    'matches'       =>'password',
                )

            ));

            if($validate->passed()){
                $viewmodel = User::getInstance();
                $viewmodel = $viewmodel->add();
                $response['success'] = true;   
            } else{
                foreach ($validate->errors() as $key => $value) {
                    $response['errors'][] = $value;
                }
               
            }



        }

        echo json_encode($response);
    }




}