<?php 

add_filter( 'woocommerce_composite_component_loop_columns', 'wc_cp_component_loop_columns', 10, 3 );
function wc_cp_component_loop_columns( $cols, $component_id, $composite ) {
	$cols = 3;
	return $cols;
}

add_filter( 'woocommerce_component_options_hide_incompatible', 'wc_cp_component_options_hide_incompatible', 10, 3 );
function wc_cp_component_options_hide_incompatible( $hide, $component_id, $composite ) {
	return true;
}

add_filter( 'woocommerce_component_options_per_page', 'wc_cp_component_options_per_page', 10, 3 );
function wc_cp_component_options_per_page( $results_count, $component_id, $composite ) {
	$results_count = 12;
	return $results_count;
}

?>