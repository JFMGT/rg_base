<?php
/**
 * The template for displaying pages
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

            <?php
            $hide_title = get_post_meta(get_the_ID(), '_hide_page_title', true);

            if (!$hide_title) :
                if (has_post_thumbnail()) : ?>
                    <div class="page-hero" style="height: 300px; overflow: hidden; background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%); display: flex; align-items: center; justify-content: center; position: relative;">
                        <?php the_post_thumbnail('full', array('style' => 'position: absolute; width: 100%; height: 100%; object-fit: cover; opacity: 0.2;')); ?>
                        <div class="container" style="position: relative; z-index: 1;">
                            <h1 style="color: white; text-align: center; margin: 0;"><?php the_title(); ?></h1>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="page-header" style="background: linear-gradient(135deg, rgb(31, 167, 160) 48%, rgb(139, 197, 63) 97%); padding: 3rem 0;">
                        <div class="container">
                            <h1 style="color: white; margin: 0; "><?php the_title(); ?></h1>
                        </div>
                    </div>
                <?php endif;
            endif; ?>

                
                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Seiten:', 'physio-therapy-pro'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

            

        </article>

        <?php
        // If comments are open or there is at least one comment
        if (comments_open() || get_comments_number()) :
            ?>
            <div class="container" style="padding: 0 2rem 3rem;">
                <?php comments_template(); ?>
            </div>
        <?php endif; ?>

    <?php endwhile; ?>

</main>

<?php
get_footer();
