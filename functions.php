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


/**
 * Abstracts our WordPress loop for custom queries by calling up content for
 * different posts types using get_template_part based on the CPT slug
 */
function marshariti_loop( $args = array() ) {

    if ( count( $args ) === 0 ) {
        global $wp_query;
        $query = $wp_query;
    } else {
        $query = new WP_Query( $args );
    }

    // THE LOOP!
    if ( $query->have_posts() ) :

        // A simple toggle between our two major view types: "archive" vs "single"
        $viewType = ( is_archive() || is_home() ) ? 'archive' : 'content';

        while ( $query->have_posts() ) : $query->the_post();
            get_template_part( $viewType, get_post_type() );
        endwhile;

    else :
        // In case no content is found but the URL is not 404...
        get_template_part( 'content', 'none' );

    endif;

}


/**
 * Drops the annoying <p> tags that are autop'ed onto image tags in
 * pages and posts by default. Should make it easier to have floated
 * images break out of their paragraph constraints, etc.
 * @param  string $content The content string being passed along by WordPress
 * @return string The same content but with images unwrapped from <p>'s
 */
function marshariti_filter_ptags_on_images( $content ) {
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter( 'the_content', 'marshariti_filter_ptags_on_images' );


/**
 * Gets rid of WordPress's default [...] excerpt ender
 * @return string An empty string
 */
function marshariti_filter_excerpt_read_more() {
    return '';
}
add_filter( 'excerpt_more', 'marshariti_filter_excerpt_read_more' );

/**
 * Displays pagination (older/newer) controls that are better UI
 * than the built-in WordPress posts_nav_link function
 */
function marshariti_pagination() {
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) {
        $olderPostsLink = '<li class="pagination-older-link">' . get_next_posts_link( 'Older posts' ) . '</li>';
        $newerPostsLink = ( is_paged() ) ? '<li class="pagination-newer-link">' . get_previous_posts_link( 'Newer posts' ) . '</li>' : '';

        echo '<nav><ul class="pagination">' . $olderPostsLink . $newerPostsLink . '</ul></nav>';
    }
}