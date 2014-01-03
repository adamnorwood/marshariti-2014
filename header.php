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

        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <?php wp_head(); ?>
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
