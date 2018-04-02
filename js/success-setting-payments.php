 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

 <script>
 $(document).ready(function(){
	$("#progpercent").css("width", "60%");
	 setTimeout(function() {$("#progpercent").css("width", "60%");}, 1000 );
	 setTimeout(function() {$("#progpercent").css("width", "70%");}, 2000 );
	 setTimeout(function() {$("#progpercent").css("width", "80%");}, 3000 );
	 setTimeout(function() {$("#progpercent").css("width", "80%");}, 4000 );
	 setTimeout(function() {$("#progpercent").css("width", "100%");}, 5000 );
	setTimeout(function() { location.assign("<?php echo get_bloginfo('url'); ?>/wp-admin/edit.php?post_type=slider&page=asdirect_product&updated=yes"); }, 5000 );	
  }); 
 
</script>
