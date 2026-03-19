<?php 
	$setting_width = ( get_field('navigation_width', 'options') ?? 'standard' );
	$setting_position = ( get_field('navigation_position', 'options') ?? 'standard' );
	$setting_scroll_state = ( get_field('navigation_scroll_state', 'options') ?? 'fixed_on_scroll' );

	$phone_number = ( get_field('header_phone_number', 'options') ?? NULL );
	$email_address = ( get_field('header_email_address', 'options') ?? NULL );

	$width = ( $setting_width == 'contained' ? 'container' : 'container-fluid' );
	$logo_width_desktop = ( get_field('logo_width_desktop', 'options') ?? '200' );
	$logo_width_mobile = ( get_field('logo_width_mobile', 'options') ?? '150' );

	switch($setting_scroll_state) {
		case "standard" :
			$scroll_state = '';
			break;
		case "fixed" :
			$scroll_state = 'navbar-fixed';
			break;
		case "fixed_on_scroll" :
			$scroll_state = 'navbar-fixed scrollable';
			break;
		default:
			$scroll_state = 'navbar-fixed scrollable';
			break;
	}

	switch($setting_position) {
		case "transparent" :
			$header_style = 'floating-header';
			$navbar_style = 'navbar-dark';
			break;
		default:
			$header_style = '';
			$navbar_style = 'bg-white navbar-light';
			break;
	}
?>

	<?php if ( $site_notice = get_field('site_notice', 'options') ) : ?>
		<section class="section top-bar bg-primary-light py-2 small">
			<div class="<?php echo $width; ?>">
				<div class="row">
					<div class="col text-center">
						<p><?php echo $site_notice; ?></p>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<header id="masthead" class="site-header layout-two <?php echo $header_style; ?>">
		<nav class="navbar navbar-expand-lg <?php echo $navbar_style; ?> <?php echo $scroll_state; ?>">
		  <div class="<?php echo $width; ?>">

			<button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
				<span class="navbar-toggler-icon"></span>
			</button>

		    <a class="navbar-brand mx-auto mx-lg-0" href="<?php echo get_site_url(); ?>">
					<?php
	          $custom_logo_id = get_theme_mod( 'custom_logo' );
	          $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	          if ( has_custom_logo() ) {
	            echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="d-none d-lg-block" style="width: ' . $logo_width_desktop . 'px" />';
	            echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" class="d-block d-lg-none" style="width: ' . $logo_width_mobile . 'px" />';
	          } else {
	            echo '<span class="h4">'. get_bloginfo( 'name' ) .'</span>';
	          }
	        ?>
				</a>

			<?php if( get_field('header_call_to_action', 'options') || get_field('header_phone_number', 'options') ) { ?>
				<ul class="navbar-nav header-buttons order-lg-2 d-none d-lg-flex gap-2 ms-2 justify-content-end">
					<?php if( $phone_number = get_field('header_phone_number', 'options') ) { ?>
						<li class="nav-item">
							<a href="tel:<?php echo $phone_number; ?>" class="btn btn-text">
								<?php echo $phone_number; ?>
							</a>
						</li>
					<?php } ?>
					<?php if( $call_to_action = get_field('header_call_to_action', 'options') ) { ?>
						<li class="nav-item">
							<a href="<?php echo $call_to_action['url']; ?>" target="<?php echo $call_to_action['target']; ?>" class="btn btn-primary">
								<?php echo $call_to_action['title']; ?>
							</a>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>

			<?php if( $phone_number ) { ?>
				<ul class="navbar-nav header-buttons order-lg-2 d-lg-none gap-2 ms-2 justify-content-end">
					<li class="nav-item">
						<a href="tel:<?php echo $phone_number; ?>" class="btn nav-link nav-button">
							<i class="fa-solid fa-phone"></i>
						</a>
					</li>
				</ul>
			<?php } ?>
		  </div>
		  		    <div class="collapse navbar-collapse w-100" id="navigationDesktop">
		      <ul class="navbar-nav mx-auto align-items-center text-center">
		        <?php bootstrap_navigation(); ?>
		      </ul>
		    </div>
			<?php do_action('yellowbox_navigation_end'); ?>
		</nav>
	</header><!-- #masthead -->