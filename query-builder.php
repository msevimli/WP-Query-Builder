<?php
class WCQueryBuilder {
    public function __constract() {
        //initilize
    }
    function query_factory($tax_meta,$order="ASC",$posts_per_page=12) {
        global $woocommerce, $woocommerce_loop;
        $tax_query=array();
        foreach($tax_meta as $tax) {
            array_push($tax_query,$tax);
        }
		$args = array( 
				'post_type'				=> 'product',
				'post_status' 			=> 'publish',
				'ignore_sticky_posts'	=> 1,	
				'order' 				=> $order,
				'posts_per_page' 		=> $posts_per_page,
				'meta_query' 			=> array(
				),
				'tax_query' 			=> $tax_query
			);			
	ob_start();

  $products = new WP_Query( $args );
	if ( $products->have_posts() ) : ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php add_filter( 'woocommerce_get_price_html', array($this,'wpa83367_price_html'), 100, 2 ); ?>
			
            	<?php woocommerce_get_template_part( 'content', 'product' ); ?>
               
			<?php endwhile; ?>

		<?php woocommerce_product_loop_end(); ?>

	<?php endif;
	wp_reset_postdata();
	return '<div class="woocommerce">' . ob_get_clean() . '</div>';
    }
    function wpa83367_price_html( $price, $product ){
        return 'Was:' . str_replace( '<ins>', ' Now:<ins>', $price );
    }
}