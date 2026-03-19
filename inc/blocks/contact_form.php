<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';
  
  $heading = get_sub_field('heading');
  $subheading = get_sub_field('subheading');
  $form_shortcode = get_sub_field('form_shortcode');
  $subheading_complex = get_sub_field('subheading_complex');
  $settings_id = get_sub_field('block_settings_id');
  $settings_block_layout =  get_sub_field('block_settings_block_layout');
?>

<section
  id="<?php echo $settings_id; ?>"
  class="
    block-<?php echo get_row_layout(); ?>
    <?php echo block_design_gap_top(); ?>
    <?php echo block_design_gap_bottom(); ?>
    <?php echo block_design_padding_top(); ?>
    <?php echo block_design_padding_bottom(); ?>
    text-<?php echo block_design_background_colour(); ?>
    overflow-hidden
  ">
  <?php if ( $settings_block_layout == 'stacked' ) { ?>
    <?php if( $heading || $subheading ) { ?>
      <div class="container mb-5">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-xl-6 text-center block-content">
            <?php if ( $heading ) { echo '<h2 class="h1">' . $heading . '</h2>'; } ?>
            <?php if ( $subheading ) { echo '<p class="mt-n2">' . $subheading . '</p>'; } ?>
          </div>
        </div>
      </div>
    <?php } ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
          <?php echo do_shortcode($form_shortcode); ?>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <div class="container">
      <div class="row justify-content-center justify-content-xl-between">
        <?php if( $heading || $subheading_complex ) { ?>
          <div class="col-lg-8 col-xl-5 text-center text-xl-start">
            <?php if ( $heading ) { echo '<h2 class="h1">' . $heading . '</h2>'; } ?>
            <?php if ( $subheading_complex ) { echo $subheading_complex; } ?>
          </div>
        <?php } ?>
        <div class="col-xl-6 mt-5 mt-xl-0">
          <?php echo do_shortcode($form_shortcode); ?>
        </div>
      </div>
    </div>
  <?php } ?>
</section>