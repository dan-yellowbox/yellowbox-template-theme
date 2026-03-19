<?php
/**
 * Template part for displaying posts in category
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yellowbox
 */

$categories = get_the_terms(get_the_ID(), 'category');
$settings_card_style = get_field('blog_card_style', 'options');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="card border-0 opacity-75-hover <?php if( $settings_card_style == 'card_alt' ) { echo 'bg-transparent'; } ?>">
    <div class="ratio ratio-4x3 <?php if( $settings_card_style == 'card_alt' ) { echo 'rounded-2'; } ?> overflow-hidden">
      <?php if ($categories) { ?>
        <p class="d-inline-flex flex-wrap gap-2 post-meta">
          <?php foreach( $categories as $cat ) { ?>
            <span class="badge text-bg-light rounded-1"><?php echo $cat->name; ?></span>
          <?php } ?>
        </p>
      <?php } ?>
      <?php if( has_post_thumbnail(get_the_ID()) ) {
        echo get_the_post_thumbnail(get_the_ID(), 'medium', array('class'=> ( $settings_card_style == 'card_alt' ? 'card-img object-fit-cover' : 'card-img-top object-fit-cover') ));
      } else {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/post-placeholder.svg" class="' . ( $settings_card_style == 'card_alt' ? 'card-img object-fit-cover' : 'card-img-top object-fit-cover') . '" />';
      } ?>
    </div>
    <div class="card-body <?php echo ( $settings_card_style == 'card_alt' ? 'px-0 py-3' : 'p-3' )  ; ?>">
      <h5 class="fs-4"><?php the_title(); ?></h5>
      <?php if( has_excerpt() ) { ?>
        <p class="small mb-3 mt-n2 opacity-75"><?php echo get_the_excerpt(); ?></p>
      <?php } ?>
      <a href="<?php echo get_the_permalink(); ?>" class="link-primary text-decoration-none mt-auto stretched-link">Read article</a>
    </div>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
