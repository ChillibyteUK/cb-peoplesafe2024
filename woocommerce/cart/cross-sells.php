<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( $cross_sells ) :

$show_clip = 0;
foreach( WC()->cart->get_cart() as $cart_item ) {
	$variation_id = $cart_item['variation_id'];
	if ( $variation_id == 7120 ) {
		$show_clip = 1;
	}
}
?>

	<div class="cross-sells">
		<?php
		$product_id = 7117;
		$variation_id = 7120;
		$variation = array( 'attribute_model' => 'Premium' );
		$cart_id = WC()->cart->generate_cart_id( $product_id, $variation_id, $variation );

		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in&hellip;', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
					$clip_id = $cross_sell->get_id();
					$clip_array = array(7107, 7109, 7105);
					if ( ( $show_clip == 1 ) && ( in_array($clip_id,$clip_array) ) ) {
						// DO NOT SHOW CLIP
					} else {
						$post_object = get_post( $cross_sell->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

						wc_get_template_part( 'content', 'product' );
					}
				?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>
	<?php
endif;

wp_reset_postdata();