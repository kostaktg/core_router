{include file="../layouts/header.tpl"}

<form id="login_id" {if isset($smarty.session.log_in) && $smarty.session.log_in} style="display:none" {/if} action="" > 
    <div class="container col-md-6">

        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input">
            Check me out
          </label>
        </div>

        <input type="submit" class="btn btn-primary" value="Submit">

    </div>
</form>
<div id="msg">
</div>

      {include file="../layouts/footer.tpl"}



<script language="JavaScript" type="text/javascript">


    // ----------------- LOGIN -----------------------
    $(document).on('submit','#login_id' , function(e) {
    e.preventDefault();
        $.ajax({
            url: "{$smarty.const.SITE_URL}/logincontroller/login",
            type:'POST',
            data: $( this ).serialize(),
            dataType:"json",
            success: function(response){
              if(response.success){
                $("#msg" ).empty();
                $("#login_id" ).hide();
                location.reload();
                // REDIRECT TO HOME MAYBE
              }else{
                $("#msg" ).empty();
                $("#msg" ).append((response.errors).join('<br>'));
                }
            }
        });
    });

</script>