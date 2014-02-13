<?php get_header(); ?>

<section id="home-portfolio">
    <div class="portfolio-thumbnails">
        <?php marshariti_loop( array( 'post_type' => 'portfolio', 'posts_per_page' => -1 ) ); ?>
    </div>
</section>

<section id="home-blog-archive" class="blog archive">
    <h1 class="title">From the Blog</h1>
    <?php marshariti_loop( array( 'posts_per_page' => 4 ) ); ?>
    <a href="/blog/" class="button">More in the Blog archive! &rarr;</a>
</section>

<?php get_footer(); ?>