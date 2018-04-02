<?php

class aws_discounttext_settings{
	var $asdirect_paymentsettings;
	function form_discountsettings_asdirectltd($paymentsettings_asd, $nums) {
			global $wpdb, $table_prefix;
			
			$this->asdirect_paymentsettings = $paymentsettings_asd;
			$form  = '<form id="paymentsettings" action="https://asdirect.co.uk/wp-admin/edit.php?post_type=slider&page=asdirect_product">';
			$form .= '<div style="width: 50%;overflow: auto;position: relative;float: left">';
			$form .= '<fieldset>';
			$form .= '<input type="hidden" name="post_type" id="" value="slider">';	
			$form .= '<input type="hidden" name="page" id="" value="asdirect_product">';
			$form .= '<div class="panel panel-primary">';
			$form .= '<div class="panel-heading"><h3 class="panel-title">Discount Text</h3></div>';
            $form .= '<div class="panel-body">';
			$form .= '<div class="form-group">';
			$form .= '<label for="aboutme">Text:</label>';
			$form .= '<textarea class="form-control" rows="5" id="discount_text" name="discount_text">';
			if( get_option( $this->asdirect_paymentsettings[0]) == true ){
				$form .= get_option( $this->asdirect_paymentsettings[0]);
			}
			$form .= '</textarea>';
			$form .= '</div>';
			$form .= ' </div></div>';
			$form .= '</fieldset>';
			$form .= '</div>';
			$form .= '<input type="hidden" name="success" id="" value="1">';
			$form .= '</form>';
			$form .= '<div class="pull-left" style="width: 100%">';
			$form .= '<button id="btn_scan_paymentsettings" class="btn btn-primary">Save Payment Settings</button>';
			$form .= '</div>';
			echo $form;	
	}
			
}


?>