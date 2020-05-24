<?php

namespace App\Controllers\Frontend;


use Core\BaseController;




class Error404Controller extends BaseController{



    public function Error(){
        
        // destroy the session JUST FOR EXAMPLE AND TESTS
        $this->smarty->show('/Frontend/error404');

    }


}