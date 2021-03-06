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

    add_image_size( 'post-thumbnail', 250, 250, true );

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

    // Register Modernizr
    wp_enqueue_script( 'marshariti-modernizr', get_stylesheet_directory_uri() . '/js/modernizr.min.js', false, filemtime( get_stylesheet_directory() . '/js/modernizr.min.js' ), false );

    // Point jQuery to the Google API host instead
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"), false, '1.10.2', true);
    wp_enqueue_script('jquery');

    // Add the touchSwipe jQuery library for the Portfolio if on the homepage
    if ( is_front_page() ) {
        wp_enqueue_script( 'jquery-touchSwipe', get_stylesheet_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), filemtime( get_stylesheet_directory() . '/js/jquery.touchSwipe.min.js'), true );
    }

    // Register our main scripts file, with jQuery dependency
    wp_enqueue_script( 'marshariti-scripts',   get_stylesheet_directory_uri() . '/js/scripts.min.js', array('jquery'), filemtime( get_stylesheet_directory() . '/js/scripts.min.js' ), true );


}
add_action( 'wp_enqueue_scripts', 'marshariti_styles_and_scripts' );


/**
 * Removes jQuery Migrate...we shouldn't need it!
 * @param  obj $scripts The WordPress registered scripts object
 */
function marshariti_dequeue_jquery_migrate( &$scripts){
    if( !is_admin() ) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
    }
}
add_filter( 'wp_default_scripts', 'marshariti_dequeue_jquery_migrate' );


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
        $viewType = ( is_archive() || is_home() || is_front_page() ) ? 'archive-single' : 'content';

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


function marshariti_custom_img_caption_shortcode( $empty, $attr, $content ) {

    $attr = shortcode_atts( array(
        'id'      => '',
        'align'   => 'alignnone',
        'width'   => '',
        'caption' => ''
    ), $attr );

    if ( 1 > (int) $attr['width'] || empty( $attr['caption'] ) ) {
        return '';
    }

    if ( $attr['id'] ) {
        $attr['id'] = 'id="' . esc_attr( $attr['id'] ) . '" ';
    }

    return '<div ' . $attr['id']
    . 'class="wp-caption ' . esc_attr( $attr['align'] ) . '">'
    . do_shortcode( $content )
    . '<p class="wp-caption-text">' . $attr['caption'] . '</p>'
    . '</div>';

}
add_filter( 'img_caption_shortcode', 'marshariti_custom_img_caption_shortcode', 10, 3 );

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
function marshariti_pagination( $class = 'pagination' ) {
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) {
        $olderPostsLink = get_next_posts_link( '&larr; Older posts' );
        $newerPostsLink = ( is_paged() ) ? get_previous_posts_link( 'Newer posts &rarr;' ) : '';

        echo '<nav class="' . $class . '">' . $olderPostsLink . $newerPostsLink . '</nav>';
    }
}

/**
 * Handles adding a simple class to the anchor generated by get_next_posts_link().
 * Why isn't this easier, WordPress?
 * @return string The HTML class attribute to be added to the link.
 */
function marshariti_older_posts_link_attributes() {
    return 'class="pagination-older-link button"';
}
add_filter('next_posts_link_attributes',     'marshariti_older_posts_link_attributes' );

/**
 * Handles adding a simple class to the anchor generated by get_next_posts_link().
 * Why isn't this easier, WordPress?
 * @return string The HTML class attribute to be added to the link.
 */
function marshariti_newer_posts_link_attributes() {
    return 'class="pagination-newer-link button"';
}
add_filter('previous_posts_link_attributes', 'marshariti_newer_posts_link_attributes' );


/**
 * Allows for custom styling of the WordPress comments HTML
 */
function marshariti_custom_comments_html( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }

       $commentID        = $comment->comment_ID;
       $commentClass     = comment_class( empty( $args['has_children'] ) ? '' : 'parent', null, null, false );
       $commentDate      = get_comment_date();
       $commentDatetime  = get_comment_date('c');
       $commentTime      = get_comment_time();
       $avatar           = get_avatar( $comment, $args['avatar_size'] );
       $author           = get_comment_author_link( $comment );
       $commentText      = get_comment_text();
       $commentText      = ( $comment->comment_approved == '0' ) ?
                           '<p><strong><em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em></strong></p>' . $commentText :
                           $commentText;
       $commentReplyLink = get_comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );

    echo <<< END

    <{$tag} {$commentClass} id="comment-{$commentID}">
        <div class="comment-meta">
            <span class="comment-byline">
                {$avatar}
                <span class="comment-author">{$author}</span>
                <a href="#comment-{$commentID}" class="comment-permalink"><time class="pubdate" datetime="{$commentDatetime}">{$commentDate}</time></a>
            </span>
        </div>
        <div class="comment-content">
            {$commentText}
        </div>
        <div class="comment-reply">
            {$commentReplyLink}
        </div>

END;
}
add_filter('get_comment_text', 'wpautop', 30);