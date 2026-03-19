<?php
/**
 * Template part for displaying posts in category
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dbstarter-theme
 */

  $settings_card_style = get_field('blog_card_style', 'options');
  $categories = get_the_terms(get_the_ID(), 'category');

  $the_query = new WP_Query( array(
    'post_type' => get_post_type(),
    'posts_per_page' => 6,
    'post__not_in' => array(get_the_ID()),
  ));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <section class="page-header position-relative">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center py-5 pt-lg-6 pb-lg-5">
          <div class="content mx-auto d-flex flex-column align-items-center">
            <h1 class="display-4"><?php echo get_the_title(); ?></h1>
              <?php if( has_excerpt() ) { ?>
                <p class="fs-5 mb-0"><?php echo get_the_excerpt(); ?></p>
              <?php } ?>
              <?php if ($categories) { ?>
                <p class="d-inline-flex flex-wrap gap-2 post-meta mt-4">
                  <?php foreach( $categories as $cat ) { ?>
                    <a href="<?php echo get_term_link($cat->term_id); ?>" class="btn btn-sm btn-light"><?php echo $cat->name; ?></a>
                  <?php } ?>
                </p>
              <?php } ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
            <?php echo ( has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'full', array('class'=>'background-image')) : '<img src="' . get_template_directory_uri() . '/assets/images/post-placeholder.svg" class="background-image" />' ); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 py-lg-6">
    <?php if( have_rows('blocks') ) { ?>
      <?php get_template_part( 'template-parts/content', 'blocks' ); ?>
    <?php } else { ?>
    	<div class="entry-content container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="content">
    		      <?php echo the_content(); ?>
        	 </div>
          </div>
      	</div>
    	</div>
    <?php } ?>
  </section>

  <section class="block-posts_feed overflow-hidden mb-5 pt-5 border-top">
    <div class="container block-heading mb-5">
      <div class="row justify-content-between align-items-end">
        <div class="col-lg-8 col-xl-6">
          <h3 class="display-6">Continue reading</h3>
        </div>
        <div class="col-lg-auto d-flex mt-3 mt-lg-0">
          <div class="controls"></div>
        </div>
      </div>
    </div>
    <div class="carousel-container position-relative">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col">
            <div class="posts-carousel mx-n2">
              <?php if ( $the_query->have_posts() ) { ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                  <?php $id = get_post_thumbnail_id($post->ID); ?>
                  <div class="px-2">
                    <div class="card border-0 opacity-75-hover <?php if( $settings_card_style == 'card_alt' ) { echo 'bg-transparent'; } ?>">
                      <div class="ratio ratio-4x3 <?php if( $settings_card_style == 'card_alt' ) { echo 'rounded-2'; } ?> overflow-hidden">
                        <?php $categories = get_the_terms($post->ID, 'category'); ?>
                        <?php if ($categories) { ?>
                          <p class="d-inline-flex flex-wrap gap-2 post-meta">
                            <?php foreach( $categories as $cat ) { ?>
                              <span class="badge text-bg-light rounded-1"><?php echo $cat->name; ?></span>
                            <?php } ?>
                          </p>
                        <?php } ?>
                        <?php if( has_post_thumbnail($post->ID) ) {
                          echo wp_get_attachment_image($id, 'medium', '', array('class'=> ( $settings_card_style == 'card_alt' ? 'card-img object-fit-cover' : 'card-img-top object-fit-cover')) );
                        } else {
                          echo '<img src="' . get_template_directory_uri() . '/assets/images/post-placeholder.svg" class="' . ( $settings_card_style == 'card_alt' ? 'card-img object-fit-cover' : 'card-img-top object-fit-cover') . '" />';
                        } ?>
                      </div>
                      <div class="card-body <?php echo ( $settings_card_style == 'card_alt' ? 'px-0 py-3' : 'p-3' )  ; ?>">
                        <h5 class="fs-4"><?php the_title(); ?></h5>
                        <?php if( has_excerpt() ) { ?>
                          <p class="small mb-3 mt-n2 opacity-75"><?php echo get_the_excerpt(); ?></p>
                        <?php } ?>
                        <a href="<?php echo get_the_permalink(); ?>" class="link-primary text-decoration-none mt-auto stretched-link">View Project</a>
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

</article><!-- #post-<?php the_ID(); ?> -->
