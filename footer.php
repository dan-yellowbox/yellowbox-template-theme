<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yellowbox
 */
  $logo_width_desktop = get_field('footer_logo_width_desktop', 'options');
  $logo_width_mobile = get_field('footer_logo_width_mobile', 'options');

?>

	<footer id="colophon" class="site-footer footer-dark bg-dark">
		<?php if( get_field('logo', 'options') ) { ?>
			<section class="footer-top pt-5">
				<div class="container">
					<div class="row align-items-center">
						<?php if( get_field('logo', 'options') ) { ?>
						<div class="col-md footer-logo">
							<?php echo ( get_field('logo', 'options') ? wp_get_attachment_image(get_field('logo', 'options')['ID'], 'full', '', array('class'=>'d-none d-lg-block h-auto', 'style'=>'width: ' . $logo_width_desktop . 'px')) : '' ); ?>
              <?php echo ( get_field('logo', 'options') ? wp_get_attachment_image(get_field('logo', 'options')['ID'], 'full', '', array('class'=>'d-block d-lg-none h-auto', 'style'=>'width: ' . $logo_width_mobile . 'px')) : '' ); ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</section>
		<?php } ?>
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
			<section class="footer pt-6">
				<div class="container">
					<div class="row gx-lg-8">
						<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
							<div class="col-lg-3">
								<div id="footer1" class="widget-area" role="complementary">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
							<div class="col-lg-3">
								<div id="footer2" class="widget-area" role="complementary">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
							<div class="col-lg-3">
								<div id="footer3" class="widget-area" role="complementary">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
							<div class="col-lg-3">
								<div id="footer4" class="widget-area" role="complementary">
									<?php dynamic_sidebar( 'footer-4' ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
		<section class="footer-bottom pb-4 pt-6 small">
			<div class="container">
        <?php if ( is_active_sidebar( 'footer-bottom' ) ): ?>
        <div class="row">
          <div class="col">
            <div id="footer-bottom" class="widget-area" role="complementary">
              <?php dynamic_sidebar( 'footer-bottom' ); ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
				<div class="row">
					<div class="col">
						Copyright &copy; <?php echo date('Y'); ?>. All rights reserved. Website by <a href="https://www.yellowboxmarketing.co.uk/" target="_blank">Yellowbox</a>.
					</div>
				</div>
			</div>
		</section>
	</footer><!-- #colophon -->
</div><!-- #page -->

<!-- Mobile Menu -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
	<div class="offcanvas-header bg-light">
		<h5 class="offcanvas-title" id="offcanvasMenuLabel">Menu</h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body px-0">
		<ul id="navigationMobile" class="navbar-nav navbar-mobile mx-auto w-100">
			<?php mobile_navigation(); ?>
		</ul>
	</div>

	<?php if( get_field('header_call_to_action', 'options') || get_field('header_phone_number', 'options') || get_field('header_email_address', 'options') ) { ?>
		<ul class="navbar-nav gap-2 p-2">
			<?php if( $header_call_to_action = get_field('header_call_to_action', 'options') ) { ?>
				<li class="nav-item">
					<a href="<?php echo $header_call_to_action['url']; ?>" target="<?php echo $header_call_to_action['target']; ?>" class="btn w-100 btn-primary">
						<?php echo $header_call_to_action['title']; ?>
					</a>
				</li>
			<?php } ?>
			<?php if( $header_phone_number = get_field('header_phone_number', 'options') ) { ?>
				<li class="nav-item">
					<a href="tel:<?php echo $header_phone_number; ?>" class="btn w-100 btn-outline-primary">
						<?php echo $header_phone_number; ?>
					</a>
				</li>
			<?php } ?>
			<?php if( $header_email_address = get_field('header_email_address', 'options') ) { ?>
				<li class="nav-item">
					<a href="mailto:<?php echo $header_email_address; ?>" class="btn w-100 btn-outline-primary">
						<?php echo $header_email_address; ?>
					</a>
				</li>
			<?php } ?>
		</ul>
	<?php } ?>
</div>

<!-- Video Modal -->
<div class="modal fade video-modal" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-transparent border-0 rounded-2 overflow-hidden">
      <div class="modal-body p-0">
        <div class="ratio ratio-16x9 bg-light video-loader">
        	<i class="fa-solid fa-loader fa-spin fs-5 text-primary"></i>
        </div>
        <div class="video ratio ratio-16x9 d-none">
          <span class="h3 video-button video-button close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-close"></i></span>
          <span class="h3 video-button play-pause"><i class="fa-solid fa-pause"></i></span>
          <span class="h3 video-button mute"><i class="fa-solid fa-volume"></i></span>
          <video width="1280" height="720" loop preload="none">
            <source src="" type="video/mp4">
          </video>
        </div>
      	<div class="video-seeker">
				  <span></span>
				</div>
      </div>
    </div>
  </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
