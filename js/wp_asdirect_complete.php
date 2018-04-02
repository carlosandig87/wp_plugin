<?php 
if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
 //check for ip from share internet
 $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
 // Check for the Proxy User
 $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
 $ip = $_SERVER["REMOTE_ADDR"];
}

global $wpdb, $table_prefix;
$membersorders = $wpdb->get_row( "SELECT * FROM `".$table_prefix."asdirectltd_memberships_orders` WHERE `status` = 'Review' AND notes = '".$ip."'" );

$codeid = $wpdb->get_row( "SELECT user_id FROM `".$table_prefix."usermeta` WHERE `meta_key` = 'ipaddress' AND `meta_value` = '".$ip."' ORDER BY umeta_id DESC"  );
$sessionid = $wpdb->get_row( "SELECT sessionid FROM `".$table_prefix."usermeta` WHERE `meta_key` = 'ipaddress' AND `meta_value` = '".$ip."'" );
if( $codeid->user_id == true ) {
	$userdata = get_userdata($codeid->user_id);
	$key = 'sessionid';
	$single = true;
	$userkey = get_user_meta( $codeid->user_id, $key, $single ); 
}
?><?php if( get_current_user_id() == true ) { ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script> $(document).ready(function(){ 
$("#express_button_signup").css("cursor", "pointer"); 	
$("#asdirect_formid").click(function(){		
$("#checkouted").show();			
setTimeout(function(){ $("#checkouted").text('processing.. in 4 seconds'); }, 1000);
			setTimeout(function(){ $("#checkouted").text('processing.. in 3 seconds'); }, 2000);			
			setTimeout(function(){ $("#checkouted").text('processing.. in 2 seconds'); }, 3000);			
			setTimeout(function(){ $("#checkouted").text('processing.. in 1 seconds'); }, 4000);			
			setTimeout(function(){ $("#checkouted").text('Completing process...'); }, 5000);			
			setTimeout(function(){ window.location.assign("<?php echo get_bloginfo('url').'/membership-confirmation/?token='.$membersorders->paypal_token.'&complete='.$membersorders->code;?>"); }, 6000);	 });   });  </script>
			<?php } ?>
			<?php if( get_current_user_id() != true ) { ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
 $(document).ready(function(){
 $("#express_button_signup").css("cursor", "pointer"); 
	$("#asdirect_formid").click(function(){
		 $.post("<?php echo wp_login_url( '/my-account/' );?>", {
			  log: '<?php echo $userdata->user_login;?>',
			  pwd: '<?php echo base64_decode($userkey);?>',
			  testcookie: 1
		},
		function(data,status){
			$("#checkouted").show();
			setTimeout(function(){ $("#checkouted").text('processing.. in 4 seconds'); }, 1000);
			setTimeout(function(){ $("#checkouted").text('processing.. in 3 seconds'); }, 2000);
			setTimeout(function(){ $("#checkouted").text('processing.. in 2 seconds'); }, 3000);			
			setTimeout(function(){ $("#checkouted").text('processing.. in 1 seconds'); }, 4000);
			setTimeout(function(){ $("#checkouted").text('Completing process...'); }, 5000);
			setTimeout(function(){ window.location.assign("<?php echo get_bloginfo('url').'/membership-confirmation/?token='.$membersorders->paypal_token.'&complete='.$membersorders->code;?>"); }, 6000);
		});
	 }); 
  });  
</script><?php } ?>
