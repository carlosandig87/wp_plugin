<?php
global $wpdb, $table_prefix;
$returnplan = $wpdb->get_row( "SELECT * FROM `".$table_prefix."posts` WHERE `ID` = '".get_the_ID()."'AND `post_status` = 'publish' AND `post_type` = 'payment' " );

?>

<script>
 window.location.assign('<?php echo get_bloginfo('url').'/membership-plan/'.$returnplan->post_name;?>');
</script>
	

