<?php
/**
 * yellowbox functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package yellowbox
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'yellowbox_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function yellowbox_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary', 'yellowbox' ),
				'mobile-menu' => esc_html__( 'Mobile', 'yellowbox' ),
			)
		);

		// Bootstrap navigation
		function bootstrap_navigation() {
	    wp_nav_menu( array(
        'theme_location'    => 'primary-menu',
        'depth'             => 2,
        'fallback_cb'       => 'bootstrap_navwalker::fallback',
        'walker'            => new bootstrap_navwalker(),
        'container' => '%3$s',
        'items_wrap' => '%3$s',
      ) );
		}
		function mobile_navigation() {
	    wp_nav_menu( array(
        'theme_location'    => 'mobile-menu',
        'depth'             => 2,
        'fallback_cb'       => 'bootstrap_navwalker::fallback',
        'walker'            => new bootstrap_navwalker(),
        'container' => '%3$s',
        'items_wrap' => '%3$s',
      ) );
		}

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'yellowbox_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yellowbox_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'yellowbox_content_width', 640 );
}
add_action( 'after_setup_theme', 'yellowbox_content_width', 0 );

// Image Sizes
add_image_size( 'acf-thumbnail', 100, 100 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function yellowbox_widgets_init() {
	register_sidebar( array(
  	'name' => __( 'Footer 1', 'yellowbox' ),
  	'id' => 'footer-1',
  	'description' => __( ' Footer 1 ','yellowbox' ),
  	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  	'after_widget' => '</aside>',
  	'before_title' => '<h4 class="widget-title fs-5 mb-4">',
  	'after_title' => '</h4>',
  ) );
  register_sidebar( array(
  	'name' => __( 'Footer 2', 'yellowbox' ),
  	'id' => 'footer-2',
  	'description' => __( ' Footer 2 ','yellowbox' ),
  	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  	'after_widget' => '</aside>',
  	'before_title' => '<h4 class="widget-title fs-5 mb-4">',
  	'after_title' => '</h4>',
  ) );
  register_sidebar( array(
  	'name' => __( 'Footer 3', 'yellowbox' ),
  	'id' => 'footer-3',
  	'description' => __( ' Footer 3 ','yellowbox' ),
  	'before_widget' => '<aside id="%1$s" class="widget  %2$s">',
  	'after_widget' => '</aside>',
  	'before_title' => '<h4 class="widget-title fs-5 mb-4">',
  	'after_title' => '</h4>',
  ) );
  register_sidebar( array(
  	'name' => __( 'Footer 4', 'yellowbox' ),
  	'id' => 'footer-4',
  	'description' => __( ' Footer 4 ','yellowbox' ),
  	'before_widget' => '<aside id="%1$s" class="widget  %2$s">',
  	'after_widget' => '</aside>',
  	'before_title' => '<h4 class="widget-title fs-5 mb-4">',
  	'after_title' => '</h4>',
  ) );
  register_sidebar( array(
  	'name' => __( 'Footer Bottom', 'yellowbox' ),
  	'id' => 'footer-bottom',
  	'description' => __( ' Footer Bottom ','yellowbox' ),
  	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
  	'after_widget' => '</aside>',
  	'before_title' => '<h6 class="widget-title">',
  	'after_title' => '</h6>',
  ) );
}
add_action( 'widgets_init', 'yellowbox_widgets_init' );

/**
 * Scripts and Styles.
 */
function yellowbox_scripts() {

	// JQuery
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), _S_VERSION, true );

	// Slick Slider CSS
	wp_enqueue_style( 'yellowbox-slick-slider-style', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), _S_VERSION );
	wp_enqueue_script( 'yellowbox-slick-slider-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array(), _S_VERSION, true );

	// Bootstrap JS
	wp_enqueue_script( 'yellowbox-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), _S_VERSION, true );

	// Yellow Box Theme
	wp_enqueue_style( 'yellowbox-theme-style', get_template_directory_uri() . '/assets/css/theme.css', array(), _S_VERSION );
	wp_enqueue_script( 'yellowbox-theme-scripts', get_template_directory_uri() . '/assets/js/theme.js', array(), _S_VERSION, true );

	// Post Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Dequeue Scripts and Styles
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'woocommerce-inline' );
}
add_action( 'wp_enqueue_scripts', 'yellowbox_scripts' );

/**
 * Enqueue Admin Files
 */
add_action( 'after_setup_theme', 'add_admin_styles' );
function add_admin_styles() {
     add_theme_support('editor-styles');
     add_editor_style(get_template_directory_uri() . '/assets/css/admin.css');
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Plugin Activator
 */
require get_template_directory() . '/inc/plugin-activator.php';

/**
 * Theme Activator
 */
require get_template_directory() . '/inc/theme-activator.php';

/**
 * ACF Fields
 */
 require get_template_directory() . '/inc/acf-fields.php';

/**
 * Bootstrap Navigation
 */
require get_template_directory() . '/inc/bootstrap-navigation.php';

/**
 * Gravity Forms
 */
require get_template_directory() . '/inc/gravity-forms.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load Custom Post Types
 */
require get_template_directory() . '/inc/post-types/case-studies.php';
require get_template_directory() . '/inc/post-types/global-blocks.php';

/**
 * Capabilities
 */
require get_template_directory() . '/inc/capabilities.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Convert HEX to RGB (usage: hexToRgbString(#000) output: 0, 0, 0)
function hexToRgbString(string $hex): string
{
    $hex = ltrim($hex, '#');

    if (strlen($hex) === 3) {
        $hex = preg_replace('/(.)/', '$1$1', $hex);
    }

    if (strlen($hex) !== 6) {
        throw new InvalidArgumentException('Invalid hex color.');
    }

    $rgb = [
        hexdec(substr($hex, 0, 2)),
        hexdec(substr($hex, 2, 2)),
        hexdec(substr($hex, 4, 2)),
    ];

    return implode(', ', $rgb);
}

// Darken Colour
function darkenColor(string $hex, float $percent = 10): string
{
    // Remove # if present
    $hex = ltrim($hex, '#');

    // Expand short form (e.g. #abc → #aabbcc)
    if (strlen($hex) === 3) {
        $hex = "{$hex[0]}{$hex[0]}{$hex[1]}{$hex[1]}{$hex[2]}{$hex[2]}";
    }

    // Convert to RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    $factor = 1 - ($percent / 100);

    // Darken each channel
    $r = max(0, round($r * $factor));
    $g = max(0, round($g * $factor));
    $b = max(0, round($b * $factor));

    // Return hex color
    return sprintf('#%02x%02x%02x', $r, $g, $b);
}

// Check Contrast
function getContrastColor($hexColor) {
    // Remove the hash if it exists
    $hexColor = str_replace('#', '', $hexColor);

    // Convert hex to RGB
    $r = hexdec(substr($hexColor, 0, 2));
    $g = hexdec(substr($hexColor, 2, 2));
    $b = hexdec(substr($hexColor, 4, 2));

    // Calculate relative luminance (YIQ/Luma)
    // Range is 0 to 255. 128 is the middle ground.
    $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

    // If luminance is high, return 'dark', else return 'light'
    return ($yiq >= 128) ? 'dark' : 'light';
}

/**
 * Handle CSS generation from ACF Theme Settings button
 */
add_action( 'acf/options_page/save', 'my_generate_css_on_options_save', 20, 2 );
function my_generate_css_on_options_save( $post_id, $menu_slug ) {

    // Only run on ACF Options Page
    if ( $menu_slug !== 'theme-config' ) {
        return;
    }

    $values = get_fields( $post_id );
    $body_font = ( get_field( 'font_family_body', 'options' ) ?? 'system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";' );
    $headings_font = ( get_field('font_family_headings', 'options') ?? $body_font );
    $body_background = ( get_field( 'body_background', 'options' ) ?? '#fff' );
    $primary_colour = ( get_field( 'primary_colour', 'options' ) ?? '#000' );
    $primary_light_colour = ( get_field( 'primary_light_colour', 'options' ) ?? '#f4f4f4' );
    $primary_dark_colour = ( get_field( 'primary_dark_colour', 'options' ) ?? '#333333' );
    $secondary_colour = ( get_field( 'secondary_colour', 'options' ) ?? '#333' );
    $light_colour = ( get_field( 'light_colour', 'options' ) ?? '#333' );
    $dark_colour = ( get_field( 'dark_colour', 'options' ) ?? '#333' );
    $background_overlay = ( get_field( 'background_overlay', 'options' ) ?? 'rgba(0,0,0,0.3' );
    $font_weight_bold = ( get_field( 'font_weight_bold', 'options' ) ?? '600' );

    $border_radius = ( get_field('border_radius', 'options') ? get_field('border_radius', 'options') : '0.375' );
    $border_radius_sm = $border_radius / 1.5;
    $border_radius_lg = $border_radius * 1.5;

    // Determine the contrast type
    $contrast_type = getContrastColor($primary_colour);

    // Set the button text variable
    $text_bg_primary = ($contrast_type === 'light') ? '255, 255, 255' : hexToRgbString($dark_colour);

    // Capability check
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    // Generate CSS (example – customize this)
    $css = "
		/* AUTOMATICALLY GENEREATED FILE - DO NOT EDIT */

		:root,
		[data-bs-theme=light] {
		  --bs-primary: " . $primary_colour . ";
		  --bs-primary-hover: " . darkenColor($primary_colour, 10) . ";
		  --bs-primary-light: " . $primary_light_colour . ";
		  --bs-primary-light-hover: " . darkenColor($primary_light_colour, 10) . ";
      --bs-primary-dark: " . $primary_dark_colour . ";
      --bs-primary-dark-hover: " . darkenColor($primary_dark_colour, 10) . ";
		  --bs-secondary: " . $secondary_colour . ";
		  --bs-secondary-hover: " . darkenColor($secondary_colour, 10) . ";
		  --bs-white: #ffffff;
      --bs-light: " . $light_colour . ";
		  --bs-light-hover:  " . darkenColor($light_colour, 10) . ";
		  --bs-dark:  " . $dark_colour . ";
		  --bs-dark-hover: " . darkenColor($dark_colour, 10) . ";
		  --bs-primary-rgb: " . hexToRgbString($primary_colour) . ";
		  --bs-secondary-rgb: " . hexToRgbString($secondary_colour) . ";
		  --bs-white-rgb: 255, 255, 255;
      --bs-light-rgb: " . hexToRgbString($light_colour) . ";
		  --bs-dark-rgb: " . hexToRgbString($dark_colour) . ";
		  --bs-primary-text-emphasis: #052c65;
		  --bs-secondary-text-emphasis: #2b2f32;
		  --bs-light-text-emphasis: #495057;
		  --bs-dark-text-emphasis: #495057;
		  --bs-primary-bg-subtle: #cfe2ff;
		  --bs-secondary-bg-subtle: #e2e3e5;
		  --bs-light-bg-subtle: #fcfcfd;
		  --bs-dark-bg-subtle: #ced4da;
		  --bs-primary-border-subtle: #9ec5fe;
		  --bs-secondary-border-subtle: #c4c8cb;
		  --bs-light-border-subtle: #e9ecef;
		  --bs-dark-border-subtle: #adb5bd;
		  --bs-font-sans-serif: " . $body_font . ";
		  --bs-font-serif: " . $headings_font . ";
		  --bs-body-font-size: 1rem;
		  --bs-body-font-weight: 400;
		  --bs-body-line-height: 1.5;
		  --bs-body-color: #212529;
		  --bs-body-color-rgb: 33, 37, 41;
		  --bs-body-bg: " . $body_background . ";
		  --bs-body-bg-rgb: 255, 255, 255;
		  --bs-emphasis-color: #000;
		  --bs-emphasis-color-rgb: 0, 0, 0;
		  --bs-secondary-color: rgba(33, 37, 41, 0.75);
		  --bs-secondary-color-rgb: 33, 37, 41;
		  --bs-secondary-bg: #e9ecef;
		  --bs-secondary-bg-rgb: 233, 236, 239;
		  --bs-tertiary-color: rgba(33, 37, 41, 0.5);
		  --bs-tertiary-color-rgb: 33, 37, 41;
		  --bs-tertiary-bg: #f8f9fa;
		  --bs-tertiary-bg-rgb: 248, 249, 250;
		  --bs-heading-color: inherit;
		  --bs-link-color: var(--bs-body-color);
		  --bs-link-color-rgb: var(--bs-body-color-rgb);
		  --bs-link-decoration: underline;
		  --bs-link-hover-color: var(--bs-primary);
		  --bs-link-hover-color-rgb: var(--bs-primary-rgb);
		  --bs-code-color: #d63384;
		  --bs-highlight-color: #212529;
		  --bs-highlight-bg: #fff3cd;
		  --bs-border-width: 1px;
		  --bs-border-style: solid;
		  --bs-border-color: #dee2e6;
		  --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
		  --bs-border-radius: " . $border_radius . "rem;
		  --bs-border-radius-sm: " . $border_radius_sm . "rem;
		  --bs-border-radius-lg: " . $border_radius_lg . "rem;
		  --bs-border-radius-xl: " . $border_radius_lg . "rem;
		  --bs-border-radius-xxl:  " . $border_radius_lg . "rem;
		  --bs-border-radius-2xl:  " . $border_radius_lg . "rem;
		  --bs-border-radius-pill: 50rem;
		  --bs-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
		  --bs-box-shadow-sm: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
		  --bs-box-shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.175);
		  --bs-box-shadow-inset: inset 0 1px 2px rgba(0, 0, 0, 0.075);
		  --bs-focus-ring-width: 0.25rem;
		  --bs-focus-ring-opacity: 0.25;
		  --bs-focus-ring-color: rgba(13, 110, 253, 0.25);
		  --bs-form-valid-color: #198754;
		  --bs-form-valid-border-color: #198754;
		  --bs-form-invalid-color: #dc3545;
		  --bs-form-invalid-border-color: #dc3545;
		  --bs-background-overlay: " . $background_overlay . ";
		  --bs-font-weight-bold: " . $font_weight_bold . ";
		}

    .bg-primary-light {
      background-color: var(--bs-primary-light);
    }

    /* Typography */

		h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .display-1, .display-2, .display-3, .display-5, .display-6 {
			font-family: var(--bs-font-serif);
		}

		.ff-serif {
			font-family: var(--bs-font-serif);
		}

		.ff-sans {
			font-family: var(--bs-font-sans-serif);
		}

    b,
    strong,
    bold,
    .fw-bold,
    .display-1, 
    .display-2, 
    .display-3, 
    .display-4, 
    .display-5, 
    .display-6 {
      font-weight: " . $font_weight_bold . ";
    }

    .text-bg-primary {
      color: rgb(" . $text_bg_primary .  ") !important;
    }

    /* Buttons */

		.btn-primary {
		  --bs-btn-color: rgb(" . $text_bg_primary . ");
		  --bs-btn-bg: var(--bs-primary);
		  --bs-btn-border-color: transparent;
		  --bs-btn-hover-color: rgb(" . $text_bg_primary . ");
		  --bs-btn-hover-bg: var(--bs-primary-hover);
		  --bs-btn-hover-border-color: transparent;
		  --bs-btn-active-color:  rgb(" . $text_bg_primary . ");
		  --bs-btn-active-bg: var(--bs-primary-hover);
		}

    .btn-primary-light {
      --bs-btn-color: var(--bs-dark);
      --bs-btn-bg: var(--bs-primary-light);
      --bs-btn-border-color: transparent;
      --bs-btn-hover-color: var(--bs-dark);
      --bs-btn-hover-bg: var(--bs-primary-light-hover);
      --bs-btn-hover-border-color: transparent;
      --bs-btn-active-color: var(--bs-dark);
      --bs-btn-active-bg: var(--bs-primary-light-hover);
    }

    .btn-white {
      --bs-btn-color: var(--bs-dark);
      --bs-btn-bg: rgb(var(--bs-white-rgb));
      --bs-btn-border-color: transparent;
      --bs-btn-hover-color: var(--bs-dark);
      --bs-btn-hover-bg: rgba(var(--bs-white-rgb), 0.6);
      --bs-btn-hover-border-color: transparent;
      --bs-btn-active-color: var(--bs-dark);
      --bs-btn-active-bg: rgba(var(--bs-white-rgb), 0.6);
    }

    .btn-primary-dark {
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: rgba(var(--bs-dark-rgb), 1);
      --bs-btn-border-color: transparent;
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: rgba(var(--bs-dark-rgb), 0.6);
      --bs-btn-hover-border-color: transparent;
      --bs-btn-active-color: var(--bs-white);
      --bs-btn-active-bg: rgba(var(--bs-dark-rgb), 0.6);
    }

    .btn-secondary {
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bs-secondary);
      --bs-btn-border-color: transparent;
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: var(--bs-secondary-hover);
      --bs-btn-hover-border-color: transparent;
      --bs-btn-active-color: var(--bs-white);
      --bs-btn-active-bg: var(--bs-secondary-hover);
    }

    /* Creating buttons with opacity */

    .btn-bg-primary {
      --bs-btn-color: " . ($contrast_type === 'light' ? $dark_colour : $light_colour ) . ";
      --bs-btn-bg: rgba(" . $text_bg_primary . ", var(--bs-bg-opacity));
      --bs-btn-border-color: transparent;
      --bs-btn-hover-color: " . ($contrast_type === 'light' ? $dark_colour : $light_colour ) . ";
      --bs-btn-hover-bg: rgba(" . $text_bg_primary . ", 0.6);
      --bs-btn-hover-border-color: transparent;
      --bs-btn-active-color: " . ($contrast_type === 'light' ? $dark_colour : $light_colour ) . ";
      --bs-btn-active-bg: rgba(" . $text_bg_primary . ", 0.6);
    }

    .btn-bg-dark {
      --bs-btn-color: var(--bs-dark);
      --bs-btn-bg: rgba(var(--bs-white-rgb), var(--bs-bg-opacity));
      --bs-btn-border-color: transparent;
      --bs-btn-hover-color: var(--bs-dark);
      --bs-btn-hover-bg: rgba(var(--bs-white-rgb), 0.6);
      --bs-btn-hover-border-color: transparent;
      --bs-btn-active-color: var(--bs-dark);
      --bs-btn-active-bg: rgba(var(--bs-white-rgb), 0.6);
    }

    .btn-bg-light, .btn-, .btn-bg-graylighter {
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity));
      --bs-btn-border-color: transparent;
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: rgba(var(--bs-dark-rgb), 0.6);
      --bs-btn-hover-border-color: transparent;
      --bs-btn-active-color: var(--bs-white);
      --bs-btn-active-bg: rgba(var(--bs-dark-rgb), 0.6);
    }

    /* Forms */

    .text-bg-primary {

      label.form-label {
        color: rgb(" . $text_bg_primary . ") !important;
      }
    }

    .text-bg-dark,
    .text-bg-primary-dark {

      label.form-label {
        color: var(--bs-white) !important;
      }
    }

    .text-bg-white,
    .text-bg-primary-light,
    .text-bg-light {

      label.form-label {
        color: var(--bs-dark) !important;
      }
    }

    /* Slick */

    .text-bg-primary {

      .slick-arrow {
        color: rgb(" . $text_bg_primary . ") !important;
        border-color: rgb(" . $text_bg_primary . ") !important;
      }
    }

    .text-bg-dark,
    .text-bg-primary-dark {

      .slick-arrow{
        color: var(--bs-white) !important;
        border-color: var(--bs-white) !important;
      }

      .slick-dots li button {
        background-color: rgba(var(--bs-white-rgb), 0.5) !important;
        border-color: rgba(var(--bs-white-rgb), 0.5) !important;
      }

      .slick-dots li.slick-active button {
        background-color: var(--bs-white) !important;
        border-color: var(--bs-white) !important;
      }
    }
    ";

    // File path (uploads directory is safest)
    $theme_dir  = get_stylesheet_directory();
    $css_file = $theme_dir . '/assets/css/variables.css';

    // Ensure directory exists
    if ( ! file_exists( $theme_dir ) ) {
        wp_mkdir_p( $theme_dir );
    }

    // Write / overwrite the file
    file_put_contents( $css_file, $css );
}

/**
 * Self-Hosted Theme Update Script
 */
function yellowbox_theme_update_check( $transient ) {
    if ( empty( $transient->checked ) ) {
        return $transient;
    }

    $theme_slug = 'yellow-box-theme';
    $remote_url = 'https://yellowboxmarketing.co.uk/resources/theme-update.json';

    // 1. Get the remote JSON
    $response = wp_remote_get( $remote_url, array(
        'timeout' => 10,
        'headers' => array( 'Accept' => 'application/json' )
    ));

    if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
        return $transient;
    }

    $remote_data = json_decode( wp_remote_retrieve_body( $response ) );

    // 2. Compare versions
    if ( $remote_data && version_compare( $transient->checked[$theme_slug], $remote_data->new_version, '<' ) ) {
        
        $res = array(
            'theme'       => $theme_slug,
            'new_version' => $remote_data->new_version,
            'url'         => $remote_data->url,
            'package'     => $remote_data->package,
        );

        $transient->response[$theme_slug] = $res;
    }

    return $transient;
}

add_filter( 'site_transient_update_themes', 'yellowbox_theme_update_check' );


