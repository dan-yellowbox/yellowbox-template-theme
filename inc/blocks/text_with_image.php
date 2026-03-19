<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';

  $content = get_sub_field('content');
  $image = get_sub_field('image');

  $settings_id = get_sub_field('block_settings_id');
  $block_layout = get_sub_field('block_settings_layout');
  $settings_image_position = get_sub_field('block_settings_image_position');
  $settings_image_size = get_sub_field('block_settings_image_size');
  $box_background = block_design_background_colour();

  if( $block_layout == 'boxed' ) {
    $section_background = '';
  } else {
    $section_background = block_design_background_colour();
  }
?>

<section
  id="<?php echo $settings_id; ?>"
  class="
    block-<?php echo get_row_layout(); ?>
    <?php echo block_design_gap_top(); ?>
    <?php echo block_design_gap_bottom(); ?>
    <?php echo block_design_padding_top(); ?>
    <?php echo block_design_padding_bottom(); ?>
    text-<?php echo $section_background; ?>
    <?php echo $block_layout; ?>
    image-<?php echo $settings_image_position; ?>
    image-<?php echo $settings_image_size; ?>
    overflow-hidden
  ">

  <?php if( $block_layout == 'standard' ) { ?>
    <div class="container">
      <div class="row gx-lg-6 align-items-center justify-content-between">
        <div class="col-lg-6 col-xl-5">
          <div>
            <?php echo $content; ?>
          </div>
        </div>
        <div class="col-lg-<?php echo ( $settings_image_size == 'large' ? '6' : '5' ); ?> mt-4 mt-lg-0 image">
          <div class="ratio ratio-1x1">
            <?php echo wp_get_attachment_image($image['ID'], 'large', '', array('class'=>'background-image rounded-3')); ?>
          </div>
        </div>
      </div>
    </div>
  <?php } elseif( $block_layout == 'stretched' ) { ?>
    <div class="container">
      <div class="row gx-lg-6 align-items-stretch">
        <div class="col-lg-<?php echo ( $settings_image_size == 'large' ? '6' : '6 offset-lg-1' ); ?> d-flex align-items-center py-lg-6">
          <div>
            <?php echo $content; ?>
          </div>
        </div>
        <div class="col-lg-<?php echo ( $settings_image_size == 'large' ? '6' : '4' ); ?> mt-4 mt-lg-0 image">
          <div class="ratio ratio-1x1">
              <?php echo wp_get_attachment_image($image['ID'], 'large', '', array('class'=>'background-image rounded-3')); ?>
          </div>
        </div>
      </div>
    </div>
  <?php } elseif( $block_layout == 'boxed' ) { ?>
    <div class="container">
      <div class="row align-items-stretch gx-lg-0 rounded-3 overflow-hidden">
        <div class="col-lg-<?php echo ( $settings_image_size == 'large' ? '6' : '7' ); ?>">
          <div class=" d-flex align-items-center text-<?php echo $box_background; ?> h-100 p-4 p-md-5 p-lg-6">
            <div>
              <?php echo $content; ?>
            </div>
          </div>
        </div>
        <div class="col-lg-<?php echo ( $settings_image_size == 'large' ? '6' : '5' ); ?> image">
          <div class="ratio ratio-1x1 h-100">
            <?php echo wp_get_attachment_image($image['ID'], 'large', '', array('class'=>'background-image')); ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</section>
