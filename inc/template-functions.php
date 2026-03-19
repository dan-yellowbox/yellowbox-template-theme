<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package yellowbox
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function yellowbox_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'yellowbox_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function yellowbox_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'yellowbox_pingback_header' );

// Disable Gutenberg
add_filter('use_block_editor_for_post', '__return_false');

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

// Remove WP version number
remove_action('wp_head', 'wp_generator');

// Remove [...] from excerpt
function wpdocs_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

// Setting excerpt length
function mytheme_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );

// Removing P tagd from CF7
add_filter('wpcf7_autop_or_not', '__return_false');

// Remove Title Prefixes
add_filter( 'get_the_archive_title', function ($title) {
	if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>' ;
		} elseif ( is_tax() ) { //for custom post types
			$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
		} elseif (is_post_type_archive()) {
			$title = post_type_archive_title( '', false );
		}
	return $title;
});

// Allow SVG upload
add_filter('upload_mimes', 'add_mime_types');
if (!function_exists('add_mime_types')) {
  function add_mime_types($mimes) {
    if( is_admin() ) {
      $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
  }
}

// Adding size option to images
add_filter('attachment_fields_to_edit', 'size_option_attachment_fields_to_edit', 15, 2);
function size_option_attachment_fields_to_edit($form_fields, $post) {

  $post_custom = get_post_custom($post->ID);
  $image_size_select = $post_custom["_image_size_select"][0];

  $select_size_html = "<select name='attachments[" . $post->ID . "][image_size_select]'>"
    . '<option '.selected(get_post_meta($post->ID, "_image_size_select", true), 'full',false).' value="full">Full</option>'
    . '<option '.selected(get_post_meta($post->ID, "_image_size_select", true), 'half',false).' value="half">Half</option>'
    . '<option '.selected(get_post_meta($post->ID, "_image_size_select", true), 'third',false).' value="third">Third</option>'
    . '<option '.selected(get_post_meta($post->ID, "_image_size_select", true), 'quater',false).' value="quater">Quater</option>'
    . '</select>';

  $form_fields['image_size_select'] = array(
    'label' => 'Image Size',
    'input' => 'html',
    'helps' => 'Used for the "Images" block',
    'html' => $select_size_html,
  );

  return $form_fields;
}

// Saving size option to images
add_filter('attachment_fields_to_save', 'size_option_attachment_fields_to_save', 10, 2);
function size_option_attachment_fields_to_save($post, $attachment) {
  if ( isset($attachment['image_size_select']) && $attachment['image_size_select'] ) {
    update_post_meta($post['ID'], '_image_size_select', $attachment['image_size_select']);
  } else {
    delete_post_meta($post['ID'], '_image_size_select');
  }
}

// Adding custom styles to the WordPress editor
function yellowbox_styles( $init_array ) {

    $style_formats = array(
        array(
            'title' => 'Display 1',
            'block' => 'span',
            'classes' => 'display-1',
            'wrapper' => true,
        ),
        array(
            'title' => 'Display 2',
            'block' => 'span',
            'classes' => 'display-2',
            'wrapper' => true,
        ),
        array(
            'title' => 'Display 3',
            'block' => 'span',
            'classes' => 'display-3',
            'wrapper' => true,
        ),
        array(
            'title' => 'Display 4',
            'block' => 'span',
            'classes' => 'display-4',
            'wrapper' => true,
        ),
        array(
            'title' => 'Display 5',
            'block' => 'span',
            'classes' => 'display-5',
            'wrapper' => true,
        ),
        array(
            'title' => 'Display 6',
            'block' => 'span',
            'classes' => 'display-6',
            'wrapper' => true,
        ),
        array(
            'title' => 'Heading 1',
            'block' => 'span',
            'classes' => 'fs-1',
            'wrapper' => true,
        ),
        array(
            'title' => 'Heading 2',
            'block' => 'span',
            'classes' => 'fs-2',
            'wrapper' => true,
        ),
        array(
            'title' => 'Heading 3',
            'block' => 'span',
            'classes' => 'fs-3',
            'wrapper' => true,
        ),
        array(
            'title' => 'Heading 4',
            'block' => 'span',
            'classes' => 'fs-4',
            'wrapper' => true,
        ),
        array(
            'title' => 'Heading 5',
            'block' => 'span',
            'classes' => 'fs-5',
            'wrapper' => true,
        ),
        array(
            'title' => 'Heading 6',
            'block' => 'span',
            'classes' => 'fs-6',
            'wrapper' => true,
        ),
        array(
            'title' => 'Small',
            'block' => 'small',
            'wrapper' => true,
        ),
    );
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );
    return $init_array;

}
add_filter( 'tiny_mce_before_init', 'yellowbox_styles' );

function add_style_select_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'add_style_select_buttons' );

function kwh_add_editor_style( $mceInit ) {
  // This example works with Twenty Sixteen.
  $background_color = 'red';
  $styles = '.mce-content-body { background-color: #' . $background_color . '; }';

  if ( !isset( $mceInit['content_style'] ) ) {
    $mceInit['content_style'] = $styles . ' ';
  } else {
    $mceInit['content_style'] .= ' ' . $styles . ' ';
  }

  return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'kwh_add_editor_style' );

// Move Yoast Meta Box to bottom
function yoast_metabox_position() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_metabox_position');

// Collapse Yoast Meta Box
function yoast_metabox_collapse() {
  echo '<script>jQuery( document ).ready(function() { jQuery(".yoast.wpseo-metabox").addClass("closed"); });</script>';
}
add_action( 'admin_head', 'yoast_metabox_collapse' );

// Shortcodes

	// [button][/button]
	function button_shortcode( $atts, $content = null ) {
		$a = shortcode_atts( array(
			'link' => '#',
			'class' => '',
			'icon' => '',
		), $atts );
		if( $a['icon'] ) {
			return '<a href="' . esc_attr($a['link']) . '" class="btn ' . esc_attr($a['class']) . '">' . $content . ' <i class="' . esc_attr($a['icon']) . ' ms-3"></i></a>';
		} else {
			return '<a href="' . esc_attr($a['link']) . '" class="btn ' . esc_attr($a['class']) . '">' . $content . '</a>';
		}
	}
	add_shortcode( 'button', 'button_shortcode' );

// ACF Options Pages
add_action('init', function() {

  if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Site Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'site-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Company Settings',
        'menu_title'    => 'Company Settings',
        'parent_slug'   => 'site-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Header',
        'menu_title'    => 'Header',
        'parent_slug'   => 'site-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Footer Config',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'site-settings',
    ));


    acf_add_options_page(array(
        'page_title'    => 'Theme Config',
        'menu_title'    => 'Theme Config',
        'menu_slug'     => 'theme-config',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
  }

});

/**
 * Register both the Yellowbox and Checklist buttons
 */
function yellowbox_custom_tinymce_buttons() {
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        return;
    }
    
    if ( get_user_option( 'rich_editing' ) !== 'true' ) {
        return;
    }

    add_filter( 'mce_external_plugins', 'yellowbox_register_tinymce_plugin' );
    add_filter( 'mce_buttons', 'yellowbox_add_tinymce_button' );
}
add_action( 'admin_init', 'yellowbox_custom_tinymce_buttons' );

function yellowbox_add_tinymce_button( $buttons ) {
    // Add both buttons to the toolbar
    array_push( $buttons, 'yellowbox_button', 'yellowbox_checklist_btn' ); 
    return $buttons;
}

function yellowbox_register_tinymce_plugin( $plugins ) {
    // Register the existing button script
    $plugins['yellowbox_button'] = get_template_directory_uri() . '/assets/js/yellowbox-tinymce.js';
    
    // Register the new checklist script
    $plugins['yellowbox_checklist'] = get_template_directory_uri() . '/assets/js/yellowbox-tinymce.js';
    
    return $plugins;
}

function admin_yellow_branding() {
    echo '<style>

        #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, 
        #adminmenu .wp-menu-arrow, #adminmenu li.current a.menu-top, 
        #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, 
        .wp-core-ui .button-primary { 
          background-color: #ffdb57 !important; 
          border-color: #dfb82b !important;
          color: #000 !important;
        }

        #adminmenu .current div.wp-menu-image:before, #adminmenu .wp-has-current-submenu div.wp-menu-image:before, #adminmenu a.current:hover div.wp-menu-image:before, #adminmenu a.wp-has-current-submenu:hover div.wp-menu-image:before, #adminmenu li.wp-has-current-submenu a:focus div.wp-menu-image:before, #adminmenu li.wp-has-current-submenu.opensub div.wp-menu-image:before, #adminmenu li.wp-has-current-submenu:hover div.wp-menu-image:before {
          color: #000 !important;
        }
        
        #adminmenu .wp-submenu a:focus, #adminmenu .wp-submenu a:hover, #adminmenu a:hover, #adminmenu li.menu-top>a:focus {
          color: #ffdb57 !important;
        }

        #adminmenu li a:focus div.wp-menu-image:before, #adminmenu li.opensub div.wp-menu-image:before, #adminmenu li:hover div.wp-menu-image:before {
          color: #ffdb57 !important;
        }

        /* ACF Tweaks */
        .acf-tab-wrap { overflow: hidden; }

    </style>';
}
// add_action('admin_head', 'admin_yellow_branding');