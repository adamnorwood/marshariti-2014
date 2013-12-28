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
        <header id="masthead" class="sitewide-header" role="banner">
            <a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
            </a>

            <div id="navbar" class="navbar">
                <nav id="sitewide-navigation" class="navigation main-navigation" role="navigation">
                    <h2 class="menu-toggle">Menu</h2>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
                </nav>
            </div>
        </header>