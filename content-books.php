<article class="book">
    <header>
        <h1 class="title"><?php the_title(); ?></h1>
    </header>

    <?= wp_get_attachment_image( get_field( 'book-cover-image' ), 'full', 0, array( 'class' => 'book-cover-image' ) ); ?>

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

        <?php if ( have_rows( 'stores' ) ) : ?>
            <div class="book-meta-stores">Buy now!
                <ul class="book-meta-stores-list">
                    <?php while ( have_rows( 'stores' ) ) : the_row(); ?>
                    <li class="book-meta-store"><a href="<?php the_sub_field( 'store-url' ); ?>"><?php the_sub_field( 'store-name' ); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>
    </section>

    <section class="book-content">
        <?php the_content(); ?>
    </section>
</article>