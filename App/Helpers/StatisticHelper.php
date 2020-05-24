<?php 

namespace App\Helpers;


class StatisticHelper {

    public function statistic($result){

        $questions = [];
        foreach($result as $answer){
            $questions[$answer['question']][] = $answer;  
        }
        $html = '';
        foreach($questions as $question_text=>$question){

            $html .= '<h2>'.$question_text.'</h2>';

            foreach($question as $answer){
                if($question_text == $answer['question'] ){
                    $html .= $answer['answer'].': ';

                    $html .= $this->get_persent(array_sum(array_column($question, 'num')), $answer['num']).'%';
                    $html .= ('<br>');

                }
            }
        }

        return $html;

    }

    function get_persent($total , $num){
        return round(($num*100)/$total);
    }

}
