<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package yellowbox
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="no-results not-found py-7">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<h1 class="display-4">Sorry, this page can't be found</h1>
						<p>It looks like nothing was found at this location. Please return to the home page.</p>

						<a href="<?php echo get_site_url(); ?>" class="btn btn-primary mt-4">Back Home</a>
					</div>
				</div>
			</div>
		</section><!-- .no-results -->

	</main><!-- #main -->

<?php
get_footer();
