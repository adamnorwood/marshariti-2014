<?php
/**
 * Our sitewide footer template
 *
 * @package WordPress
 * @subpackage Marsha_Riti
 */
?>

            </main>

            <footer id="sitewide-footer" class="sitewide-footer" role="contentinfo">

                <h2 class="visuallyhidden">Social Media Links</h2>
                <ul class="social-media-links">
                    <li><a href="https://twitter.com/marshariti" class="social-media-icon">Twitter</a></li>
                    <li><a href="http://instagram.com/marshariti" class="social-media-icon">Instagram</a></li>
                    <li><a href="http://marshariti.tumblr.com/" class="social-media-icon">Tumblr</a></li>
                    <li><a href="https://www.facebook.com/pages/Marsha-Riti/224593634239663" class="social-media-icon">Facebook</a></li>
                    <li><a href="/feed/" class="social-media-icon">RSS</a></li>
                </ul>

                <small class="copyright">Unless otherwise noted, all work is copyright <?php echo date('Y'); ?>. Thanks for visiting!</small>
            </footer>

        </div> <?php // ends container // ?>

        <?php wp_footer(); ?>

        <script src="//cdn.jsdelivr.net/jquery.slick/1.3.6/slick.min.js"></script>

        <script>
            $('.portfolio-thumbnails').slick( {
                slidesToShow: 4,
                slidesToScroll: 1,
                slide: '.portfolio-thumbnail'
            } );
        </script>

        <?php if ( !is_front_page() && !is_singular() ) : ?>

        <script>
            var infinite_scroll = {
                loading: {
                    img: "<?= get_template_directory_uri(); ?>/images/loading.gif",
                    msgText: "<?= 'Loading more posts…' ?>",
                    finishedMsg: "<?= 'All posts loaded.' ?>"
                },
                "nextSelector":".pagination-older-link",
                "navSelector":".pagination",
                "itemSelector":"article",
                "contentSelector":"#main"
            };
            jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
        </script>

        <?php endif; ?>

        <?php if ( strpos( $_SERVER['SERVER_NAME'], '.dev' ) !== false ): ?>
        <script src="//localhost:35729/livereload.js"></script>
        <?php endif; ?>

    </body>
</html>