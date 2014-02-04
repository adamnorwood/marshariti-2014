<?php

    // Attempt to get the info from Advanced Custom Fields field groups
    $thumbnailID = get_field( 'thumbnail-image' );
    $fullSizeID  = get_field( 'full-image' );
    $fullSizeURL = wp_get_attachment_url( $fullSizeID, 'full' );
    $attrs       = array( 'class' => 'portfolio-thumbnail' );

    // If there's a custom Thumbnail sized image, we'll display that,
    // otherwise we'll fall back to the WordPress-built thumbnail
    $image = ( !empty( $thumbnailID ) ) ?
        wp_get_attachment_image( $thumbnailID, 'full', 0, $attrs ) :
        wp_get_attachment_image( $fullSizeID, 'thumbnail', 0, $attrs );

?>

<figure class="portfolio-image">
    <figcaption><?php the_title(); ?></figcaption>
    <a href="<?= $fullSizeURL ?>" class="portfolio-image-link"><?= $image ?></a>
</figure>