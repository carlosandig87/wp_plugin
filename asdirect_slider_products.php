<?php
/**
 * @package As Direct LTD SLIDER PRODUCTS
 * @version 1.0
 */
/*
Plugin Name: As Direct LTD Slider
Plugin URI: http://asdirectwebservices.com/
Description: As Direct LTD .
Author: Carlo Ariel Sandig
Version: 1.0
Author URI: http://asdirectwebservices.com/
*/
global $post;
add_action( 'init', 'create_wp_asdirectslider_posttype' );
function create_wp_asdirectslider_posttype() {
  register_post_type( 'slider',
    array(
      'labels' => array(
        'name' => __( 'Slider Products' ),
        'singular_name' => __( 'Slider Product' )
      ),
      'public' => true,
	  'show_ui' => true,
	  'show_in_nav_menus' => true,
	  'meta_box_cb' => null,
      'has_archive' => false,
      'rewrite' => array('slug' => 'slider-products'),
    )
  );
}
require plugin_dir_path( __FILE__ ).'include/class_asdirectslider_productname.php';
require plugin_dir_path( __FILE__ ).'include/class_discount_text_custom.php';
require plugin_dir_path( __FILE__ ).'include/class_category_backlinks.php';

add_action( 'admin_menu', 'aws_selectsliders_funct' );

function aws_selectsliders_funct() {
	add_meta_box( 'exact_asdirectproduct_box', 'Select Product ', 'asdirectproduct_funct', 'slider', 'side', 'high' );
}

function asdirectproduct_funct( $post) { 
	//$yogatypearrays = array_unique($yogatypearray);
	$value = get_post_meta( $post->ID, 'asdirectitems', true );
	echo '<select class="btn btn-default" id="asdirectitems" name="asdirectitems">';
	global $wpdb, $table_prefix;
	$checkrow = $wpdb->get_row( "SELECT * FROM `".$table_prefix."posts` WHERE ID = '".esc_attr( $value )."' AND `post_status` = 'publish' AND `post_type` = 'product'" );
	if($value){
		echo '<option selected value="'.esc_attr( $value ).'">'.$checkrow->post_title.'</option>';
	} else {
		echo '<option value="0">Choose Shows</option>';
	} 
	global $wpdb, $table_prefix;
	$allvideotype = $wpdb->get_results( "SELECT * FROM `".$table_prefix."posts` WHERE `post_status` = 'publish' AND `post_type` = 'product'" );
	
	foreach($allvideotype as $videonames){
		echo '<option value="'.$videonames->ID.'">'.$videonames->post_title.'</option>';
	}
	echo '</select>';
	echo '<input type="hidden"  name="meta_asdirectproductname" value="' . wp_create_nonce( plugin_basename( __FILE__ ) ) . '"/>';	    
}
add_action( 'save_post', 'aws_meta_asdirecitemsname', 10, 2 );
function aws_meta_asdirecitemsname( $post_id, $post ) {

	if ( !wp_verify_nonce( $_POST['meta_asdirectproductname'], plugin_basename( __FILE__ ) ) )
		return $post_id;

	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$meta_value = get_post_meta( $post_id, 'asdirectitems', true );
	$new_meta_value = stripslashes( $_POST['asdirectitems'] );

	if ( $new_meta_value && '' == $meta_value )
		add_post_meta( $post_id, 'asdirectitems', $new_meta_value, true );

	elseif ( $new_meta_value != $meta_value )
		update_post_meta( $post_id, 'asdirectitems', $new_meta_value );

	elseif ( '' == $new_meta_value && $meta_value )
		delete_post_meta( $post_id, 'asdirectitems', $meta_value );
}
//Submenu Page Below//
add_action('admin_menu', 'asdirect_settings_menus');

function asdirect_settings_menus() {
	
	add_submenu_page('edit.php?post_type=slider', 'Settings', 'Settings', 'administrator', 'asdirect_product', 'asdirect_product_options_func');
	
}

function asdirect_product_options_func(){
	echo '<link rel="stylesheet" href="'.plugins_url( 'admin/css/bootstrap.min.css', __FILE__ ).'">';
		require plugin_dir_path( __FILE__ ).'js/submit-setting-payments.php';
		echo '<div class="wrap"  style="overflow: hidden;">';
		if($_GET['updated'] == true){
			echo '<div role="alert" class="alert alert-success"><strong>Well done!</strong> Successfully Update. </div>';
		}
		if($_GET['success'] == true){
			require plugin_dir_path( __FILE__ ).'js/success-setting-payments.php';
			echo '<div role="alert" class="alert alert-success"><strong>Well done shortly!</strong> Updating.... </div>';
			
			echo '<div class="progress">
			<div id="progpercent" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-striped"><span class="sr-only">60% Complete</span></div>
		  </div>';
		}
		echo '<h2>Settings</h2>';
		$paymentsetup = new aws_discounttext_settings;
		$paymentsetupform = array(
		$_GET['discount_text']
		);
		$option_name = array(
			'discount_text'
		); 
		if ( $_GET['success']== true ) { 
			if ( get_option( 'discount_text' ) !== false ) {
				// The option already exists, so we just update it.
				update_option( 'discount_text', $_GET['discount_text'] );
			} else {
				// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
				$deprecated = null;
				$autoload = 'no';
				add_option( 'discount_text', $_GET['discount_text'], $deprecated, $autoload );
			}
		}
		
		
		if ( $_GET['success']== true ) {
			$paymentsetup->form_discountsettings_asdirectltd($_GET['discount_text'], $_GET['success']);
		} else {
			$paymentsetup->form_discountsettings_asdirectltd($option_name, $_GET['success']);
		}
		
		echo '</div>';

}
?>