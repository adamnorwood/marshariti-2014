<article class="book">

    <?= wp_get_attachment_image( get_field( 'book-cover-image' ), 'full', 0, array( 'class' => 'book-cover-image' ) ); ?>

    <div class="book-info">

        <section class="book-content">
            <?php the_content(); ?>
        </section>

        <section class="book-meta">
            <?php if ( $author = get_field( 'author' ) ) : ?>
                <p class="book-meta-author"><?= $author ?></p>
            <?php endif; ?>

            <?php if ( $pubDate = DateTime::createFromFormat( 'Ymd', get_field( 'publication-date' ) ) ) : ?>
                <p class="book-meta-date">Published on <?= $pubDate->format('F j, Y') ?></p>
            <?php endif; ?>

            <?php if ( $publisher = get_field( 'publisher-info' ) ) : ?>
                <p class="book-meta-publisher">Publisher: <?= $publisher ?></p>
            <?php endif; ?>

            <?php if ( $isbn = get_field( 'isbn-number' ) ) : ?>
                <p class="book-meta-isbn">ISBN: <?= $isbn ?></p>
            <?php endif; ?>
        </section>

        <?php if ( have_rows( 'stores' ) ) : ?>
            <div class="book-meta-stores"><strong>Buy now!</strong>
                <ul class="book-meta-stores-list">
                    <?php while ( have_rows( 'stores' ) ) : the_row(); ?>
                    <li class="book-meta-store"><a class="button" href="<?php the_sub_field( 'store-url' ); ?>"><?php the_sub_field( 'store-name' ); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</article>