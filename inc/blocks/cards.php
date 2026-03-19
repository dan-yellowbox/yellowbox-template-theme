<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';
  
  $heading = get_sub_field('heading');
  $subheading = get_sub_field('subheading');
  $cards = get_sub_field('cards');
  $button = get_sub_field('button');

  $settings_id = get_sub_field('block_settings_id');
  $settings_heading_layout =  get_sub_field('block_settings_heading_layout');
  $settings_card_style =  get_sub_field('block_settings_card_style');

  if( ! block_settings_carousel_desktop() && ! block_settings_carousel_mobile() ) {
    $carousel_state = 'unslick';
  } elseif( ! block_settings_carousel_desktop() ) {
    $carousel_state = 'unslick-desktop';
  } elseif( ! block_settings_carousel_mobile() ) {
    $carousel_state = 'unslick-mobile';
  } else {
    $carousel_state = '';
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
    text-<?php echo block_design_background_colour(); ?>
    overflow-hidden"
    >

  <?php if( $heading || $subheading || $button ) { ?>
    <div class="container block-heading mb-4">
      <?php if( $settings_heading_layout == 'inline' ) { ?>
        <div class="row justify-content-between align-items-end">
          <div class="col-lg-8 col-xl-6">
            <?php echo ( $heading ? '<h3 class="display-6">' . $heading . '</h3>' : '' ); ?>
            <?php echo ( $subheading ? '<p class="mt-n2">' . $subheading . '</p>' : '' ); ?>
          </div>
          <div class="col-lg-auto d-flex mt-3 mt-lg-0">
            <div class="controls"></div>
            <?php if( $button ) { ?>
              <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="btn btn-<?php echo block_design_background_colour(); ?> bg-opacity-100"><?php echo $button['title']; ?></a>
            <?php } ?>
          </div>
        </div>
      <?php } elseif ( $settings_heading_layout == 'stacked' )  { ?>
        <div class="row justify-content-center align-items-center flex-column text-center">
          <div class="col-lg-9 col-xl-6">
            <?php echo ( $heading ? '<h3 class="display-6">' . $heading . '</h3>' : '' ); ?>
            <?php echo ( $subheading ? '<p class="mt-n2">' . $subheading . '</p>' : '' ); ?>
          </div>
          <div class="col-lg-auto mt-3">
            <div class="controls justify-content-center">
              <?php if( $button ) { ?>
                <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="btn btn-<?php echo block_design_background_colour(); ?> bg-opacity-100"><?php echo $button['title']; ?></a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

  <div class="carousel-container position-relative">
    <div class="container">
      <div class="cards-carousel row gy-3" data-unslick="<?php echo $carousel_state; ?>">
        <?php if( $settings_card_style == 'style_one' ) { ?>
          <?php foreach ($cards as $card) { ?>
            <div class="col-md-6 col-lg-4">
              <div class="card border-0 opacity-75-hover">
                <?php echo ( $card['image'] ? '<div class="ratio ratio-4x3">' . wp_get_attachment_image($card['image']['ID'], 'large', '', array('class' => 'card-img-top object-fit-cover')) . '</div>' : '' ); ?>
                <div class="card-body">
                  <?php echo ( $card['heading'] ? '<h4>' . $card['heading'] . '</h4>' : '' ); ?>
                  <?php echo ( $card['content'] ? '<p class="mt-n2 small opacity-75">' . $card['content'] . '</p>' : '' ); ?>
                  <?php echo ( $card['link'] ? '<a href="' . $card['link']['url'] . '" class="btn btn-primary-dark btn-sm mt-2 stretched-link">' . $card['link']['title'] . '</a>' : '' ); ?>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } elseif( $settings_card_style == 'style_two' ) { ?>
          <?php foreach ($cards as $card) { ?>
            <div class="col-md-6 col-lg-4">
              <div class="card bg-transparent border-0 opacity-75-hover">
                <?php echo ( $card['image'] ? '<div class="ratio ratio-4x3 rounded-2 overflow-hidden">' . wp_get_attachment_image($card['image']['ID'], 'large', '', array('class' => 'card-img object-fit-cover')) . '</div>' : '' ); ?>
                <div class="card-body px-0 pb-0 text-<?php echo block_design_background_colour(); ?>">
                  <?php echo ( $card['heading'] ? '<h4>' . $card['heading'] . '</h4>' : '' ); ?>
                  <?php echo ( $card['content'] ? '<p class="mt-n2 small opacity-75">' . $card['content'] . '</p>' : '' ); ?>
                  <?php echo ( $card['link'] ? '<a href="' . $card['link']['url'] . '" class="btn btn-' . block_design_background_colour() . ' bg-opacity-100 btn-sm mt-2 stretched-link">' . $card['link']['title'] . '</a>' : '' ); ?>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } elseif( $settings_card_style == 'style_three' ) { ?>
          <?php foreach ($cards as $card) { ?>
            <div class="col-md-6 col-lg-4">
              <div class="card border-0 p-3 opacity-75-hover">
                <?php echo ( $card['image'] ? '<div class="ratio ratio-1x1 mb-3 rounded overflow-hidden" style="width: 80px">' . wp_get_attachment_image($card['image']['ID'], 'large', '', array('class' => 'object-fit-cover')) . '</div>' : '' ); ?>
                <div class="card-body p-0">
                  <?php echo ( $card['heading'] ? '<h4>' . $card['heading'] . '</h4>' : '' ); ?>
                  <?php echo ( $card['content'] ? '<p class="mt-n2 small opacity-75">' . $card['content'] . '</p>' : '' ); ?>
                  <?php echo ( $card['link'] ? '<a href="' . $card['link']['url'] . '" class="btn btn-primary-dark btn-sm mt-2 stretched-link">' . $card['link']['title'] . '</a>' : '' ); ?>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } elseif( $settings_card_style == 'style_four' ) { ?>
          <?php foreach ($cards as $card) { ?>
            <div class="col-md-6 col-lg-4">
              <div class="card ratio ratio-4x3 border-0 position-relative rounded overflow-hidden opacity-75-hover">
                <?php if( $card['link'] ) { echo '<a href="' . $card['link']['url'] . '">'; } ?>
                  <div class="background-overlay-gradient"></div>
                  <?php echo ( $card['image'] ? wp_get_attachment_image($card['image']['ID'], 'large', '', array('class' => 'background-image')) : '' ); ?>
                <?php if( $card['link'] ) { echo '</a>'; } ?>
                <div class="card-body position-relative z-3 justify-content-end">
                  <?php echo ( $card['heading'] ? '<h4 class="text-white">' . $card['heading'] . '</h4>' : '' ); ?>
                  <?php echo ( $card['content'] ? '<p class="text-white mt-n2 small opacity-75">' . $card['content'] . '</p>' : '' ); ?>
                  <?php echo ( $card['link'] ? '<a href="' . $card['link']['url'] . '" class="btn btn-light btn-sm mt-2 stretched-link">' . $card['link']['title'] . '</a>' : '' ); ?>
                </div>
              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>

</section>
