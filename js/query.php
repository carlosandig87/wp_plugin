<?php
global $wpdb, $table_prefix;
$pagenameurl = $wpdb->get_row( "SELECT post_name FROM `".$table_prefix."posts` WHERE `ID` = '".get_the_ID()."' AND post_status = 'publish' AND post_type = 'page'" );
?>
<script>
function selectpage(str) {
	<?php if(get_the_ID() == 855){ ?>
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 3 && xmlhttp.status == 200) {
                document.getElementById("myprofile").innerHTML = '<div align="center"><img class="img-responsive" width="220" height="143" src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2015/11/loading-x.gif"></div>';
            }
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			 document.getElementById("myprofile").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "<?php echo get_bloginfo('url');?>/profile/?account="+ str, true);
        xmlhttp.send();
		<?php } ?>
		<?php if(get_the_ID() == 857){ ?>
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 3 && xmlhttp.status == 200) {
                document.getElementById("mypreferences").innerHTML = '<div align="center"><img class="img-responsive" width="220" height="143" src="<?php echo get_bloginfo('url');?>/wp-content/uploads/2015/11/loading-x.gif"></div>';
            }
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			 document.getElementById("mypreferences").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "<?php echo get_bloginfo('url');?>/preferences/?preferences="+ str, true);
        xmlhttp.send();
		<?php } ?>
}
</script>
