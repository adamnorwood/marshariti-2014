<article class="entry full-entry">
    <header class="header">
        <h1 class="title"><?php the_title(); ?></h1>
    </header>
    <div class="content">
        <?php the_content(); ?>
    </div>
    <footer class="footer">
        <div class="meta">
            <time class="pubdate updated" datetime="<?= get_the_date('c'); ?>"><strong>Updated</strong> <?= get_the_date(); ?></time>
            <div class="categories">
                <span class="visuallyhidden">Posted under:</span>
                <ul><?php the_category(); ?></ul>
            </div>

            <div class="tags">
                <span class="visuallyhidden">Tags:</span>
                <ul><?php the_tags(); ?></ul>
            </div>
        </div>
    </footer>
</article>

<?php
    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
?>