<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';

  $heading = get_sub_field('heading');
  $subheading = get_sub_field('subheading');
  $settings_id = get_sub_field('block_id');

  $the_query = new WP_Query( array(
    'post_type' => 'reviews',
    'posts_per_page' => 6,
  ));
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
    overflow-hidden">
  <?php if( $heading || $subheading ) { ?>
    <div class="container block-heading mb-5">
      <div class="row justify-content-center text-center">
        <div class="col-lg-7">
          <?php echo ( $heading ? '<h3 class="display-6">' . $heading . '</h3>' : '' ); ?>
          <?php echo ( $subheading ? '<p class="mt-n2">' . $subheading . '</p>' : '' ); ?>
        </div>
      </div>
      <div class="row justify-content-center text-center">
        <div class="col-lg-auto">
          <div class="controls"></div>
        </div>
      </div>
    </div>
  <?php } ?>
  <div class="carousel-container position-relative">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="cards-carousel mx-n3">
            <?php if ( $the_query->have_posts() ) { ?>
              <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="px-3">
                  <div class="card bg-white">
                    <div class="card-body">
                      <div class="review-rating mb-2" data-rating="<?php echo get_field('rating'); ?>"><span></span><span></span><span></span><span></span><span></span></div>
                      <?php if( get_field('author') ) { echo '<p class="small fw-bold">' . get_field('author') . '</p>'; } ?>
                      <?php if( get_field('review')  ) { echo '<p class="review-content">' . get_field('review')  . '</p>'; } ?>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php wp_reset_postdata(); ?>