<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';

  $heading = get_sub_field('heading');
  $subheading = get_sub_field('subheading');
  $button = get_sub_field('button');
  $button_two = get_sub_field('button_two');

  $settings_id = get_sub_field('block_settings_id');
  $block_layout = get_sub_field('block_settings_block_layout');
  $box_background = 'text-' . block_design_background_colour();
  $btn_style = 'btn-' . block_design_background_colour();

  if( $block_layout == 'boxed' ) {
    $section_background = '';
  } else {
    $section_background = 'text-' . block_design_background_colour();
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
    <?php echo $section_background; ?>
    overflow-hidden
  ">
    <?php if ($block_layout == 'inline') { ?>
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col-lg-7 col-xl-5">
            <?php if ( $heading ) { echo '<h2>' . $heading . '</h2>'; } ?>
            <?php if ( $subheading ) { echo '<p class="opacity-75 mt-n2">' . $subheading . '</p>'; } ?>
          </div>
          <div class="col-lg-auto text-lg-end">
            <div class="d-flex gap-3 mt-4 mt-lg-0">
              <?php if ( $button ) { echo '<a href="' . $button['url'] . '" target="' . $button['target'] . '" class="btn btn-' . block_design_background_colour() . ' bg-opacity-100">' . $button['title'] . '</a>'; } ?>
              <?php if ( $button_two ) { echo '<a href="' . $button_two['url'] . '" target="' . $button_two['target'] . '" class="btn btn-' . block_design_background_colour() . ' bg-opacity-75">' . $button_two['title'] . '</a>'; } ?>
            </div>
          </div>
        </div>
      </div>
    <?php } elseif ($block_layout == 'stacked') { ?>
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-8 col-xl-6">
            <?php if ( $heading ) { echo '<h2>' . $heading . '</h2>'; } ?>
            <?php if ( $subheading ) { echo '<p class="opacity-75 mt-n2">' . $subheading . '</p>'; } ?>
            <div class="d-flex gap-3 justify-content-center mt-4">
              <?php if ( $button ) { echo '<a href="' . $button['url'] . '" target="' . $button['target'] . '" class="btn btn-' . block_design_background_colour() . ' bg-opacity-100">' . $button['title'] . '</a>'; } ?>
              <?php if ( $button_two ) { echo '<a href="' . $button_two['url'] . '" target="' . $button_two['target'] . '" class="btn btn-' . block_design_background_colour() . ' bg-opacity-75">' . $button_two['title'] . '</a>'; } ?>
            </div>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="content <?php echo $box_background;?> p-4 p-lg-5 rounded">
              <div class="row justify-content-center text-center">
                <div class="col-lg-10 col-xl-6">
                  <div class="block-heading">
                    <?php if ( $heading ) { echo '<h2>' . $heading . '</h2>'; } ?>
                    <?php if ( $subheading ) { echo '<p class="opacity-75 mt-n2">' . $subheading . '</p>'; } ?>
                    <div class="d-flex gap-3 justify-content-center mt-4">
                      <?php if ( $button ) { echo '<a href="' . $button['url'] . '" target="' . $button['target'] . '" class="btn btn-' . block_design_background_colour() . ' bg-opacity-100">' . $button['title'] . '</a>'; } ?>
                      <?php if ( $button_two ) { echo '<a href="' . $button_two['url'] . '" target="' . $button_two['target'] . '" class="btn btn-' . block_design_background_colour() . ' bg-opacity-75">' . $button_two['title'] . '</a>'; } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
</section>
