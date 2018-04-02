<?php
class aws_shortcode_slideritems_product {
	function aws_manageslideritems_product( $atts ) {
		$atts = shortcode_atts( array(
			'method' => '',
			'version' => '',
			'account' => '',
			'slider' => 'As Direct LTD',
			'action' => ''
		), $atts, 'asdirect_product_slider' );
		$i=0;
		global $wpdb, $table_prefix;
		$featured_slider= $wpdb->get_results( "SELECT * FROM `".$table_prefix."posts` WHERE `post_status` = 'publish' AND `post_type` = 'slider'" );
		foreach ($featured_slider as $idpostmeta) {
			$value = get_post_meta( $idpostmeta->ID, 'asdirectitems', true );
			$checkrow = $wpdb->get_results( "SELECT * FROM `".$table_prefix."posts` WHERE ID = '".esc_attr( $value )."' AND `post_status` = 'publish' AND `post_type` = 'product'" );
			if(count($featured_slider) > $i ){
				global $post, $wpdb, $table_prefix;
				foreach ($checkrow as $post) {
					setup_postdata( $post );
					$price = get_post_meta(get_the_ID(), "_regular_price", true);
					$sale = get_post_meta(get_the_ID(), "_sale_price", true);
					if($sale == true) {
						$regular = get_post_meta(get_the_ID(), "_sale_price", true);
					} else {
						$price = get_post_meta(get_the_ID(), "_price", true);
							if( $price == true ) {
								$regular = get_post_meta(get_the_ID(), "_price", true);
							} else {
								$regular = get_post_meta(get_the_ID(), "_regular_price", true);
							}
							
					}
					$price_variable = get_post_meta(get_the_ID(), "_max_variation_regular_price", true);
					$sale_variable = get_post_meta(get_the_ID(), "_max_variation_sale_price", true);
					
					$sale_result = get_post_meta(get_the_ID(), "_sale_price", true);
					if($price_variable == true) {
						$sale_result = get_post_meta(get_the_ID(), "_max_variation_regular_price", true);
					$price = get_post_meta(get_the_ID(), "_max_variation_sale_price", true);
					} 
					if($price != false) {
						$save_price = $price - $sale_result;
						if($price_variable == true){
							$save_price = $sale_result - $price;
							$price = get_post_meta(get_the_ID(), "_max_variation_regular_price", true);
						}
						
						$discount = ($save_price / $price) * 100 ;
						$discount_percent = ceil($discount);
					}
					switch ($i) {
					case 0:
						echo '<div class="slide">';
						break;
					case 1:
						echo '<div class="slide">';
						break;
					case 2:
						echo '<div id="slide-1" class="slide">';
						break;
					default:
						echo '<div id="slide-'.$i.'" class="slide">';
					}
					echo '<div class="slider-img">';
					if ( has_post_thumbnail() ) {
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'Medium' );
						echo '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">';
						the_post_thumbnail( array(300,275) );
						echo '</a>';
					}
					echo '</div>';
					echo '<div class="slider-text">';
					if($idpostmeta->post_content == ''){
						echo '<h1>UPTo '.$discount_percent.'% DISCOUNT OFF</h1>';
					} else {
						echo $idpostmeta->post_content;
					}
					echo ' <div class="features_list">';
					echo '<h4>'.get_the_title().'</h4>';
					echo '<a href="'.get_permalink().'" class="button">Shop Now</a>';
					echo '</div>';
					echo '</div>';
					echo '<div class="clear"></div>';
					echo '</div>';
				}
			}
			$i++;
		}
	}
}
add_shortcode( 'asdirect_product_slider', array( 'aws_shortcode_slideritems_product', 'aws_manageslideritems_product' ) );		
	
?>