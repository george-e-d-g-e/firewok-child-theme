<?php

/**
 * Embed Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'embed-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'firewok-embed';
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



<div 
    id="<?php echo esc_attr($id); ?>" 
    class="<?php echo esc_attr($className); ?>" 
    style="background-color:<?php the_field('background_colour'); ?>;"
    >

    <div class="embed-container">

    <?php $iframe = get_field('embed'); ?>

    <?php if( $iframe ):

        preg_match( '/vimeo/', $iframe, $matches);

        /* VIMEO */

        if ($matches[0] == "vimeo" ){

            // remove height and width
            $iframe = preg_replace( '/(width|height)="\d*"\s/', "", $iframe );
            preg_match( '/(src="(.+?)")/', $iframe, $matches);
            $src = $matches[1];

            // add extra params to iframe src
            $params = array(
                'color'    => "ffffff",
                'title'    => 0,
                'byline'   => 0,
                'portrait' => 0
            );
            $new_src = add_query_arg($params, $src);
            $iframe = str_replace($src, $new_src, $iframe);
        }

        echo $iframe; 
      
    else: ?>
    	<p>Please some embeded content</p>
    <?php endif; ?>
   </div>

</div>