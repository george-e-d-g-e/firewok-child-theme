(function($){

    /**
     * initializeBlock
     *
     * Adds custom JavaScript to the block HTML.
     *
     * @date    15/4/19
     * @since   1.0.0
     *
     * @param   object $block The block jQuery element.
     * @param   object attributes The block attributes (only available when editing).
     * @return  void
     */
    var initializeBlock = function( $block ) {
        // $block.find('img').doSomething();
        // console.log($block);
        $block.find('.slides').slick({
            dots:true,
            adaptiveHeight: false,
            speed: 500,
        });
    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
        $('.product-slider').each(function(){
            initializeBlock( $(this) );
        });
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview/type=testimonial', initializeBlock );
    }

})(jQuery);