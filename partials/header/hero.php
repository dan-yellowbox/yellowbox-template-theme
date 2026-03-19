<?php
  $heading = get_field('header_heading');
  $subheading = get_field('header_subheading');
  $button = get_field('header_button');
  $button_two = get_field('header_button_two');
  $content_alignment = get_field('header_content_alignment');
  $check_list = get_field('header_use_checklist');
  $background_type = get_field('header_background_type');
  $image = get_field('header_image');
  $video = get_field('header_video');
  $cover = get_field('header_video_cover');
  $form_heading = get_field('header_form_heading');
  $form_subheading = get_field('header_form_subheading');
  $form_shortcode = get_field('header_form_shortcode');
  $background_image = get_field('header_background_image');
  $background_video = get_field('header_background_video');
  $background_cover = get_field('header_background_cover');
  $background_colour = get_field('header_background_colour');
  $asset_type = get_field('header_asset_type');

  if( $background_type == 'colour' ) {
  	switch ($background_colour) {
      case 'white':
          $bg_colour = 'bg-white';
          break;
      case 'primary':
          $bg_colour = 'bg-primary';
          break;
      case 'light':
          $bg_colour = 'bg-primary-light';
          break;
      case 'dark':
          $bg_colour = 'bg-dark';
          break;
      case 'light_grey':
          $bg_colour = 'bg-light';
          break;
      default:
          $bg_colour = '';
          break;
  	}
  } elseif( $background_type == 'video' || $background_type == 'image' ) {
    $bg_colour = 'bg-dark';
  } else {
    $bg_colour = '';
  }

	$alignment = ($asset_type === 'none' && $content_alignment === 'center') ? 'justify-content-center text-center' : $alignment ?? 'justify-content-between';
	$button_alignment = ($asset_type === 'none' && $content_alignment === 'center') ? 'justify-content-center' : $button_alignment ?? '';
	$content_size = ($asset_type != 'none' || $content_alignment === 'left') ? 'col-lg-7 col-xl-6' : $content_size ?? 'col-lg-7';

  $default_heading = get_the_title();
  $default_background = ( has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'background-image' ) ) : '<img src="' . get_template_directory_uri() . '/assets/images/post-placeholder.svg" class="background-image" />' );
?>

<section class="page-header position-relative text-<?php echo $bg_colour; ?> hero <?php if( $asset_type != 'none' ) { echo 'has-asset'; } ?>">
	<?php if( $background_type == 'image' ) { ?>
	  <div class="background-overlay"></div>
	  <?php echo ( $background_image ? wp_get_attachment_image($background_image['ID'], 'full', '', array('class'=>'background-image')) : $default_background ); ?>
	<?php } elseif( $background_type == 'video' ) { ?>
	  <div class="background-overlay"></div>
	  <video width="1280" height="720" muted autoplay playsinline loop class="background-video" <?php echo ( $background_cover ? 'poster="' . $background_cover . '"' : '' ); ?>>
	    <source src="<?php echo $background_video; ?>" type="video/mp4">
	  </video>
	<?php } ?>
	<div class="hero-container">
	  <div class="container py-6">
	    <div class="row align-items-center <?php echo $alignment; ?>">
	      <div class="<?php echo $content_size; ?>">
	        <div class="content mx-auto">
	          <h1 class="display-4"><?php echo ( $heading ? $heading : get_the_title() ); ?></h1>
            <?php if( $check_list ) { ?>
              <?php
              $listItems = preg_replace('/^(.+)$/m', '<li>$1</li>', trim($subheading));
              echo '<ul class="list-checklist pt-3">';
                echo $listItems;
              echo '</ul>';
              ?>
             <?php } else { ?>
               <?php echo ( $subheading ? '<p class="mt-n2 opacity-75">' . $subheading . '</p>' : '' ); ?>
             <?php } ?>
	          <?php if( $button || $button_two ) { ?>
	            <div class="d-flex gap-3 <?php echo $button_alignment; ?> mt-5">
	              <?php echo ( $button ? '<a href="' . $button['url'] . '" target="' . $button['target'] . '" class="btn btn-' . $bg_colour . ' bg-opacity-100">' . $button['title'] . '</a>' : '' ); ?>
	              <?php echo ( $button_two ? '<a href="' . $button_two['url'] . '" target="' . $button_two['target'] . '" class="btn btn-' . $bg_colour . ' bg-opacity-75">' . $button_two['title'] . '</a>' : '' ); ?>
	            </div>
	          <?php } ?>
	        </div>
	     	</div>
        <?php if( $asset_type != 'none' ) { ?>
          <div class="col-lg-5 mt-5 mt-lg-0 position-relative z-3">
          	<?php if ($asset_type == 'image') { ?>
	            <div class="image-container ratio ratio-1x1">
	              <?php echo ( $image ? wp_get_attachment_image($image['ID'], 'large', '', array('class'=>'background-image rounded')) : $default_background ); ?>
	            </div>
          	<?php } elseif ($asset_type == 'video') { ?>
			        <a href="" class="video ratio ratio-1x1" data-bs-toggle="modal" data-bs-target="#videoModal" data-video="<?php echo $video; ?>">
			          <span class="h3 video-button play"><i class="fa-solid fa-play"></i></span>
			          <?php echo wp_get_attachment_image($cover['ID'], 'large', '', array('class'=>'background-image rounded-3')); ?>
			        </a>
          	<?php } elseif( $asset_type == 'form' ) { ?>
          		<div class="form-container text-bg-white rounded-3 p-4 p-md-5 p-lg-4 p-xl-5">
          			<?php if ( $form_heading ) { echo '<h2>' . $form_heading . '</h2>'; } ?>
          			<?php if ( $form_subheading ) { echo '<p class="mt-n2">' . $form_subheading . '</p>'; } ?>
          			<?php if( $form_shortcode ) { echo do_shortcode($form_shortcode) ; } ?>
          		</div>
          	<?php } ?>
          </div>
        <?php } ?>
	    </div>
	  </div>
	</div>
</section>
