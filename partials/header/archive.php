  <section class="page-header position-relative">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 pt-7 pb-5 text-center">
          <?php if( is_home() ) { ?>
            <h1 class="display-3"><?php echo ( get_field('blog_page_heading', 'options') ? get_field('blog_page_heading', 'options') : get_the_title( get_option('page_for_posts', true) ) ); ?></h1>
            <?php if ( get_field('blog_page_subheading', 'options') ) { echo '<p>' . get_field('blog_page_subheading', 'options') . '</p>'; } ?>
          <?php } else { ?>
            <?php the_archive_title( '<h1 class="display-3">', '</h1>' ); ?>
            <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>  