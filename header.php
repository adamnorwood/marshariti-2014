<?php
/**
 * The header template for our theme.
 *
 * @package WordPress
 * @subpackage Marsha_Riti
 */
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>

        <?php if ( is_front_page() ) : ?>

        <meta name="description" content="<?= get_bloginfo('description') ?>" />
        <meta name="keywords"    content="marsha riti, art, childrens books, illustration, kids, fun, watercolor, austin, texas" />

        <?php endif; ?>

        <link rel="author" href="https://plus.google.com/108133137841632096375/" />

        <?php if ( is_single() ) : ?>

            <?php
                $featuredImage = wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) );
                $featuredImageFB = $featuredImage;

                if ( !$featuredImage ) {
                    $featuredImage   = get_template_directory_uri() . '/images/marsha-riti.jpg';
                    $featuredImageFB = get_template_directory_uri() . '/images/marsha-riti-fb.jpg';
                }
            ?>

            <meta property="og:url" content="<?= get_permalink() ?>" />
            <meta property="og:title" content="<?php single_post_title() ?>" />
            <meta property="og:description" content="<?= strip_tags( get_the_excerpt() ) ?>" />

            <?php if ( 'books' == $post->post_type ) : ?>

            <meta property="og:type" content="book" />
            <meta property="og:book:author" content="<?= str_replace( 'Written by ', '', get_field( 'author' ) ) ?>" />
            <meta property="og:book:isbn" content="<?= get_field( 'isbn-number' ) ?>" />
            <meta property="og:book:release_date" content="<?= date( 'c', strtotime( get_field( 'publication-date' ) ) ) ?>" />
            <meta property="og:image" content="<?= reset( wp_get_attachment_image_src( get_field( 'book-cover-image' ), 'book-thumbnail' ) ); ?>" />

            <meta property="twitter:description" content="<?= strip_tags( trim( get_field( 'excerpt' ) ) ) ?>" />
            <meta property="twitter:image" content="<?= reset( wp_get_attachment_image_src( get_field( 'book-cover-image' ), 'book-thumbnail' ) ); ?>" />

            <?php elseif ( 'post' == $post->post_type ): ?>

            <meta property="og:type" content="article" />
            <meta property="og:published_time" content="<?= get_the_time( 'c' ) ?>" />

            <?php else : ?>

            <meta property="og:type" content="website" />
            <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
            <meta property="og:description" content="<?php bloginfo( 'description' ); ?>" />
            <meta property="og:image" content="<?= $featuredImageFB ?>" />

            <meta property="twitter:description" content="<?= bloginfo( 'description' ) ?>" />
            <meta property="twitter:image" content="<?= $featuredImage ?>" />

            <?php endif; ?>

            <meta property="twitter:url" content="<?= get_permalink() ?>" />
            <meta property="twitter:title" content="<?= single_post_title() ?>" />

        <?php elseif ( is_page() || is_front_page() ) : ?>

            <meta property="og:type" content="website" />
            <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>" />
            <meta property="og:description" content="<?php bloginfo( 'description' ); ?>" />
            <meta property="og:image" content="<?= get_template_directory_uri() . '/images/marsha-riti-fb.jpg' ?>" />

            <meta property="twitter:description" content="<?= bloginfo( 'description' ) ?>" />
            <meta property="twitter:image" content="<?= get_template_directory_uri() . '/images/marsha-riti.jpg' ?>" />
            <meta property="twitter:url" content="<?= get_permalink() ?>" />
            <meta property="twitter:title" content="<?= single_post_title() ?>" />

        <?php endif; ?>

        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <?php wp_head(); ?>

        <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.3.6/slick.css" />

        <script type="text/javascript">
            /* GOOGLE Analytics */
            if (document.domain.indexOf('.dev') < 0) {
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', 'UA-7946114-2', 'marshariti.com');
                ga('send', 'pageview');
            }
        </script>
    </head>
    <body <?php body_class(); ?>>
        <div class="container">
            <header id="masthead" class="sitewide-header" role="banner">
                <a class="home-link site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                    <h1><?php bloginfo( 'name' ); ?></h1>
                </a>

                <a class="visuallyhidden focusable skip-link" href="#main" title="Skip to content">Skip to content</a>

                <nav id="sitewide-navigation" class="navigation main-navigation navbar" role="navigation">
                    <h2 class="menu-toggle" tabindex="0"><b class="visuallyhidden">Menu</b></h2>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                </nav>

            </header>

            <main id="main">
