<?php
if ( ! class_exists( 'Digthis_Quick_View' ) ) {
	class Digthis_Quick_View {
		/**
		 * Instance of this class.
		 * @var object
		 */

		protected static $instance = null;

		/**
		 * Return an instance of this class.
		 * @return object A single instance of this class.
		 */

		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct() {

			add_action( 'init', array( $this, 'digthis_quick_view_woocommerce_hooks' ), 10 );
			add_action( 'wp_enqueue_scripts', array( $this, 'digthis_quick_view_scripts' ), 20 );
		}

		public function digthis_quick_view_scripts() {
			wp_register_style( 'dqvfw-magnific-popup', plugins_url( '/assets/css/magnific-popup.css', DQVFW_FILE_PATH ) );
			wp_register_style( 'dqvfw-popup-style', plugins_url( '/assets/css/digthis-magnific-popup.css', DQVFW_FILE_PATH ), array( 'dqvfw-magnific-popup' ) );
			wp_enqueue_style( 'dqvfw-popup-style' );
			/*Needed for variable products*/
			//wp_enqueue_script( 'wc-add-to-cart-variation' );

			wp_register_script( 'dqvfw-magnific-popup-script', plugins_url( '/assets/js/jquery.magnific-popup.min.js', DQVFW_FILE_PATH ), array( 'jquery', ), '1.0.0', true );

			wp_register_script( 'dqvfw-main', plugins_url( '/assets/js/digthis-quick-view.js', DQVFW_FILE_PATH ), array(
				'jquery',
				'dqvfw-magnific-popup-script',
				'wc-add-to-cart-variation'
			), '1.0.0', true );

			wp_localize_script( 'dqvfw-main', 'digthis', array( 'admin_url' => admin_url( '/admin-ajax.php' ) ) );

			wp_enqueue_script( 'dqvfw-main' );

		}

		public function digthis_quick_view_woocommerce_hooks() {
			/*Add Quick View Button to Loop*/
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'dqvfw_add_quick_view_button' ), 15 );

			// Image
			add_action( 'digthis_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );
			add_action( 'digthis_wcqv_product_image', 'woocommerce_show_product_images', 20 );

			// Summary
			add_action( 'digthis_wcqv_product_summary', 'woocommerce_template_single_title', 5 );
			add_action( 'digthis_wcqv_product_summary', 'woocommerce_template_single_rating', 10 );
			add_action( 'digthis_wcqv_product_summary', 'woocommerce_template_single_price', 15 );
			add_action( 'digthis_wcqv_product_summary', 'woocommerce_template_single_excerpt', 20 );
			add_action( 'digthis_wcqv_product_summary', 'woocommerce_template_single_add_to_cart', 25 );
			add_action( 'digthis_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );

		}

		public function dqvfw_add_quick_view_button() {
			global $product;
			echo '<a href="#" class="button digthis-quick-view" data-product_id="' . $product->id . '">Quick View</a>';
		}
	}//end class

}


add_action( 'plugins_loaded', array( 'Digthis_Quick_View', 'get_instance' ) );