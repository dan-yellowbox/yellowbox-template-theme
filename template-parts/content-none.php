<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yellowbox
 */

?>

<section class="no-results not-found py-5 py-lg-6">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<h1 class="display-4">Sorry, this page can't be found</h1>
				<p>It looks like nothing was found at this location. Please return to the home page.</p>

				<a href="<?php echo get_site_url(); ?>" class="btn btn-primary mt-4">Back Home</a>
			</div>
		</div>
	</div>
</section><!-- .no-results -->
