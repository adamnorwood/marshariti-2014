<?php

    // Attempt to get the info from Advanced Custom Fields field groups
    $thumbnailID = get_field( 'thumbnail-image' );
    $fullSizeID  = get_field( 'full-image' );
    $fullSizeURL = wp_get_attachment_url( $fullSizeID, 'full' );

    // If there's a custom Thumbnail sized image, we'll display that,
    // otherwise we'll fall back to the WordPress-built thumbnail
    $imageSRC = ( !empty( $thumbnailID ) ) ?
        wp_get_attachment_image_src( $thumbnailID, 'full' ) :
        wp_get_attachment_image_src( $fullSizeID, 'thumbnail' );

?>

<figure class="portfolio-image">
    <figcaption><?php the_title(); ?></figcaption>
    <a href="<?= $fullSizeURL ?>" class="portfolio-image-link"><img src="<?= $imageSRC[0] ?>" alt="Thumbnail: <?= get_the_title() ?>" class="portfolio-thumbnail" /></a>
</figure>