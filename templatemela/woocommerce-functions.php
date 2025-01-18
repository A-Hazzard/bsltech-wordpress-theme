<?php 
// Add woocommerce support theme
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
// Disables woocommerce style
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment'); 

// Change the breadcrumb delimeter from '/' to '>'
add_filter( 'woocommerce_breadcrumb_defaults', 'templatemela_change_breadcrumb_delimiter' );
function templatemela_change_breadcrumb_delimiter( $defaults ) {
$defaults['delimiter'] = ' &raquo; ';
$defaults['before'] = '<span>';
$defaults['after'] = '</span>';
return $defaults;
}
?>