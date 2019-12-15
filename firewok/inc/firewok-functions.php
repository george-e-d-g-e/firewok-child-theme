<?php

/*

 Cover Page 

*/

add_action( 'storefront_before_content', 'firewok_cover_page', 1);
if( ! function_exists( 'firewok_cover_page' ) ) {
	function firewok_cover_page() {

		if( function_exists('acf_add_options_page') ){ 
			
			/* ACF vars */		
			$cover = get_field('cover_page', 'option');

			if ($cover === true){

				$logo = get_field('logo', 'option');
				?>
				
				<div class="firewok-cover-page">
					<div class="cover-wrapper">
						<div class="logo"> 
							<a href="<?php echo get_home_url(); ?>">
							<?php echo wp_get_attachment_image( $logo['id'], 'full'); ?>
							</a>
						</div>
						<div class="site-title">
							<a href="<?php echo get_home_url(); ?>">
								<h1>Firewok</h1>
							</a>
						</div>	
						<h2> We'll be right back <br> Just making a few updates</h2>
					</div>
				</div>

				<?php
			}
		}
	}	
}

/*

 Firewok Header 

*/
add_action( 'firewok_header', 'firewok_header_full', 5 );
if( ! function_exists( 'firewok_header_full' ) ) {
	function firewok_header_full() {

		if( function_exists('acf_add_options_page') ){

			/* ACF vars */		
			$logo 			= 	get_field('logo', 			'option');
			$logo_link 		= 	get_field('logo_link', 		'option');
			$site_title 	=   get_field('site_title', 	'option');
			$tagline 		= 	get_field('tagline', 		'option');	
			$notification 	= 	get_field('notification', 	'option');
			$email 			= 	get_field('email', 			'option');
			$phone 			= 	get_field('phone', 			'option');

			?>
			<div class="logo"> 
				<a href="<?php echo get_home_url(); ?>">
				<?php echo wp_get_attachment_image( $logo['id'], 'full'); ?>
				</a>
			</div>

			<div class="site-title">
				<a href="<?php echo get_home_url(); ?>">
					<h1><?php echo $site_title; ?></h1>
					<h2><?php echo $tagline; ?></h2>
				</a>
			</div>

			<div id="hamburger-mobile" class="hamburger">
					<span></span>
					<span></span>
					<span></span>
			</div>

			<nav class="main-menu">
				<?php  

				/* Menus */

				wp_nav_menu( array(
					'theme_location'	=> 'primary',
					'container_class'	=> 'primary-navigation',
				));

				// wp_nav_menu( array(
				// 	'theme_location'	=> 'handheld',
				// 	'container_class'	=> 'handheld-navigation',
				// ));

				/*  Mega Menu */ 
				?>

				<div class="mega-menu">
					<div><a id="mega-menu-back-btn" href="#"> &#60; </a></div>
					<?php if( have_rows('mega_menu', 'option') ): ?> 
						<div class="categories">
							<?php while ( have_rows ('mega_menu', 'option')): the_row(); 

								$category = get_sub_field('category');
								$products = get_sub_field('products');
								?> 
									<div class="category">
										<h4>
											<a class="category-title" href="<?php echo get_term_link($category); ?>">
												<?php echo $category->name; ?>
											</a>
										</h4>

										<?php if( $products ) : ?>
											<ul>
												<?php foreach ($products as $p): ?>
													
													<li>
														<a href="<?php echo get_permalink($p->ID); ?>">
															<?php echo get_the_title($p->ID); ?>
														</a>
													</li>

												<?php endforeach; ?>

												<!-- <li> <div><a href="<?php echo get_term_link($category); ?>" class="button">Shop All</a></div></li> -->

											</ul>

											<a href="<?php echo get_term_link($category); ?>" class="button">Shop All</a>
										<?php endif; ?>


									</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?> 
				</div>

			</nav>
			
			<div class="notification"> 
				<p><?php echo $notification; ?></p> 
			</div>

			<div class="contact" id="contact-info">
				<a class="email" href="mailto:<?php echo $email; ?>">
					<p><?php echo $email; ?></p>
				</a>
				<a class="phone" href="tel:+44-<?php echo $phone; ?>">
					<p><?php echo $phone; ?></p>
				</a>
				<div class="social">
					<?php if( have_rows('social_media', 'option') ): ?>
						<?php while ( have_rows ('social_media', 'option')): the_row(); 
							$icon = get_sub_field('social_icon');
							$link = get_sub_field('social_link');
							?> 
							<a href="<?php echo $link['url']; ?>" 
								class="<?php echo $icon; ?>">
							</a>
							<?php
						endwhile;
					endif; ?>
				</div>
			</div>

			<?php
		}
	}	
}

/* Header Cart */

if ( ! function_exists( 'firewok_header_cart' ) ) {
	/**
	 * Display Header Cart
	 *
	 * @since  1.0.0
	 * @uses  storefront_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function firewok_header_cart() {
		if ( storefront_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			?>
			<div id="user-buttons" class="user-buttons">
				<ul class="site-login menu">
					<li class="login-btn"> 
						<a class="login" href="/my-account">
						<?php 
							if( is_user_logged_in() ){
								echo "My Account";
							}
							else{		
								echo "Login";
							}
						?>
						</a> 
					</li>
				</ul>
				<ul id="site-header-cart" class="site-header-cart menu flex-item">
					<li class="<?php echo esc_attr( $class ); ?> cart-btn">
						<?php storefront_cart_link(); ?>
						<!-- make cart a child -->
						<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
					</li>
				</ul>
			</div>
			<?php
		}
	}

	add_action( 'firewok_header', 'firewok_header_cart', 10 );
	
}

/* Add Gutenburg to product page */

function wplook_activate_gutenberg_products($can_edit, $post_type){
	if($post_type == 'product'){
		$can_edit = true;
	}
	
	return $can_edit;
}
add_filter('use_block_editor_for_post_type', 'wplook_activate_gutenberg_products', 10, 2);


/* Re-Order Product Tabs */
add_filter( 'woocommerce_product_tabs', 'firewok_custom_product_tabs', 98 );
function firewok_custom_product_tabs( $tabs ) {

    // Re Order 
    $tabs['description']['priority'] = 5;
    $tabs['reviews']['priority'] = 10;  

    unset( $tabs['additional_information'] );      
  
    return $tabs;

}





/* Display all of them */