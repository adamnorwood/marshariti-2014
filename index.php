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

marshariti_loop();

get_footer();

?>