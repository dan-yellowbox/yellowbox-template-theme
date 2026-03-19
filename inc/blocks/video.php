<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';

  $heading = get_sub_field('heading');
  $subheading = get_sub_field('subheading');
  $video = get_sub_field('video_url');
  $cover = get_sub_field('video_cover');
  $modal_id = rand();

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
  <?php if( $heading || $subheading ) { ?>
    <div class="row justify-content-center align-items-center flex-column text-center mb-5">
      <div class="col-lg-9 col-xl-6">
        <?php echo ( $heading ? '<h3 class="display-6">' . $heading . '</h3>' : '' ); ?>
        <?php echo ( $subheading ? '<p class="mt-n2">' . $subheading . '</p>' : '' ); ?>
      </div>
    </div>
  <?php } ?>
  <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col position-relative">
        <a href="" class="video ratio ratio-16x9" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="<?php echo $video; ?>">
          <span class="h3 video-button play"><i class="fa-solid fa-play"></i></span>
          <?php echo wp_get_attachment_image($cover['ID'], 'large', '', array('class'=>'background-image rounded-3')); ?>
        </a>
      </div>
    </div>
  </div>
</section>
