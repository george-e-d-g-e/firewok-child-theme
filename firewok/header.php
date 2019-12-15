<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>



<body <?php body_class(); ?>>

<?php do_action( 'storefront_before_site' ); ?>

<?php
	do_action('firewok_cover_page');  /* /inc/firewok-functions.php */
?>

<div id="page" class="hfeed site">
	
	<div class="header-wrapper">
		<div class="col-full">
			<header id="masthead">
				<?php 
				do_action( 'storefront_before_header' ); 
				do_action( 'firewok_header' ); /* see /inc/firewok-functions.php */
				?>
			</header>
			<div class="border">
				<span></span>
			</div>
		</div>
		<div class="border-extension"></div>
	</div>

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

		<?php
		/**
		 * Functions hooked in to storefront_content_top
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_content_top' );
