<?php

/**
 * Storefront automatically loads the core CSS even if using a child theme as it is more efficient
 * than @importing it in the child theme style.css file.
 *
 * Uncomment the line below if you'd like to disable the Storefront Core CSS.
 *
 * If you don't plan to dequeue the Storefront Core CSS you can remove the subsequent line and as well
 * as the sf_child_theme_dequeue_style() function declaration.
 */
//add_action( 'wp_enqueue_scripts', 'sf_child_theme_dequeue_style', 999 );

/**
 * Dequeue the Storefront Parent theme core CSS
 */
function sf_child_theme_dequeue_style() {
	wp_dequeue_style( 'storefront-style' );
	wp_dequeue_style( 'storefront-woocommerce-style' );
}

/**
 * Note: DO NOT! alter or remove the code above this text and only add your custom PHP functions below this text.
 */


// add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// function my_theme_enqueue_styles() {
 
//     $parent_style = 'storefront-style';
//     wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    
//     wp_enqueue_style( 'firewok-style',
//         get_stylesheet_directory_uri() . '/style.css',
//         array( $parent_style ),
//         wp_get_theme()->get('Version')
//     );
// }

function wordpressify_resources() {

	$parent_style = 'storefront-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

	wp_enqueue_style( 'firewok-style', get_stylesheet_uri(), array( $parent_style ), wp_get_theme()->get('Version'));
	wp_enqueue_script( 'header_js', get_stylesheet_directory_uri() . '/js/header-bundle.js', null, 1.0, false );
	wp_enqueue_script( 'footer_js', get_stylesheet_directory_uri() . '/js/footer-bundle.js', null, 1.0, true );
}

add_action( 'wp_enqueue_scripts', 'wordpressify_resources' );

/* Add ACF options page */
if( function_exists('acf_add_options_page') ) {	
	acf_add_options_page();	
}

/* Enable ACF metaboxs in gutenburg*/
add_filter('acf/settings/remove_wp_meta_box', '__return_false', 20);

/* Add SVG uploads */
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}

add_action('upload_mimes', 'add_file_types_to_uploads');

function register_slick() {
	
	wp_enqueue_style( 'slick', 'http://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css', array(), '1.0.0' );
	wp_enqueue_style( 'slick-theme', 'http://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css', array(), '1.0.0' );
	wp_enqueue_script( 'slick', 'http://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'register_slick' );

/* Add custom script*/
// function firewok_script() {
// 	wp_enqueue_script('custom-script',get_stylesheet_directory_uri() . '/assets/js/script.js');
// }

// add_action( 'wp_enqueue_scripts', 'firewok_script', 50 );


/* FIREWOK FUNCTIONS */
include 'inc/firewok-functions.php';

/* ACF BLOCKS */
include 'inc/register-acf-blocks.php';

/* COMPONENT PRODUCTS */
include 'inc/component-products.php';




/*
* Product Page
*/

if (! function_exists( 'firewok_product_images' )) {
	
	function firewok_product_images(){

		?> <div class="product-images"> <?php

			if( have_rows('rows') ): 

				// $rows = get_field('rows');

				while ( have_rows('rows') ) : the_row();

					// check if the repeater field has rows of data
					if( have_rows('feature_row') ): 

						?><div class="feature-row"><?php
							$colsSize = 0;
							while ( have_rows('feature_row') ) : the_row(); 
								$colsSize++;
							endwhile; 	

						    while ( have_rows('feature_row') ) : the_row();

						        $type = get_sub_field('feature_type');  

						        if ($type == 'image'):
						        	$image = get_sub_field('image');
						        else:
						        	$video = get_sub_field('feature_video');
						        endif;
						    	?>
						    	
						    	<div class="feature <?php echo 'col-'.$colsSize?>">
						    	
					    		<?php if ($type == 'image'): ?>
							  		<?php echo wp_get_attachment_image( $image['id'], 'full'); ?>
							  	<?php elseif ($type == 'video'): ?>
							  		<div class="embed-container">
							  			<?php echo $video; ?>
							  		</div>
							  	<?php endif; ?>
						    </div>
						    
						    <?php endwhile; ?>
						</div>
					<?php endif; 
				endwhile; 
		 	endif;
		?> </div> <?php
	}
}



/**
 * Storefront Removals 
 */

/* Remove search */
function storefront_product_search() {
	/*
	* Leave blank
	* Delete this function to bring back search
	*/
}

/* Remove storefront credit */
function storefront_credit() {
	/*
	* Leave blank
	* Delete this function to bring back storefront credit
	*/
}


/** 
 *  Hooks
 */

/*Add firewok banner to header*/

// add_action( 'firewok_header', 'firewok_header_cart', 10 );

// add_action( 'firewok_header_info', 'firewok_banner', 				10);
// add_action( 'firewok_header_info', 'firewok_contact_info', 			20);
//add_action( 'firewok_header', 'firewok_header_full', 5 );
// add_action( 'firewok_header', 		'firewok_site_branding', 		15);
// add_action(	'firewok_header', 		'firewok_primary_navigation',	30);
// add_action( 'firewok_header', 		'firewok_header_cart', 		50);

/*Single Product Page */

remove_action(	'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 	30 );
add_action(		'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',	15 );

add_action ( 	'woocommerce_after_single_product_summary', 'firewok_product_images',				 5);

/* Remove additional infomation  from Single Product Page */

/*remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );*/

remove_action( 	'woocommerce_product_additional_information', 'wc_display_product_attributes',		10 );




