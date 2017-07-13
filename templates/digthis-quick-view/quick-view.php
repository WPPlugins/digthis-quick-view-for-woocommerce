<div id="digthis-quick-view-container" class="woocommerce single-product">
	<div class="product">
		<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>"
		     id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?>>

			<?php do_action( 'digthis_wcqv_product_image' ); ?>

			<div class="summary entry-summary">
				<div class="summary-content">
					<?php do_action( 'digthis_wcqv_product_summary' ); ?>
				</div>
			</div>

		</div>
		<div style="clear:both"></div>
	</div>
</div>
<style>
	.product.has-default-attributes.has-children > .images {
		opacity: 1;
	}
</style>