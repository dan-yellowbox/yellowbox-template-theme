<?php
  $heading = get_sub_field('heading');
  $subheading = get_sub_field('subheading');

  /*
   * To use: include the above variables
   * <?php if( $heading || $subheading ) { ?>
   *   <?php get_template_part('inc/blocks/global-block-heading'); ?>
   * <?php } ?>
  */
?>

<div class="container block-heading mb-5">
  <div class="row justify-content-between align-items-end">
    <div class="col-lg-7">
      <?php echo ( $heading ? '<h3 class="display-6">' . $heading . '</h3>' : '' ); ?>
      <?php echo ( $subheading ? '<p class="mt-n2">' . $subheading . '</p>' : '' ); ?>
    </div>
    <div class="col-lg-auto">
      <div class="controls"></div>
    </div>
  </div>
</div>
