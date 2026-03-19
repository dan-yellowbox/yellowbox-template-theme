<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yellowbox
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php
			echo '<section class="py-5 py-lg-6">';
				echo '<div class="container">';
					echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">';
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content-category', get_post_type() );
						endwhile;
					echo '</div>';
				echo '</div>';

				echo theme_post_pagination();
			echo '</section>';
		?>

		<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
