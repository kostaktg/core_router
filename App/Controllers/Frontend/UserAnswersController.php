<?php

namespace App\Controllers;

use Models\UserAnswer;
use App\Helpers\StatisticHelper;

use Core\Controller;


class UserAnswersController extends Controller{



    public function read(){
        $model = UserAnswer::getInstance();
        $result = $model->get_statistics();

        $helper = new StatisticHelper;
        $html = $helper->statistic($result);

        $this->smarty->assign('statistics',$html);

        $this->smarty->show('statistic');

    }



}