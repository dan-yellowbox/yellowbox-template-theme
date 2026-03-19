<?php
/**
 * Template Name: Contact One
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yellowbox
 */

  $contact_number = get_field('contact_number');
  $email_address = get_field('email_address');
  $address = get_field('address');
  $form_shortcode = get_field('form_shortcode');
  $map_iframe = get_field('map_iframe');
  $social = get_field('social_profiles', 'options');
  $facebook = $social['facebook'] ?? '';
  $x_twitter = $social['x_twitter'] ?? '';
  $pinterest = $social['pinterest'] ?? '';
  $youtube = $social['youtube'] ?? '';
  $instagram = $social['instagram'] ?? '';
  $linkedin = $social['linkedin'] ?? '';

get_header();
?>

  <main id="primary" class="site-main">

    <section>
      <div class="container my-5 my-lg-6">
        <div class="row justify-content-between">
          <?php if( $form_shortcode ) { ?>
          <div class="col-lg-6">
            <?php echo do_shortcode($form_shortcode); ?>
          </div>
          <?php } ?>
          <div class="col-lg-4 mt-5 mt-lg-0">
            <div class="d-flex flex-column gap-2">
            <?php if( $contact_number ) { ?>
              <p class="opacity-75">Telephone</p>
              <p class="fs-5 mt-n3"><?php echo $contact_number; ?></p>
            <?php } ?>
            <?php if( $email_address ) { ?>
              <p class="opacity-75">Email address</p>
              <p class="fs-5 mt-n3"><?php echo $email_address; ?></p>
            <?php } ?> 
            <?php if( $address ) { ?>
              <p class="opacity-75">Address</p>
              <p class="fs-5 mt-n3"><?php echo $address; ?></p>
            <?php } ?> 
            <?php if( $social ) { ?>
              <p class="opacity-75">Follow us</p>
              <?php 
                echo '<div class="d-flex gap-2 social-icons flex-wrap mt-n3">';
                  echo ( $facebook ? '<a href="' . $facebook . '" target="_blank" class="text-decoration-none"><i class="fa-brands fa-facebook-f"></i></a>' : '' );
                  echo ( $linkedin ? '<a href="' . $linkedin . '" target="_blank" class="text-decoration-none"><i class="fa-brands fa-linkedin-in"></i></a>' : '' );
                  echo ( $youtube ? '<a href="' . $youtube . '" target="_blank" class="text-decoration-none"><i class="fa-brands fa-youtube"></i></a>' : '' );
                  echo ( $instagram ? '<a href="' . $instagram . '" target="_blank" class="text-decoration-none"><i class="fa-brands fa-instagram"></i></a>' : '' );
                  echo ( $x_twitter ? '<a href="' . $x_twitter . '" target="_blank" class="text-decoration-none"><i class="fa-brands fa-x-twitter"></i></a>' : '' );
                  echo ( $pinterest ? '<a href="' . $pinterest . '" target="_blank" class="text-decoration-none"><i class="fa-brands fa-pinterest"></i></a>' : '' );
                echo '</div>';
              ?>
            <?php } ?> 
          </div>
        </div>
      </div>
    </div>
    <?php if( $map_iframe ) { ?>
      <div class="container mb-5 mb-lg-6">
        <div class="row">
          <div class="col">
            <div class="ratio ratio-16x9">
              <?php echo $map_iframe; ?>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </section>

  </main><!-- #main -->

<?php
get_footer();
