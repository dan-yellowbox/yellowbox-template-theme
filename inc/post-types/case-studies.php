<?php

// Create Taxonomy
add_action( 'init', 'create_case_studies_taxonomy', 10 );
function create_case_studies_taxonomy() {

  $labels = array(
    'name' => _x( 'Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Categories' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ),
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'menu_name' => __( 'Categories' ),
  );

// Now register the taxonomy
  register_taxonomy('case_studies_cat', array('case_studies'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'case-studies/category' ),
  ));
}

// Create Post Type
function create_posttype_case_studies() {

  $labels = array(
    'name'                => _x( 'Case Studies', 'Post Type General Name', 'yellowbox' ),
    'singular_name'       => _x( 'Case Study', 'Post Type Singular Name', 'yellowbox' ),
    'menu_name'           => __( 'Case Studies', 'yellowbox' ),
    'parent_item_colon'   => __( 'Parent Case Study', 'yellowbox' ),
    'all_items'           => __( 'All Case Studies', 'yellowbox' ),
    'view_item'           => __( 'View Case Study', 'yellowbox' ),
    'add_new_item'        => __( 'Add New Case Study', 'yellowbox' ),
    'add_new'             => __( 'Add New', 'yellowbox' ),
    'edit_item'           => __( 'Edit Case Study', 'yellowbox' ),
    'update_item'         => __( 'Update Case Study', 'yellowbox' ),
    'search_items'        => __( 'Search Case Study', 'yellowbox' ),
    'not_found'           => __( 'Not Found', 'yellowbox' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'yellowbox' ),
  );

  $args = array(
    'label'               => __( 'case_studies', 'yellowbox' ),
    'description'         => __( ( get_field('case_studies_subheading', 'options') ? get_field('case_studies_subheading', 'options') : ''), 'yellowbox' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
    // You can associate this CPT with a taxonomy or custom taxonomy.
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 30,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'show_in_rest' => true,
    'menu_icon'           => 'dashicons-format-aside',
    'rewrite'     => array( 'slug' => 'case-studies' ),

  );

  // Registering your Custom Post Type
  register_post_type( 'case_studies', $args );
}
add_action( 'init', 'create_posttype_case_studies', 10 );