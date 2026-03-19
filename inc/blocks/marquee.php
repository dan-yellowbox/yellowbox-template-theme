<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';

  $image_height = get_sub_field('image_height');
  $images = get_sub_field('images');
  $image_count = 0;
  $unique_id = rand();
  $speed = count(get_sub_field('images')) * 3000;

  $settings_id = get_sub_field('block_settings_id');
?>

<section
  id="<?php echo $settings_id; ?>"
  class="
    block-<?php echo get_row_layout(); ?>
    <?php echo block_design_gap_top(); ?>
    <?php echo block_design_gap_bottom(); ?>
    <?php echo block_design_padding_top(); ?>
    <?php echo block_design_padding_bottom(); ?>
    <?php echo block_design_background_colour(); ?>
    overflow-hidden
  ">
  <div class="marquee vw-100">
    <div id="marquee<?php echo $unique_id; ?>" class="marquee-track">
      <?php foreach( $images as $image ) { ?>
        <div class="item">
          <?php echo wp_get_attachment_image($image['ID'], 'medium', '', array('style'=> 'height:' . $image_height . 'px')); ?>
        </div>
        <?php $image_count++; ?>
      <?php } ?>
      <?php foreach( $images as $image ) { ?>
        <div class="item clone">
          <?php echo wp_get_attachment_image($image['ID'], 'medium', '', array('style'=> 'height:' . $image_height . 'px')); ?>
        </div>
      <?php } ?>
    </div>
  </div>
</section>

<style>
  #marquee<?php echo $unique_id; ?> {
    animation: scroll<?php echo $unique_id; ?> <?php echo $speed; ?>ms linear infinite;
  }

  @keyframes scroll<?php echo $unique_id; ?> {
    0% {
      transform: translateX(0px);
    }
    100% {
      transform: translateX(-50%);
    }
  }
</style>
