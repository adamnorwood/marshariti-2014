<article class="book">
    <a href="<?php the_permalink(); ?>">
        <?= wp_get_attachment_image( get_field( 'book-cover-image' ), 'book-thumbnail', 0, array( 'class' => 'book-thumbnail' ) ); ?>
        <h2><?php the_title(); ?></h2>
    </a>

    <section class="book-excerpt"><?= get_field( 'excerpt' ); ?></section>
    <section class="book-meta">
        <?php if ( $author = get_field( 'author' ) ) : ?>
            <p class="book-meta-author"><?= $author ?></p>
        <?php endif; ?>
        <a href="<?php the_permalink() ?>" class="read-more">Read more<span> about <?php the_title(); ?></span></a>

        <?php if ( have_rows( 'stores' ) ) : ?>
            <div class="book-meta-stores">
                <strong>Buy now!</strong>
                <ul class="book-meta-stores-list">
                    <?php while ( have_rows( 'stores' ) ) : the_row(); ?>
                    <li class="book-meta-store"><a class="button" href="<?php the_sub_field( 'store-url' ); ?>"><?php the_sub_field( 'store-name' ); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>
    </section>
</article>