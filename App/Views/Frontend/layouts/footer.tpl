
<div class="backtotop"><a href="#0" class="cd-top">Top</a></div>
<script type="text/javascript" src="js/jquery-1.11.2.js"></script> 
<script type="text/javascript" src="js/function.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/modernizr.js"></script> 
<script type="text/javascript" src="js/slick.js"></script> 
<script type="text/javascript" src="js/stickyheader.js"></script> 
<script type="text/javascript" src="js/mega-dropdown.js"></script> 
<script type="text/javascript" src="js/backtotop.js"></script> 
<script type="text/javascript" src="js/parallax.js"></script> 
<script type="text/javascript" src="js/animation.js"></script> 
<script type="text/javascript" src="js/counter.js"></script> 
<script type="text/javascript" src="js/number-counter.js"></script> 
<script type="text/javascript" src="js/bootstrapValidator.js"></script> 
<script type="text/javascript" src="js/formValidation.js"></script> 
<!-- REVOLUTION JS FILES --> 
<script type="text/javascript" src="js/revoluation/jquery.themepunch.tools.min.js"></script> 
<script type="text/javascript" src="js/revoluation/jquery.themepunch.revolution.min.js"></script> 
<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
(Load Extensions only on Local File Systems ! 
The following part can be removed on Server for On Demand Loading) --> 
<script type="text/javascript" src="js/revoluation/revolution.extension.layeranimation.min.js"></script> 
<script type="text/javascript" src="js/revoluation/revolution.extension.migration.min.js"></script> 
<script type="text/javascript" src="js/revoluation/revolution.extension.navigation.min.js"></script> 
<script type="text/javascript" src="js/revoluation/revolution.extension.parallax.min.js"></script> 
<script type="text/javascript" src="js/revoluation/revolution.extension.slideanims.min.js"></script> 
<script type="text/javascript" src="js/revoluation/revoluationfunction.js"></script> 
<script type="text/javascript">
		var recaptcha2 ;
		var recaptcha1 ;
		var captchaContainer = null;
    	var CaptchaCallback = function() {
      		grecaptcha.render('RecaptchaField2', {
        		'sitekey' : '6LdqHBATAAAAAPoEZE2GZXzTS-03N5DJLFNTrC7_',
        		'callback' : function(response) {
         			recaptcha2=response;
        		}
      		});
	 		grecaptcha.render('RecaptchaField1', {
        		'sitekey' : '6LdqHBATAAAAAPoEZE2GZXzTS-03N5DJLFNTrC7_',
        		'callback' : function(response) {
              		recaptcha1=response;
        		}
      		});
    	};
	</script> 
<script src="//www.google.com/recaptcha/api.js?onload=CaptchaCallback&amp;render=explicit" async defer></script>
</body>
</html>