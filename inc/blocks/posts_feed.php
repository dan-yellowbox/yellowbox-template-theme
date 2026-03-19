<?php
  require_once get_template_directory() . '/inc/blocks/global-block-design.php';
  require_once get_template_directory() . '/inc/blocks/global-block-settings.php';

  $heading = get_sub_field('heading');
  $subheading = get_sub_field('subheading');
  $button = get_sub_field('button');
  $settings_unique_id = get_sub_field('block_id');
  $settings_block_layout = get_sub_field('block_settings_block_layout');
  $settings_heading_layout = get_sub_field('block_settings_heading_layout');
  $show_most_recent = get_sub_field('show_most_recent_posts');
  $articles = get_sub_field('posts');

  $the_query = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => 6,
  ));
?>
<section
  id="<?php echo $settings_unique_id; ?>"
  class="
    block-<?php echo get_row_layout(); ?>
    <?php echo block_design_gap_top(); ?>
    <?php echo block_design_gap_bottom(); ?>
    <?php echo block_design_padding_top(); ?>
    <?php echo block_design_padding_bottom(); ?>
    text-<?php echo block_design_background_colour(); ?>
    overflow-hidden
  ">

  <?php if( $settings_block_layout != 'list' ) { ?>
    <?php if( $heading || $subheading || $button ) { ?>
      <div class="container mb-4">
        <?php if( $settings_heading_layout == 'inline' ) { ?>
          <div class="row justify-content-between align-items-end">
            <div class="col-lg-8 col-xl-6">
              <?php echo ( $heading ? '<h3 class="display-6">' . $heading . '</h3>' : '' ); ?>
              <?php echo ( $subheading ? '<p class="mt-n2">' . $subheading . '</p>' : '' ); ?>
            </div>
            <div class="col-lg-auto d-flex mt-3 mt-lg-0">
              <div class="controls"></div>
              <?php if( $button ) { ?>
                <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="btn btn-<?php echo block_design_background_colour(); ?> bg-opacity-100"><?php echo $button['title']; ?></a>
              <?php } ?>
            </div>
          </div>
        <?php } elseif ( $settings_heading_layout == 'stacked' )  { ?>
          <div class="row justify-content-center align-items-center flex-column text-center">
            <div class="col-lg-9 col-xl-6">
              <?php echo ( $heading ? '<h3 class="display-6">' . $heading . '</h3>' : '' ); ?>
              <?php echo ( $subheading ? '<p class="mt-n2">' . $subheading . '</p>' : '' ); ?>
            </div>
            <div class="col-lg-auto mt-3">
              <div class="controls justify-content-center">
                <?php if( $button ) { ?>
                  <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="btn btn-<?php echo block_design_background_colour(); ?> bg-opacity-100"><?php echo $button['title']; ?></a>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
    <div class="carousel-container position-relative">
      <div class="container">
        <div class="row align-items-center justify-content-between">
          <div class="col">
            <div class="posts-carousel mx-n2">
              <?php if ( $show_most_recent && $the_query->have_posts() ) { ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                  <?php $id = get_post_thumbnail_id($post->ID); ?>
                  <?php $categories = get_the_terms($post->ID, 'category'); ?>
                  <div class="px-2">
                    <div class="card border-0 opacity-75-hover <?php if( $settings_block_layout == 'cards_alt' ) { echo 'bg-transparent'; } ?>">
                      <div class="ratio ratio-4x3 <?php if( $settings_block_layout == 'cards_alt' ) { echo 'rounded-2'; } ?> overflow-hidden">
                        <?php if ($categories) { ?>
                          <p class="d-inline-flex flex-wrap gap-2 post-meta">
                            <?php foreach( $categories as $cat ) { ?>
                              <span class="badge text-bg-light rounded-1"><?php echo $cat->name; ?></span>
                            <?php } ?>
                          </p>
                        <?php } ?>
                        <?php if( has_post_thumbnail($post->ID) ) {
                          echo wp_get_attachment_image($id, 'medium', '', array('class'=> ( $settings_block_layout == 'cards_alt' ? 'background-image' : 'card-img-top object-fit-cover') ));
                        } else {
                          echo '<img src="' . get_template_directory_uri() . '/assets/images/post-placeholder.svg" class="' . ( $settings_block_layout == 'cards_alt' ? '' : 'card-img-top object-fit-cover') . '" />';
                        } ?>
                      </div>
                      <div class="card-body <?php echo ( $settings_block_layout == 'cards_alt' ? 'px-0 py-3 text-' . block_design_background_colour() : 'p-3' )  ; ?>">
                        <h5 class="fs-4"><?php the_title(); ?></h5>
                        <?php if( has_excerpt() ) { ?>
                          <p class="small mb-3 mt-n2 opacity-75"><?php echo get_the_excerpt(); ?></p>
                        <?php } ?>
                        <a href="<?php echo get_permalink(); ?>" class="btn <?php echo ( $settings_block_layout == 'cards_alt' ? 'btn-' . block_design_background_colour() : 'btn-primary-dark' ); ?> bg-opacity-100 btn-sm mt-2 stretched-link">Read article</a>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php } elseif ( ! $show_most_recent && $articles ) { ?>
                <?php foreach( $articles as $post ) { ?>
                  <?php $id = get_post_thumbnail_id($post->ID); ?>
                  <?php $categories = get_the_terms($post->ID, 'category'); ?>
                  <div class="px-2">          
                    <div class="card border-0 opacity-75-hover <?php if( $settings_block_layout == 'cards_alt' ) { echo 'bg-transparent'; } ?>">
                      <div class="ratio ratio-4x3 <?php if( $settings_block_layout == 'cards_alt' ) { echo 'rounded-2'; } ?> overflow-hidden">
                        <?php if ($categories) { ?>
                          <p class="d-inline-flex flex-wrap gap-2 post-meta">
                            <?php foreach( $categories as $cat ) { ?>
                              <span class="badge text-bg-light rounded-1"><?php echo $cat->name; ?></span>
                            <?php } ?>
                          </p>
                        <?php } ?>
                        <?php if( has_post_thumbnail($post->ID) ) {
                          echo wp_get_attachment_image($id, 'medium', '', array('class'=> ( $settings_block_layout == 'cards_alt' ? 'background-image' : 'card-img-top object-fit-cover')));
                        } else {
                          echo '<img src="' . get_template_directory_uri() . '/assets/images/post-placeholder.svg" class="' . ( $settings_block_layout == 'cards_alt' ? '' : 'card-img-top object-fit-cover') . '" />';
                        } ?>
                      </div>
                      <div class="card-body <?php echo ( $settings_block_layout == 'cards_alt' ? 'px-0 py-3 text-' . block_design_background_colour() : 'p-3' )  ; ?>">
                        <h5 class="fs-4"><?php the_title(); ?></h5>
                        <?php if( has_excerpt() ) { ?>
                          <p class="small mb-3 mt-n2 opacity-75"><?php echo get_the_excerpt(); ?></p>
                        <?php } ?>
                        <a href="<?php echo get_permalink(); ?>" class="link-primary text-decoration-none mt-auto stretched-link">Read article</a>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <div class="container">
      <div class="row justify-content-start justify-content-xl-between">
        <?php if( $heading || $subheading ) { ?>
          <div class="col-lg-8 col-xl-5">
            <?php if ( $heading ) { echo '<h2 class="h1">' . $heading . '</h2>'; } ?>
            <?php if ( $subheading ) { echo '<p class="mt-n2">' . $subheading . '</p>'; } ?>
            <?php if( $button ) { ?>
              <a href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>" class="btn btn-<?php echo block_design_background_colour(); ?> bg-opacity-100 mt-4"><?php echo $button['title']; ?></a>
            <?php } ?>
          </div>
        <?php } ?>
        <div class="col-xl-6 mt-5 mt-xl-0">
            <div class="posts-list-carousel my-n2">
              <?php if ( $show_most_recent && $the_query->have_posts() ) { ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                  <?php $id = get_post_thumbnail_id($post->ID); ?>
                  <div class="py-2">
                    <div class="card border-0 h-auto bg-transparent opacity-75-hover">
                      <div class="row align-items-start">
                        <div class="col-3">
                          <div class="ratio ratio-1x1 rounded-2 overflow-hidden h-100 min-w-100">
                            <?php if( has_post_thumbnail($post->ID) ) {
                              echo wp_get_attachment_image($id, 'medium', '', array('class'=>'rounded-2'));
                            } else {
                              echo '<img src="' . get_template_directory_uri() . '/assets/images/post-placeholder.svg" class="rounded-2" />';
                            } ?>
                          </div>
                        </div>
                        <div class="col-9">
                          <div class="card-body <?php echo 'text-' . block_design_background_colour(); ?> p-0">
                            <h5 class=""><?php the_title(); ?></h5>
                            <?php if( has_excerpt() ) { ?>
                              <p class="small mb-3 mt-n2 opacity-75"><?php echo get_the_excerpt(); ?></p>
                            <?php } ?>
                            <a href="<?php echo get_permalink(); ?>" class="link-primary text-decoration-none mt-auto stretched-link">Read article</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              <?php } elseif ( ! $show_most_recent && $articles ) { ?>
                <?php foreach( $articles as $post ) { ?>
                  <?php $id = get_post_thumbnail_id($post->ID); ?>
                  <?php $categories = get_the_terms($post->ID, 'category'); ?>
                  <div class="px-2">
                    <div class="card border-0 opacity-75-hover bg-transparent">
                      <div class="ratio ratio-4x3 rounded-2 overflow-hidden">
                        <?php if ($categories) { ?>
                          <p class="d-inline-flex flex-wrap gap-2 post-meta">
                            <?php foreach( $categories as $cat ) { ?>
                              <span class="badge text-bg-light rounded-1"><?php echo $cat->name; ?></span>
                            <?php } ?>
                          </p>
                        <?php } ?>
                        <?php if( has_post_thumbnail($post->ID) ) {
                          echo wp_get_attachment_image($id, 'medium', '', array('class'=>'background-image'));
                        } else {
                          echo '<img src="' . get_template_directory_uri() . '/assets/images/post-placeholder.svg" class="background-image card-img-top" />';
                        } ?>
                      </div>
                      <div class="card-body px-0 py-3">
                        <h5 class="fs-4"><?php the_title(); ?></h5>
                        <?php if( has_excerpt() ) { ?>
                          <p class="small mb-3 mt-n2 opacity-75"><?php echo get_the_excerpt(); ?></p>
                        <?php } ?>
                        <a href="<?php echo get_permalink(); ?>" class="link-primary text-decoration-none mt-auto stretched-link">Read article</a>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              <?php } ?>
            </div>
        </div>
      </div>
    </div>
  <?php } ?>
</section>
<?php wp_reset_postdata(); ?>