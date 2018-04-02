<?php

class aws_shortcode_product_cat_links{
	function asdirect_category_product( $atts ) {
		$atts = shortcode_atts( array(
			'id' => '',
			'version' => '',
			'account' => '',
			'namesite' => 'As Direct LTD',
			'objectid' => get_the_ID(),
			'parent' => 0
		), $atts, 'asdirect_cat' );
		$categoryname = array();
		$categorycount = array();
		$categorparent = array(array());
		global $wpdb, $table_prefix;
		$relationships = $wpdb->get_results( "SELECT * FROM `".$table_prefix."term_relationships` WHERE  `object_id` = '".$atts['objectid']."'" );
		$i=1;
		if($atts['namesite'] == 'As Direct LTD'){
		echo '<div class="content_top">';
		echo '<div class="back-links"><p>';
		foreach($relationships as $relation){
			$termtaxonomyid = $wpdb->get_row( "SELECT * FROM `".$table_prefix."term_taxonomy` WHERE  `term_taxonomy_id` = '".$relation->term_taxonomy_id."' AND `parent` = '".$atts['parent']."'" );
			if($termtaxonomyid->taxonomy == 'product_cat'){
				$termid = $wpdb->get_row( "SELECT * FROM `".$table_prefix."terms` WHERE  `term_id` = '".$termtaxonomyid->term_taxonomy_id."'" );
				$categoryname[] = $termid->term_id;
				$categoryname[] = $termid->name;
				$categoryname[] = $termid->slug;
				echo '<a style="padding: 0;text-transform: uppercase;" href="'.get_bloginfo('url').'product-category/'.$termid->slug.'">'.$termid->name.'</a> ';
			}
			$termtaxonomyparent = $wpdb->get_row( "SELECT * FROM `".$table_prefix."term_taxonomy` WHERE  `term_taxonomy_id` = '".$relation->term_taxonomy_id."' AND `parent` = '".$categoryname[0]."'" );
			if($termtaxonomyparent->taxonomy == 'product_cat'){
				$termidparent = $wpdb->get_row( "SELECT * FROM `".$table_prefix."terms` WHERE  `term_id` = '".$termtaxonomyparent->term_taxonomy_id."'" );
				$categorycount[] = $termid->term_id;
				$categorparent[][] = $termid->term_id;
				$categorparent[][] = $termidparent->name;
				$categorparent[][] = $termidparent->slug;
				echo  '&raquo; <a style="padding: 0;text-transform: uppercase;" href="'.get_bloginfo('url').'product-category/'.$termid->slug.'/'.$termidparent->slug.'">'.$termidparent->name.'</a> ';	
			}
		}
		
		echo  '&raquo; <a style="padding: 0;text-transform: uppercase;" href="'.get_permalink().'"> '.get_the_title().'</a>';
		echo '</p></div>';	
		echo '<div class="clear"></div>';
		echo '</div>';
		}
	}		
}
add_shortcode( 'asdirect_cat', array( 'aws_shortcode_product_cat_links', 'asdirect_category_product' ) );	

?>