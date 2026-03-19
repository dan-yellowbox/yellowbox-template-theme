<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';

  $content = get_sub_field('content');

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
    text-<?php echo block_design_background_colour(); ?>
    overflow-hidden">
  <div class="container">
    <div class="row <?php echo block_design_content_alignment(); ?>">
      <div class="<?php echo block_design_content_width(); ?>">
        <div class="block-content">
          <?php echo $content; ?>
        </div>
      </div>
    </div>
  </div>
</section>
