<?php
add_action( 'wp_ajax_dqvfwc_product_quick_view', 'dqvfwc_product_quick_view' );
add_action( 'wp_ajax_nopriv_dqvfwc_product_quick_view', 'dqvfwc_product_quick_view' );

function dqvfwc_product_quick_view() {
	$product_id = filter_input( INPUT_POST, 'product_id' );
	// set the main wp query for the product
	wp( 'p=' . $product_id . '&post_type=product' );
	// remove product thumbnails gallery
	remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

	ob_start();
	while ( have_posts() ) :
		the_post();
		// load content template
		wc_get_template( 'digthis-quick-view/quick-view.php', array(), '', dirname( DQVFW_FILE_PATH ) . '/templates/' );
		?>


		<style>
			.product.has-default-attributes.has-children > .images {
				opacity: 1;
			}
		</style>
		<?php
	endwhile; // end of the loop.
	echo ob_get_clean();
	die;
}