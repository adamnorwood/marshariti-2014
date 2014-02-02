<article class="entry excerpt">
    <header class="header">
        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <time class="pubdate updated" datetime="<?= get_the_date('c'); ?>">Posted on <?= get_the_date(); ?></time>
    </header>
    <div class="content">
        <?php the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="read-more">Read more…</a>
</article>