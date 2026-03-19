<?php
  $block = get_sub_field('global_block');

  if(have_rows('blocks', $block)):

    while(have_rows('blocks', $block)): the_row();
      get_template_part('inc/blocks/' . get_row_layout());
    endwhile;

    wp_reset_query();

  endif;