<?php
/**
 * Template Name: Container
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yellowbox
 */

get_header();
?>

	<main id="primary" class="site-main">
  	<div class="container py-5">

  		<?php
  		while ( have_posts() ) :
  			the_post();

  			get_template_part( 'template-parts/content', 'page' );

  			// If comments are open or we have at least one comment, load up the comment template.
  			if ( comments_open() || get_comments_number() ) :
  				comments_template();
  			endif;

  		endwhile; // End of the loop.
  		?>

  	</div><!-- #container -->
	</main><!-- #main -->

<?php
get_footer();
