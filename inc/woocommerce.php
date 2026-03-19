<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package yellowbox
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function yellowbox_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 600,
			'single_image_width'    => 1200,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'yellowbox_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function yellowbox_woocommerce_scripts() {

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'yellowbox-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'yellowbox_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function yellowbox_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'yellowbox_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function yellowbox_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'yellowbox_woocommerce_related_products_args' );


// Cross Sell Products
add_filter( 'woocommerce_cross_sells_columns', 'cross_sell_columns' );
	function cross_sell_columns( $columns ) {
	return 4;
}
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

if ( ! function_exists( 'yellowbox_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function yellowbox_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
				<div class="container py-5">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'yellowbox_woocommerce_wrapper_before' );

if ( ! function_exists( 'yellowbox_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function yellowbox_woocommerce_wrapper_after() {
		?>
				</div><!-- #container -->
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'yellowbox_woocommerce_wrapper_after' );

// Setup Minicart

if ( ! function_exists( 'yellowbox_woocommerce_mini_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function yellowbox_woocommerce_mini_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBasket" aria-labelledby="offcanvasBasketLabel">
			<div class="offcanvas-header bg-light">
				<h5 class="offcanvas-title" id="offcanvasExampleLabel">Basket</h5>
				<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body d-flex flex-column">
					<?php echo woocommerce_mini_cart(); ?>
			</div>
		</div>

		<?php
	}
}

// Add Minicart
if ( function_exists( 'yellowbox_woocommerce_mini_cart' ) ) {
	add_action('wp_footer', 'yellowbox_show_minicart');
	function yellowbox_show_minicart() {
		yellowbox_woocommerce_mini_cart();
	}
}

// Sidebar
function disable_woo_commerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('init', 'disable_woo_commerce_sidebar');
register_sidebar( array(
	'name' => __( 'shop', 'wpb' ),
	'id' => 'shop',
	'description' => __( ' shop ','wpb' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h4 class="widget-title">',
	'after_title' => '</h4>',
) );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_sidebar', 60 );
function woocommerce_sidebar() {
	if ( is_active_sidebar( 'shop' ) ) :
		echo '<div id="sidebar-shop" class="sidebar shop-sidebar widget-area" role="complementary">';
			dynamic_sidebar( 'shop' );
		echo '</div>';
	endif;
}

/**
 * Restructure Archive Pages
 */

 // Remove default WooCommerce wrapper.
 remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
 remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

 // Adding Wrapper around results count
 add_action( 'woocommerce_before_shop_loop', 'theme_woocommerce_results_meta_container', 10 );
 add_action( 'woocommerce_before_shop_loop', 'theme_woocommerce_product_container_close', 30 );
 if ( ! function_exists( 'theme_woocommerce_results_meta_container' ) ) {
 	function theme_woocommerce_results_meta_container() {
 		echo '<div class="results-meta">';
 	}
 }
 if ( ! function_exists( 'theme_woocommerce_product_container_close' ) ) {
 	function theme_woocommerce_product_container_close() {
 		echo '</div>';
 	}
 }

// Adding Wrapper Around Products Body
add_action( 'woocommerce_before_shop_loop', 'theme_woocommerce_product_columns_wrapper', 40 );
add_action( 'woocommerce_after_shop_loop', 'theme_woocommerce_product_columns_wrapper_close', 40 );
if ( ! function_exists( 'theme_woocommerce_product_columns_wrapper' ) ) {
	function theme_woocommerce_product_columns_wrapper() {
		echo '<div class="products-wrapper">';
	}
}
if ( ! function_exists( 'theme_woocommerce_product_columns_wrapper_close' ) ) {
	function theme_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}

// Adding Container Around Products
add_action( 'woocommerce_before_shop_loop', 'theme_woocommerce_product_container', 70 );
add_action( 'woocommerce_after_shop_loop', 'theme_woocommerce_product_container_close', 40 );
if ( ! function_exists( 'theme_woocommerce_product_container' ) ) {
	function theme_woocommerce_product_container() {
		echo '<div class="products-container">';
	}
}
if ( ! function_exists( 'theme_woocommerce_product_container_close' ) ) {
	function theme_woocommerce_product_container_close() {
		echo '</div>';
	}
}

/**
 * Restructure Product Pages
 */

// Single Product Overview Wrapper
add_action( 'woocommerce_before_single_product_summary', 'product_overview_wrapper_start');
add_action( 'woocommerce_after_single_product_summary', 'product_overview_wrapper_end', 5);
function product_overview_wrapper_start() {
  echo '<section class="single-product-wrapper">';
}
function product_overview_wrapper_end() {
  echo '</section>';
}

// Adding Product -/+ quantity button
add_action( 'woocommerce_before_quantity_input_field', 'product_display_quantity_plus' );
add_action( 'woocommerce_after_quantity_input_field', 'product_display_quantity_minus', 0 );
function product_display_quantity_plus() {
	global $product;
	if( ( is_product() && ! $product->is_sold_individually() ) || is_cart() ) {
		echo '<div class="input-group quantity-input-group">';
		echo '<button class="btn btn-light border-0 bg-transparent minus" type="button">-</button>';
	}
}
function product_display_quantity_minus() {
	global $product;
	if( ( is_product() && ! $product->is_sold_individually() ) || is_cart() ) {
		echo '<button class="btn btn-light border-0 bg-transparent plus" type="button">+</button>';
 		echo '</div>';
 	}
}
add_filter( 'woocommerce_cart_item_quantity', 'wc_cart_item_quantity', 10, 3 );
function wc_cart_item_quantity( $product_quantity, $cart_item_key, $cart_item ){
	$WC_Product = new WC_Product($cart_item['product_id']);
	$is_sold_individually = $WC_Product->is_sold_individually();
  if( $is_sold_individually == 1 ){
      $product_quantity = sprintf( '%2$s <input type="hidden" name="cart[%1$s][qty]" value="%2$s" />', $cart_item_key, $cart_item['quantity'] );
  }
  return $product_quantity;
}

// Custom added to cart message
add_filter( 'wc_add_to_cart_message_html', 'custom_add_to_cart_message' );
function custom_add_to_cart_message() {
	echo '<script>
	document.addEventListener("DOMContentLoaded", function() {
		var offcanvasBasket = document.getElementById("offcanvasBasket");
		var bsOffcanvas2 = new bootstrap.Offcanvas(offcanvasBasket)
		bsOffcanvas2.show()
	});
	</script>';
	// return $message;
}

// Moving Tabs
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 40 );

// Adding Content Blocks
if( function_exists('acf_add_local_field_group') ):
	acf_add_local_field_group(array(
		'key' => 'group_640216aece4f0',
		'title' => 'Product Blocks',
		'fields' => array(
			array(
				'key' => 'field_640216d86edf5',
				'label' => 'Blocks',
				'name' => 'product_blocks',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => array(
					0 => 'group_605b13e9b8ce7',
				),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
				),
			),
		),
		'menu_order' => 999,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));
endif;	
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_product_blocks', 10 );
function woocommerce_product_blocks() {
	echo '</div></div><div class="product-blocks">';
		get_template_part( 'template-parts/content-blocks' );
	echo '</div><div><div class="container py-5">';
}

/**
 * Checkout Page
 */

// Removing Company Name Field At Checkout
add_filter( 'woocommerce_checkout_fields' , 'remove_company_name' );
function remove_company_name( $fields ) {
   unset($fields['billing']['billing_company']);
   return $fields;
}

// Redesigning Checkout Order Review
add_filter( 'woocommerce_cart_item_name', 'product_image_on_checkout', 10, 3 );
function product_image_on_checkout( $name, $cart_item, $cart_item_key ) {
  if ( ! is_checkout() ) {
    return $name;
  }
  $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
  $image = $_product->get_image();
  $price = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
  $qty = apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key );
  return '<div class="review-image>' . $image . '</div><div class="review-meta">' . '<strong>' . $name . '</strong>' . $qty . $price . '</div>';
}

// Moving Payment Options
function checkout_payment_postition() {
  remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
  add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );
}
add_action( 'after_setup_theme', 'checkout_payment_postition' );


// Remove Shipping Options From Cart
function removing_cart_shipping_options( $show_shipping ) {
  if( is_cart() ) {
    return false;
  }
  return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'removing_cart_shipping_options', 99 );

// Move Coupon Form at Checkout
add_action( 'woocommerce_review_order_before_payment', 'woocommerce_checkout_coupon_form_custom' );
function woocommerce_checkout_coupon_form_custom() {
	if ( ! wc_coupons_enabled() ) { return; }
  echo '<div class="woocommerce-coupon-form coupon-form">
    <p>' . __("If you have a coupon code, please apply it below.") . '</p>
    <p class="form-row form-row-first woocommerce-validated">
      <input type="text" name="coupon_code" class="input-text" placeholder="' . __("Coupon code") . '" id="coupon_code" value="">
    </p>
    <p class="form-row form-row-last">
      <button type="button" class="button" name="apply_coupon" value="' . __("Apply coupon") . '">' . __("Apply coupon") . '</button>
    </p>
  </div>';
}

// Moving Order Summary at Checkout
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
add_action( 'woocommerce_after_order_notes', 'woocommerce_order_review', 15 );
add_action( 'woocommerce_after_order_notes', 'woocommerce_order_review_start', 10 );
add_action( 'woocommerce_after_order_notes', 'woocommerce_order_review_end', 20 );
function woocommerce_order_review_start() {
	echo '<h4 class="d-lg-none">Order Review</h4>';
	echo '<div class="order-review-table">';
}
function woocommerce_order_review_end() {
	echo '</div>';
}

// Move Email Field
add_filter( 'woocommerce_billing_fields', 'woocommerce_billing_email_position' );
function woocommerce_billing_email_position( $address_fields ) {
    $address_fields['billing_email']['priority'] = 1;
    return $address_fields;
}

// Hide default woocommerce coupon field
add_action( 'woocommerce_before_checkout_form', 'hide_checkout_coupon_form', 5 );
function hide_checkout_coupon_form() {
  echo '<style>.woocommerce-form-coupon-toggle {display:none;}</style>';
}

// Coupons Form Custom Script
add_action( 'wp_footer', 'woocoommerce_coupons_script' );
function woocoommerce_coupons_script() {
  if ( is_checkout() && ! is_wc_endpoint_url() ) : ?>
	  <script type="text/javascript">
	  jQuery( function($){
	    $('.coupon-form input[name="coupon_code"]').on( 'input change', function(){
	      $('form.checkout_coupon input[name="coupon_code"]').val($(this).val());
	    });
	    $('.coupon-form button[name="apply_coupon"]').on( 'click', function(){
	      $('form.checkout_coupon').submit();
				$("html, body").animate({ scrollTop: 0 }, 300);
	    });
	  });
	  </script>
  <?php
  endif;
}

