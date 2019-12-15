<?php

/*

	Registar ACF blocks

	Tutorial:
	https://www.advancedcustomfields.com/blog/building-a-custom-slider-block-in-30-minutes-with-acf/

	Documentation: 
	https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/

*/


// Add custom block types
 
function firewok_block_categories( $categories ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' 	=> 'firewok',
                'title' => __( 'Firewok', 'firewok' ),
                'icon'  => 'smiley',
            ),
        )
    );
}

add_filter( 'block_categories', 'firewok_block_categories', 10, 2 );


add_action('acf/init', 'my_acf_init');

function my_acf_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a features block
		acf_register_block(array(
			'name'				=> 'features',
			'title'				=> __('Features'),
			'description'		=> __('Three column feature row'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'firewok',
			'icon'				=> 'images-alt',
			'keywords'			=> array( 'feature', 'row', 'firewok' ),
			'render_template'	=> '/templates/blocks/features/features.php',
			'enqueue_assets' 	=> function(){
				wp_enqueue_style( 'block-features', get_stylesheet_directory_uri() . '/templates/blocks/features/features.css', array(), '1.0.0' );
				wp_enqueue_script( 'block-features', get_stylesheet_directory_uri() . '/templates/blocks/features/features.js', array(), '1.0.0', true );
		  	},
		));

		// register a hero product block
		acf_register_block(array(
			'name'				=> 'hero-product',
			'title'				=> __('Hero Product'),
			'description'		=> __('Hero image or advert of product'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'firewok',
			'icon'				=> 'format-image',
			'keywords'			=> array( 'hero', 'image', 'firewok' ),
			'render_template'	=> '/templates/blocks/hero-product/hero-product.php',
			'enqueue_assets' 	=> function(){
				wp_enqueue_style( 'block-hero-product', get_stylesheet_directory_uri() . '/templates/blocks/hero-product/hero-product.css', array(), '1.0.0' );
				wp_enqueue_script( 'block-hero-product', get_stylesheet_directory_uri() . '/templates/blocks/hero-product/hero-product.js', array(), '1.0.0', true );
		  	},
		));

		// register a product slider block
		acf_register_block(array(
			'name'				=> 'product-slider',
			'title'				=> __('Product Slider'),
			'description'		=> __('Product slider for featured products and reviews'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'firewok',
			'icon'				=> 'carrot',
			'keywords'			=> array( 'slider', 'product', 'firewok' ),
			'render_template'	=> '/templates/blocks/product-slider/product-slider.php',
			'enqueue_assets' 	=> function(){
				wp_enqueue_style( 'slick', 'http://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css', array(), '1.0.0' );
				wp_enqueue_style( 'slick-theme', 'http://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css', array(), '1.0.0' );
				wp_enqueue_script( 'slick', 'http://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js', array('jquery'), '1.0.0', true );

				wp_enqueue_style( 'block-product-slider', get_stylesheet_directory_uri() . '/templates/blocks/product-slider/product-slider.css', array(), '1.0.0' );
				wp_enqueue_script( 'block-product-slider', get_stylesheet_directory_uri() . '/templates/blocks/product-slider/product-slider.js', array('jquery'), '1.0.0', true );
		  	},
		));

		// register a embed block
		acf_register_block(array(
			'name'				=> 'embed',
			'title'				=> __('Embed'),
			'description'		=> __('embeded content with more style options'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'firewok',
			'icon'				=> 'carrot',
			'keywords'			=> array( 'embed', 'video', 'firewok' ),
			'render_template'	=> '/templates/blocks/embed/embed.php',
			'enqueue_assets' 	=> function(){

				wp_enqueue_style( 'block-embed', get_stylesheet_directory_uri() . '/templates/blocks/embed/embed.css', array(), '1.0.0' );
				wp_enqueue_script( 'block-emebed', get_stylesheet_directory_uri() . '/templates/blocks/embed/embed.js', array('jquery'), '1.0.0', true );
		  	},
		));

	}
}

?>