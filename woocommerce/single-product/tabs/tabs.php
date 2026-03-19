<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
$tab_count = 1;
$panel_count = 1;

if ( ! empty( $product_tabs ) ) : ?>

<div class="woocommerce-tabs accordion accordion-product border-top mt-4 pt-4" id="accordionProduct">
	<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
	  <div class="accordion-item <?php if( $panel_count > 1 ) { echo 'mt-2'; } ?>">
	    <h2 class="accordion-header" id="product-heading<?php echo $panel_count; ?>">
	      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#product-collapse<?php echo $panel_count; ?>" aria-expanded="false" aria-controls="product-collapse<?php echo $panel_count; ?>">
	        <?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
	      </button>
	    </h2>
	    <div id="product-collapse<?php echo $panel_count; ?>" class="accordion-collapse collapse" aria-labelledby="product-heading<?php echo $panel_count; ?>" data-bs-parent="#accordionProduct">
	      <div class="accordion-body">
	      	<?php if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab );
					} ?>
	      </div>
	    </div>
	  </div>
	<?php $panel_count++; ?>
	<?php endforeach; ?>
</div>
<?php do_action( 'woocommerce_product_after_tabs' ); ?>

<?php endif; ?>
