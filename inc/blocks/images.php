<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';
  
  $images = get_sub_field('images');

  $settings_id = get_sub_field('block_settings_id');
  $settings_block_layout = get_sub_field('block_settings_block_layout');
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
  <?php if( $settings_block_layout == 'standard' ) { ?>
    <div class="container">
      <div class="row g-3 g-lg-4">
        <?php foreach ($images as $image) { ?>
          <?php 
            $size_select = ( get_post_meta($image['ID'], '_image_size_select') ? get_post_meta($image['ID'], '_image_size_select')[0] : '' );
            if( $size_select == 'half' ) {
              $size = '-6';
            } elseif( $size_select == 'third' ) {
              $size = '-4';
            } elseif( $size_select == 'quater' ) {
              $size = '-3';
            } else {
              $size = '-12';
            }
          ?>
          <div class="col<?php echo $size; ?>">
            <?php echo wp_get_attachment_image($image['id'], 'large', '', array('class' => 'w-100 rounded-3')); ?>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } else { ?>
  <div class="container-fluid p-0">
    <div class="row gx-0">
      <?php foreach ($images as $image) { ?>
        <?php 
          $size_select = ( get_post_meta($image['ID'], '_image_size_select') ? get_post_meta($image['ID'], '_image_size_select')[0] : '' );
          if( $size_select == 'half' ) {
            $size = '-6';
          } elseif( $size_select == 'third' ) {
            $size = '-4';
          } elseif( $size_select == 'quater' ) {
            $size = '-3';
          } else {
            $size = '-12';
          }
        ?>
        <div class="col<?php echo $size; ?>">
          <?php echo wp_get_attachment_image($image['id'], 'large', '', array('class' => 'w-100')); ?>
        </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
</section>
