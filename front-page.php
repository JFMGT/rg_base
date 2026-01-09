<?php
/**
 * The front page template file - Block Editor Version
 *
 * This template supports the WordPress Block Editor (Gutenberg).
 * You can now add and arrange sections using the Block Patterns from the
 * "Physio Sektionen" category in the WordPress editor.
 *
 * @package Master_Pro
 */

get_header();
?>

<main id="main" class="site-main">

    <?php
    while (have_posts()) :
        the_post();

        // Output the block content
        the_content();

    endwhile;
    ?>

</main>

<?php
get_footer();
