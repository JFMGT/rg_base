<?php
/**
 * The template for displaying single posts
 *
 * @package PhysioTherapy_Pro
 */

get_header();
?>

<main id="main" class="site-main">
    
    <?php
    while (have_posts()) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-hero" style="height: 400px; overflow: hidden; margin-bottom: 3rem;">
                    <?php the_post_thumbnail('full', array('style' => 'width: 100%; height: 100%; object-fit: cover;')); ?>
                </div>
            <?php endif; ?>

            <div class="container-narrow" style="padding: 3rem 2rem;">
                
                <header class="entry-header" style="margin-bottom: 2rem;">

                    <div class="post-meta" style="display: flex; gap: 1rem; margin-bottom: 1rem; font-size: 0.9rem; color: var(--color-text-light); flex-wrap: wrap;">
                        <span>📅 <?php echo get_the_date(); ?></span>
                        <span>•</span>
                        <span>👤 <?php the_author(); ?></span>
                        <span>•</span>
                        <?php physio_reading_time(); ?>
                        <?php if (has_category()) : ?>
                            <span>•</span>
                            <span>🏷 <?php the_category(', '); ?></span>
                        <?php endif; ?>
                    </div>

                    <h1 class="entry-title"><?php the_title(); ?></h1>

                </header>

                <div class="entry-content" style="line-height: 1.8;">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Seiten:', 'physio-therapy-pro'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php if (get_the_tags()) : ?>
                    <footer class="entry-footer" style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--color-border);">
                        <div class="post-tags">
                            <?php the_tags('<strong>Tags: </strong>', ', '); ?>
                        </div>
                    </footer>
                <?php endif; ?>

                <?php
                // Navigation to previous/next post
                the_post_navigation(array(
                    'prev_text' => '<span class="nav-subtitle">Vorheriger Beitrag</span><span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">Nächster Beitrag</span><span class="nav-title">%title</span>',
                ));
                ?>

            </div>

            <?php
            // If comments are open or there is at least one comment
            if (comments_open() || get_comments_number()) :
                ?>
                <div class="container-narrow" style="padding: 0 2rem 3rem;">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

        </article>

        <?php
        // Display related posts
        physio_related_posts();
        ?>

    <?php endwhile; ?>

</main>

<?php
get_footer();
