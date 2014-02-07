<article class="entry full-entry">
    <div class="content">
        <?php the_content(); ?>
    </div>
    <footer class="footer">
        <div class="meta">
            <time class="pubdate updated" datetime="<?= get_the_date('c'); ?>">Posted on <?= get_the_date(); ?></time>

            <div class="tags">
                <span class="visuallyhidden">Tags:</span>
                <ul class="tags-list"><?php the_tags('This post was tagged: ', '<span>,</span> '); ?></ul>
            </div>
        </div>
    </footer>
</article>

<?php
    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
?>