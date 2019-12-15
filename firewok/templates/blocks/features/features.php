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
$id = 'features-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'features';
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

<div id="<?php echo esc_attr($id); ?>" class="feature-row <?php echo esc_attr($className); ?>" >

<?php if( have_rows('features') ): ?>

    <?php while ( have_rows('features') ) : the_row();

    	$link 			= get_sub_field('link');
        $title 			= get_sub_field('title');
        $description	= get_sub_field('description');
        $mobiletext 	= get_sub_field('mobile_button_text'); 
        $image 			= get_sub_field('image');
    	?>

    	<div class="feature">
	  		<a class="hover-image" href="<?php echo $link; ?>">
	  			<div class="img-container">
	  				<?php echo wp_get_attachment_image( $image['id'], 'full'); ?>
	  			</div>
	  			<div class="text-container">
	  				<div class="left-border"></div>
	  				<h3><?php echo $title; ?></h3>
       				<p><?php echo $description; ?></p>
	  			</div>
	  		</a>
	    </div>
    
    <?php endwhile; ?>
<?php else: ?>
	<p>Please add some features.</p>
<?php endif; ?>

</div>