<?php

// Create Post Type
function create_posttype_reviews() {

  $labels = array(
    'name'                => _x( 'Reviews', 'Post Type General Name', 'yellowbox' ),
    'singular_name'       => _x( 'Review', 'Post Type Singular Name', 'yellowbox' ),
    'menu_name'           => __( 'Reviews', 'yellowbox' ),
    'parent_item_colon'   => __( 'Parent Review', 'yellowbox' ),
    'all_items'           => __( 'All Reviews', 'yellowbox' ),
    'view_item'           => __( 'View Review', 'yellowbox' ),
    'add_new_item'        => __( 'Add New Review', 'yellowbox' ),
    'add_new'             => __( 'Add New', 'yellowbox' ),
    'edit_item'           => __( 'Edit Review', 'yellowbox' ),
    'update_item'         => __( 'Update Review', 'yellowbox' ),
    'search_items'        => __( 'Search Review', 'yellowbox' ),
    'not_found'           => __( 'Not Found', 'yellowbox' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'yellowbox' ),
  );

  $args = array(
    'label'               => __( 'reviews', 'yellowbox' ),
    'labels'              => $labels,
    'supports'            => array( 'title' ),
    // You can associate this CPT with a taxonomy or custom taxonomy.
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 30,
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'show_in_rest' => true,
    'menu_icon'           => 'dashicons-format-quote',
  );

  // Registering your Custom Post Type
  register_post_type( 'reviews', $args );
}
add_action( 'init', 'create_posttype_reviews', 10 );