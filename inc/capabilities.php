<?php

// Disable Blocks
add_filter('acf/load_field/name=blocks', 'disable_acf_blocks');
function disable_acf_blocks($field) {

  foreach ($field['layouts'] as $key => $layout) {
    if ( ! get_field('enable_case_studies', 'options') && $layout['name'] === 'case_studies') {
      unset($field['layouts'][$key]);
    }
  }

  return $field;
}

// Unregister Post Types
function remove_post_types() {
  if ( ! get_field('enable_case_studies', 'options') ) {
    unregister_post_type('case_studies');
  }
}
add_action('init', 'remove_post_types', 20);