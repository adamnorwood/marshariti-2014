<?php get_header(); ?>

<header class="header"><h1 class="title"><?php wp_title(''); ?></h1></header>

<img src="<?= get_template_directory_uri(); ?>/images/scaredy-bear-404.jpg" alt="" class="alignleft" />

<p>Oh no! The page you requested wasn’t found! You might find something
   good looking through my <a href="/blog/">blog archives</a>, but
   if all else fails <a href="mailto:marsha@marshariti.com">drop me an email</a>.</p>

<?php get_footer(); ?>