<?php
/**
 * The main template file
 *
 * Displays when there is no other template file more specific in the hierarchy to render
 * the requested content, and acts as the main archive-handling template.
 *
 * @package WordPress
 * @subpackage Marsha_Riti
 */
?>

<?php

get_header();

?>

    <header class="header"><h1 class="title"><?php wp_title(''); ?></h1></header>

<?php

marshariti_loop();

marshariti_pagination();

get_footer();

?>