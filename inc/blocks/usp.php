<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';
  
  $items = get_sub_field('items');

  $settings_id = get_sub_field('block_settings_id');
  $settings_block_layout =  get_sub_field('block_settings_block_layout');
  $settings_columns =  get_sub_field('block_settings_columns');

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
    overflow-hidden"
    >

    <?php if( $settings_block_layout != 'inline' ) { ?>
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="usp-carousel text-center <?php if( $settings_block_layout == 'stacked' ) { echo 'text-lg-start'; } ?>" data-slick='{"slidesToShow": <?php echo $settings_columns; ?>}'>
              <?php foreach( $items as $item ) { ?>
                <div>
                  <?php if( $item['image'] ) { echo wp_get_attachment_image($item['image']['ID'], 'medium', '', array('class'=>'d-inline-block mb-2', 'style'=>'height: 32px; width: auto;')); } ?>
                  <?php if( $item['heading'] ) { echo '<p class="fw-bold">' . $item['heading'] . '</p>'; } ?>
                  <?php if( $item['content'] ) { echo '<p class="mt-n3 small opacity-75">' . $item['content'] . '</p>'; } ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="usp-carousel" data-slick='{"slidesToShow": <?php echo $settings_columns; ?>}'>
              <?php foreach( $items as $item ) { ?>
                <div class="d-flex align-items-center">
                  <?php if( $item['image'] ) { echo wp_get_attachment_image($item['image']['ID'], 'medium', '', array('class'=>'d-inline-block me-2', 'style'=>'height: 32px; width: auto;')); } ?>
                  <div>
                    <?php if( $item['heading'] ) { echo '<p class="fw-bold">' . $item['heading'] . '</p>'; } ?>
                    <?php if( $item['content'] ) { echo '<p class="mt-n3 small opacity-75">' . $item['content'] . '</p>'; } ?>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

</section>
