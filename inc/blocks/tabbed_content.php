<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';
  
  $heading = get_sub_field('heading');
  $subheading = get_sub_field('subheading');
  $tabs = get_sub_field('tabbed_content');

  $tabBlockID = rand();
  $paneCount = 0;
  $tabCount = 0;

  if( block_design_background_colour() == 'bg-dark' || block_design_background_colour() == 'bg-primary-dark' ) {
    $tab_theme = 'data-bs-theme="dark"';
  } else {
    $tab_theme = '';
  }

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
    overflow-hidden
  ">
  <?php if( $heading || $subheading ) { ?>
	  <div class="container block-heading mb-5">
	    <div class="row justify-content-center">
	      <div class="col-lg-7 text-center">
	        <?php echo ( $heading ? '<h3 class="display-5">' . $heading . '</h3>' : '' ); ?>
	        <?php echo ( $subheading ? '<p class="mt-n2">' . $subheading . '</p>' : '' ); ?>
	      </div>
	    </div>
	  </div>
  <?php } ?>
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <ul class="nav nav-pills justify-content-lg-center" id="tabsBlock<?php echo $tabBlockID; ?>" <?php echo $tab_theme; ?> role="tablist" >
          <?php foreach( $tabs as $pane ) { ?>
            <li class="nav-item">
              <a class="nav-link <?php if( $paneCount == 0 ) echo 'active'; ?>" id="tab<?php echo $paneCount; ?>" data-bs-toggle="tab" data-bs-target="#tab-pane<?php echo $paneCount; ?>" type="button" role="tab" aria-controls="tab-pane<?php echo $paneCount; ?>" aria-selected="<?php echo ( $paneCount == 0 ? 'true' : 'false' ); ?>"><?php echo $pane['heading']; ?></a>
            </li>
            <?php $paneCount++; ?>
          <?php } ?>
        </ul>

        <div class="tab-content mt-5" id="tabsBlock<?php echo $tabBlockID; ?>Content">
          <?php foreach( $tabs as $tab ) { ?>
            <div class="tab-pane fade <?php if( $tabCount == 0 ) echo 'show active'; ?>" id="tab-pane<?php echo $tabCount; ?>" role="tabpanel" aria-labelledby="tab<?php echo $tabCount; ?>" tabindex="0">
              <div class="row align-items-center">
              	<div class="col-lg-5 mb-4 mb-lg-0">
                  <?php if( $tab['image'] ) { echo '<div class="ratio ratio-1x1">' . wp_get_attachment_image($tab['image']['id'], 'medium', '', array('class'=>'background-image')) . '</div>';  } ?>
                </div>
                <div class="col-lg-5 offset-lg-1">
                  <?php echo $tab['content']; ?>
                </div>
              </div>
            </div>
            <?php $tabCount++; ?>
          <?php } ?>
        </div>

      </div>
    </div>
  </div>
</section>
