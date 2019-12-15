<?php

/**
 * Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'product-slider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'product-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( $is_preview ) {
    $className .= ' is-admin';
}

?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" >
	<div class="slides">
	<?php if( have_rows('product_slides') ): ?>

	    <?php while ( have_rows('product_slides') ) : the_row();

	    	$product 		= get_sub_field('product');
	        $title 			= get_sub_field('title');
	        $sub_title	 	= get_sub_field('sub_title'); 
	        $text			= get_sub_field('text');
	        $image 			= get_sub_field('image');
	        $link 			= get_permalink( $product->ID );
	    	?>

	    	<div class="slide">
	  			<div class="product-image" href="<?php echo $link; ?>">
		  			<div class="img-container">
		  				<?php echo wp_get_attachment_image( $image['id'], 'full'); ?>
		  			</div>
	  			</div>
	  			<div class="text-container">
	  				<h2><?php echo $title; ?></h2>
	  				<h3><?php echo $sub_title; ?></h3>
	   				<p><?php echo $text; ?></p>
	   				<a class="button" href="<?php echo $link; ?>"> View </a>
	  			</div>
		       
		    </div>
	    
	    <?php endwhile; ?> 

	<?php else: ?>
		<p>Please add some product slides.</p>
	<?php endif; ?>
	</div>
</div>