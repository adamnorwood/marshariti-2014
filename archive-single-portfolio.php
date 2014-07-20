<?php

    // Attempt to get the info from Advanced Custom Fields field groups
    $thumbnailID = get_field( 'thumbnail-image' );
    $fullSizeID  = get_field( 'full-image' );
    $fullSizeURL = wp_get_attachment_url( $fullSizeID, 'full' );

    // If there's a custom Thumbnail sized image, we'll display that,
    // otherwise we'll fall back to the WordPress-built thumbnail
    $imageSRC = ( !empty( $thumbnailID ) ) ?
        wp_get_attachment_image_src( $thumbnailID, 'post-thumbnail' ) :
        wp_get_attachment_image_src( $fullSizeID, 'thumbnail' );

?>

<div class="portfolio-thumbnail">
    <a href="<?= $fullSizeURL ?>" class="portfolio-thumbnail-link"><img src="<?= $imageSRC[0] ?>" alt="Thumbnail: <?= get_the_title() ?>" class="portfolio-thumbnail-image" /></a>
</div>