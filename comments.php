<?php if ( have_comments() ) : ?>

    <div class="comments" id="comments">
        <h2 class="comments-count"><?php comments_number( 'No comments so far…', 'One delightful comment!', '% delightful comments!' ); ?></h2>

        <ol class-"comments-list">
        <?php
            wp_list_comments( array(
                'avatar_size' => 100,
                'short_ping'  => true,
                'style'       => 'ol',
                'max_depth'   => 3
            ) );
        ?>
        </ol>
    </div>

    <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed for this post.' ); ?></p>
    <?php endif; ?>

<?php endif; ?>

<?php comment_form(); ?>