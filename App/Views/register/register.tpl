{include file="../layouts/header.tpl"}

<form id="register_id" action="">
  
      <label for="name">Name:</label>
      <input type="text" name="name" id="name" value="{if isset($smarty.post.name)}{$smarty.post.name}{/if}">

      <label for="email">Email:</label>
      <input type="text" name="email" id="email" value="{if isset($smarty.post.email)}{$smarty.post.email}{/if}">

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="">

      <label for="password_confurm">confurm password:</label>
      <input type="password" name="password_confurm" id="password_confurm" value="">

      <input type="submit" name="submit" value="register">
  </form>
<div id="msg">
</div>

{include file="../layouts/footer.tpl"}


<script language="JavaScript" type="text/javascript">


    // ----------------- REGISTER -----------------------
    $(document).on('submit','#register_id' , function(e) {
    e.preventDefault();
        $.ajax({
            url: "{$smarty.const.SITE_URL}/registercontroller/create",
            type:'POST',
            data: $( this ).serialize(),
            dataType:"json",
            success: function(response){
              if(response.success){
                $("#msg" ).empty();
                $("#msg" ).append('SUCCESS');
                // REDIRECT TO HOME MAYBE
              }else{
                $("#msg" ).empty();
                $("#msg" ).append((response.errors).join('<br>'));
                }
            }
        });
    });

</script>