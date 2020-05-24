
{include file="layouts/header_survey.tpl"}

{foreach $questions as $question}
    <fieldset id="question1" data-id="{$question.id}">
        <legend>{$question.text}</legend>
        {foreach $answers as $answer}
            {if $answer.question_id eq $question.id}
                <label><INPUT TYPE="checkbox" NAME="input" data-answertext="{$answer.text}" data-istrue="{$answer.is_true_answer}" data-id="{$answer.id}" VALUE="wrong">{$answer.text}<BR></label>
            {/if}
        {/foreach}
    <h3 id="answer_{$question.id}"></h3>
    <h2 id="results_{$question.id}"></h2>
    </fieldset>
    <input type="button" class="answer" data-id="{$question.id}"  value="Save">
    <input type="button" class="submission" data-id="{$question.id}" value="Submission">
{/foreach}

    <br/><br/><br/><br/><br/><br/>
    <h2 id="submit_msg"></h2>
    <input type="button" id="save_all_id" data-id="save_all_id"  value="Submit All Your Answers">
<script language="JavaScript" type="text/javascript">

    // ----------------- SUBMIT -----------------------
    $( "#save_all_id" ).click(function() {
            $("#submit_msg").empty();
            $.ajax({
                url: "{$smarty.const.SITE_URL}homecontroller/create",
                type:'GET',
                dataType:"json",
                success: function(response){
                    if(response.success){
                        location.replace('/mvc/core_one/useranswerscontroller/read');
                    } else {
                        if(response.error_answers) {
                            $("#submit_msg").empty();
                            $("#submit_msg").append(response.error_answers);
                            setTimeout(function(){ 
                                $("#submit_msg").empty();
                            }, 5000);
                        } else {
                            $("#submit_msg").empty();
                            $("#submit_msg").append(response.error_db);
                            setTimeout(function(){ 
                                $("#submit_msg").empty();
                            }, 5000);
                        }

                    }
                }
            });
    

    });

    // ----------------- ANSWER -----------------------
    $( ".answer" ).click(function() {

        var question = $(this);
        var answers = [];
        var data = {};
        var question_id = question.data('id');

        $('input[type=checkbox]:checked').each(function () {
            if($(this).closest("fieldset").data('id') === question.data('id')){
                let answer_id = $(this).data('id')

                answers.push(answer_id);
                data[question_id] =  answers;

            }
        });
        if(typeof data[question_id] !== 'undefined'){
            $.ajax({
                url: "{$smarty.const.SITE_URL}homecontroller/update",
                type:'GET',
                data: { 'question':data } ,
                success: function(response){
                    $("#results_" + question_id).empty();
                    $("#results_" + question_id).append('Committed');
                    setTimeout(function(){ 
                        $("#results_" + question_id).empty();
                    }, 1500);
                    question.prop('value', 'Update');
                }
            });
        }
    

    });


    // -------------- SUBMISSION -----------------------
    $( ".submission" ).click(function() {
        var question = $(this);
        var question_id = question.data('id');
        var data = {};


        UnCheckedAll(question);

        data[question_id] =  'submission';
        $.ajax({
            url: "{$smarty.const.SITE_URL}homecontroller/update",
            type:'GET',
            data: { 'question': data } ,
            success: function(response){
                console.log(response);
                $("#results_" + question_id).empty();
                //$("#results_" + question_id).append('Submission');
                $('input.answer[data-id='+ question_id +']').prop('disabled', true);
                GiveAnswers(question);
            }
        });

    });


    // Uncheck all checkbox in fieldset
    function UnCheckedAll(question){
        $('input[type=checkbox]:checked').each(function () {
            if($(this).closest("fieldset").data('id') === question.data('id')){
                $(this).prop("checked", false);
            }
        });
    }


    // Give Answers
    function GiveAnswers(question){
        var question_id = question.data('id');

        $("#answer_" + question_id).empty();
        $("#answer_" + question_id).append('Correct answers:<br>');
        $('input[type=checkbox]').each(function () {
            if($(this).closest("fieldset").data('id') === question.data('id')){
                if ($(this).data('istrue') == '1'){
                $("#answer_" + question_id).append('<br/>' + $(this).data('answertext'));
                }
            }
        });
    }

</script>


{include file="layouts/footer.tpl"} 