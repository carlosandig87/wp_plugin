<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php $paypalurllink = 'https://www.sandbox.paypal.com'; if(get_option('asdirect_gateway_environment') == 'live') { $paypalurllink = 'https://www.paypal.com';}?>
<?php if(!get_current_user_id()){ ?>
<script>
 $(document).ready(function(){
 $("#express_button_signup").css("cursor", "pointer"); 
	$("#express_button_signup").click(function(){
			if( $("#user_login").val() == '')	{
				$("#user_login").css("border-color", "#a94442");
				$("#user_login + p + .alert-danger").show();
				$("#user_login + p + .alert-danger").html('<strong>Oh snap!</strong> Required Username!.');
			}
			else if( $("#user_pass1").val() == '')	{
				$("#user_pass1").css("border-color", "#a94442");
				$("#user_pass1 + p + .alert-danger").show();
				$("#user_login + p + .alert-danger").hide();
				$("#user_pass1 + p + .alert-danger").html('<strong>Oh snap!</strong> Required Pass!.');
			}
			else if( $("#user_pass2").val() != $("#user_pass1").val())	{
				$("#user_pass1 + p + .alert-danger").hide();
				$("#user_pass2").css("border-color", "#a94442");
				$("#user_pass2 + p + .alert-danger").show();
				$("#user_pass2 + p + .alert-danger").html('<strong>Oh snap!</strong> Password not the same!.');
			}
			else if( $("#user_email1").val() == '')	{
				$("#user_email1").css("border-color", "#a94442");
				$("#user_email1 + p + .alert-danger").show();
				$("#user_pass2 + p + .alert-danger").hide();
				$("#user_email1 + p + .alert-danger").html('<strong>Oh snap!</strong> Required Email Address!.');
			} 
			else if( $("#user_email2").val() != $("#user_email1").val())	{
				$("#user_email2").css("border-color", "#a94442");
				$("#user_email1 + p + .alert-danger").hide();
				$("user_email2 + p + .alert-danger").show();
				$("user_email2 + p + .alert-danger").html('<strong>Oh snap!</strong> Email Address not the same!.');
			}
			else {
				$.post("<?php echo get_permalink();?>",
				{
				  username: $("#user_login").val(),
				  pwd1: $("#user_pass1").val(),
				  email1: $("#user_email1").val()
				},
				function(data,status){
					//alert("Data: " + data + "\nStatus: " + status);
					$("#process").show();
					setTimeout(function(){ window.location.assign('<?php echo $paypalurllink;?>/cgi-bin/webscr?cmd=_express-checkout&token=' + $("#wp_token_checkout").val()); }, 3000);
					
				});
			}
		 }); 
		
	
  }); 
 
</script>
<?php } ?>
<?php if(get_current_user_id()){ ?>
	<script>
 $(document).ready(function(){
 $("#express_button_signup").css("cursor", "pointer"); 
	$("#express_button_signup").click(function(){
			if( $("#wp_token_checkout").val() == '')	{
				$("#user_login").css("border-color", "#a94442");
				$("#user_login + p + .alert-danger").show();
				$("#user_login + p + .alert-danger").html('<strong>Oh snap!</strong> Required Username!.');
			} else {
				$.post("<?php echo get_permalink();?>",
				{
				  subscriber: $("#subscriberid").val(),
				  subscriber_token: $("#wp_token_checkout").val()
				},
				function(data,status){
					//alert("Data: " + data + "\nStatus: " + status);
					$("#process").show();
					setTimeout(function(){ window.location.assign('<?php echo $paypalurllink;?>/cgi-bin/webscr?cmd=_express-checkout&token=' + $("#wp_token_checkout").val()); }, 3000);
					
				});
			}
		 }); 
		
	
  }); 
 
</script>
<?php } ?>
