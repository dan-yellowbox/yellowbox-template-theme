<?php
// Create Post Type
function create_posttype_global_blocks() {

  $labels = array(
    'name'                => _x( 'Global Blocks', 'Post Type General Name', 'yellowbox' ),
    'singular_name'       => _x( 'Global Block', 'Post Type Singular Name', 'yellowbox' ),
    'menu_name'           => __( 'Global Blocks', 'yellowbox' ),
    'parent_item_colon'   => __( 'Parent Global Block', 'yellowbox' ),
    'all_items'           => __( 'All Global Blocks', 'yellowbox' ),
    'view_item'           => __( 'View Global Block', 'yellowbox' ),
    'add_new_item'        => __( 'Add New Global Block', 'yellowbox' ),
    'add_new'             => __( 'Add New', 'yellowbox' ),
    'edit_item'           => __( 'Edit Global Block', 'yellowbox' ),
    'update_item'         => __( 'Update Global Block', 'yellowbox' ),
    'search_items'        => __( 'Search Global Block', 'yellowbox' ),
    'not_found'           => __( 'Not Found', 'yellowbox' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'yellowbox' ),
  );

  $args = array(
    'label'               => __( 'global_blocks', 'yellowbox' ),
    'description'         => __( 'Global Blocks', 'yellowbox' ),
    'labels'              => $labels,
    'supports'            => array( 'title' ),
    // You can associate this CPT with a taxonomy or custom taxonomy.
    'hierarchical'        => false,
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 30,
    'can_export'          => true,
    'has_archive'         => false,
    'exclude_from_search' => false,
    'publicly_queryable'  => false,
    'capability_type'     => 'post',
    'show_in_rest' => true,
    'menu_icon'           => 'dashicons-screenoptions',
    'rewrite'     => array( 'slug' => 'global-blocks' ),

  );

  // Registering your Custom Post Type
  register_post_type( 'global_blocks', $args );
}
add_action( 'init', 'create_posttype_global_blocks' );