<?php get_header(); ?>

<section id="home-portfolio" class="portfolio-thumbnails">
    <?php marshariti_loop( array( 'post_type' => 'portfolio', 'posts_per_page' => -1 ) ); ?>
</section>

<section id="home-blog-archive" class="blog archive">
    <?php marshariti_loop( array( 'posts_per_page' => 4 ) ); ?>
    <a href="/blog/">More in the Blog archive!</a>
</section>

<?php get_footer(); ?>