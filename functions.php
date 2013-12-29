<?php
/**
 * Marsha Riti theme functions and basic configuration
 *
 * @package WordPress
 * @subpackage Marsha_Riti
 */

/**
 * Marsha Riti setup
 *
 * Sets up the theme and registers any specific helper functionality
 * that we might find convenient for this theme.
 *
 */
function marshariti_setup() {

    // Adds RSS feed links to <head> automatically for posts and comments
    add_theme_support( 'automatic-feed-links' );

    /*
     * Switches default core markup for search form, comment form,
     * and comments to output valid HTML5.
     */
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

    // Register the main navigation menu, used in one place
    register_nav_menu( 'primary', 'Main Menu' );

    /*
     * Allow support for post thumbnails / featured images
     */
    add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'marshariti_setup' );

/**
 * Adds Stylesheets and Scripts to our theme programatically
 *
 * @since Adam_Norwood 5.0a
 */
function marshariti_styles_and_scripts() {

    // Register the main stylesheet
    wp_enqueue_style( 'marshariti-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );

    // Register our main scripts file, with jQuery dependency
    wp_enqueue_script( 'marshariti-modernizr', get_stylesheet_directory_uri() . '/js/modernizr.min.js', false, filemtime( get_stylesheet_directory() . '/js/modernizr.min.js' ), false );
    wp_enqueue_script( 'marshariti-scripts',   get_stylesheet_directory_uri() . '/js/scripts.min.js', array('jquery'), filemtime( get_stylesheet_directory() . '/js/scripts.min.js' ), true );

}
add_action( 'wp_enqueue_scripts', 'marshariti_styles_and_scripts' );