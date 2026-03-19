<?php
  $heading = get_field('header_heading');
  $subheading = get_field('header_subheading');
  $button = get_field('header_button');
  $button_two = get_field('header_button_two');
  $content_alignment = get_field('header_content_alignment');
  $background_type = get_field('header_background_type');
  $image = get_field('header_image');
  $video = get_field('header_video');
  $cover = get_field('header_video_cover');
  $background_image = get_field('header_background_image');
  $background_video = get_field('header_background_video');
  $background_cover = get_field('header_background_cover');
  $background_colour = get_field('header_background_colour');

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

	$alignment = ( $content_alignment === 'center') ? 'justify-content-center text-center' : $alignment ?? 'justify-content-between';
	$button_alignment = ( $content_alignment === 'center') ? 'justify-content-center' : $button_alignment ?? '';
	$content_size = ( $content_alignment === 'left') ? 'col-lg-7 col-xl-6' : $content_size ?? 'col-lg-7';

  $default_heading = get_the_title();
  $default_background = ( has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'background-image' ) ) : '<img src="' . get_template_directory_uri() . '/assets/images/post-placeholder.svg" class="background-image" />' );
?>

<section class="page-header position-relative text-<?php echo $bg_colour; ?>">
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
	  <div class="container pt-6 <?php if( $background_type != 'none' ) { echo 'pb-6'; } ?>">
	    <div class="row align-items-center <?php echo $alignment; ?>">
	      <div class="<?php echo $content_size; ?>">
	        <div class="content mx-auto">
	          <h1 class="display-4"><?php echo ( $heading ? $heading : get_the_title() ); ?></h1>
	          <?php echo ( $subheading ? '<p class="mt-n2 opacity-75">' . $subheading . '</p>' : '' ); ?>
	          <?php if( $button || $button_two ) { ?>
	            <div class="d-flex gap-3 <?php echo $button_alignment; ?> mt-5">
	              <?php echo ( $button ? '<a href="' . $button['url'] . '" target="' . $button['target'] . '" class="btn btn-primary">' . $button['title'] . '</a>' : '' ); ?>
	              <?php echo ( $button_two ? '<a href="' . $button_two['url'] . '" target="' . $button_two['target'] . '" class="btn bg-white text-white bg-opacity-50">' . $button_two['title'] . '</a>' : '' ); ?>
	            </div>
	          <?php } ?>
	        </div>
	     	</div>
	    </div>
	  </div>
	</div>
</section>
