<?php

/**
 * Hero Product Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-product-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero-product';
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

<div id="<?php echo esc_attr($id); ?>" class="hero-product <?php echo esc_attr($className);?>">
<?php 
	
	$product 	= get_field('product');

	if ($product):
	
		$image 		= get_field('image');
		$tagline	= get_field('tagline');
		$title		= $product->post_title;
		$link 		= get_permalink( $product->ID );
		$placement	= get_field('placement');
		$grid_area 	= $placement['vertical'].'/'.$placement['horizontal'];
		?>
		<div class="container">
			<div class="hero-img">
				<?php echo wp_get_attachment_image( $image['id'], 'full'); ?>
			</div>

			<div class="hero-content">
				<div class="col-full">
					<div 
						class="text-container" 
						style="grid-area: <?php echo $grid_area ?>;"
						>
						<h3><?php echo $title; ?></h3>
						<p><?php echo $tagline; ?></p>
				   		<a class="button cta" href="<?php echo $link; ?>"> Find out more </a>
					</div>
				</div>
			</div>	
		</div>
		
	<?php else: ?>
		<p>Please add a product</p>
	<?php endif; ?>

</div>