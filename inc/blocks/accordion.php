<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';

  $heading = get_sub_field('heading');
  $subheading = get_sub_field('subheading');
  $button = get_sub_field('button');
  $accordion = get_sub_field('accordion');
  $accordionBlockID = rand();
  $count = 1;

  $settings_id = get_sub_field('block_settings_id');
  $settings_heading_layout =  get_sub_field('block_settings_heading_layout');
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

  <?php if ( $settings_heading_layout == 'stacked' ) { ?>
    <?php if( $heading || $subheading ) { ?>
      <div class="container block-heading mb-5">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-xl-6 text-center">
            <?php if ( $heading ) { echo '<h2 class="h1">' . $heading . '</h2>'; } ?>
            <?php if ( $subheading ) { echo '<p class="mt-n2">' . $subheading . '</p>'; } ?>
          </div>
        </div>
      </div>
    <?php } ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
          <div class="accordion" id="accordionBlock<?php echo $accordionBlockID; ?>">
            <?php foreach ($accordion as $panel) { ?>
                <div class="accordion-item <?php echo ( $count == 1 ? '' : 'mt-3' ); ?>">
                  <h2 class="accordion-header" id="heading<?php echo $count; ?><?php echo $accordionBlockID; ?>">
                    <button class="accordion-button <?php echo ( $count == 0 ? '' : 'collapsed' ); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $count; ?><?php echo $accordionBlockID; ?>" aria-expanded="<?php echo ( $count == 0 ? 'true' : 'false' ); ?>" aria-controls="collapse<?php echo $count; ?><?php echo $accordionBlockID; ?>">
                      <?php echo $panel['heading']; ?>
                    </button>
                  </h2>
                  <div id="collapse<?php echo $count; ?><?php echo $accordionBlockID; ?>" class="accordion-collapse collapse <?php echo ( $count == 0 ? 'show' : '' ); ?>" aria-labelledby="heading<?php echo $count; ?><?php echo $accordionBlockID; ?>" data-bs-parent="#accordionBlock<?php echo $accordionBlockID; ?>">
                    <div class="accordion-body">
                      <div class="content">
                        <?php echo $panel['content']; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php $count++; ?>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php if ( $button ) { ?>
        <div class="container mt-5">
          <div class="row justify-content-center">
            <div class="col text-center">
              <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="btn btn-<?php echo block_design_background_colour(); ?> bg-opacity-100"><?php echo $button['title']; ?></a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } else { ?>
    <div class="container">
      <div class="row justify-content-center justify-content-xl-between">
        <?php if( $heading || $subheading ) { ?>
          <div class="col-lg-8 col-xl-5">
            <?php if ( $heading ) { echo '<h2 class="h1">' . $heading . '</h2>'; } ?>
            <?php if ( $subheading ) { echo '<p class="mt-n2">' . $subheading . '</p>'; } ?>
            <?php if( $button ) { ?>
              <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="btn btn-<?php echo block_design_background_colour(); ?> bg-opacity-100 mt-4"><?php echo $button['title']; ?></a>
            <?php } ?>
          </div>
        <?php } ?>
        <div class="col-xl-6 mt-5 mt-xl-0">
          <div class="accordion" id="accordionBlock<?php echo $accordionBlockID; ?>">
            <?php foreach ($accordion as $panel) { ?>
                <div class="accordion-item <?php echo ( $count == 1 ? '' : 'mt-3' ); ?>">
                  <h2 class="accordion-header" id="heading<?php echo $count; ?><?php echo $accordionBlockID; ?>">
                    <button class="accordion-button <?php echo ( $count == 0 ? '' : 'collapsed' ); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $count; ?><?php echo $accordionBlockID; ?>" aria-expanded="<?php echo ( $count == 0 ? 'true' : 'false' ); ?>" aria-controls="collapse<?php echo $count; ?><?php echo $accordionBlockID; ?>">
                      <?php echo $panel['heading']; ?>
                    </button>
                  </h2>
                  <div id="collapse<?php echo $count; ?><?php echo $accordionBlockID; ?>" class="accordion-collapse collapse <?php echo ( $count == 0 ? 'show' : '' ); ?>" aria-labelledby="heading<?php echo $count; ?><?php echo $accordionBlockID; ?>" data-bs-parent="#accordionBlock<?php echo $accordionBlockID; ?>">
                    <div class="accordion-body">
                      <div class="content">
                        <?php echo $panel['content']; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php $count++; ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</section>
