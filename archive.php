<?php
/**
 * The template for displaying archive pages
 *
 * @package Master_Pro
 */

get_header();
?>

<main id="main" class="site-main">
    
    <div class="page-header" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%); padding: 3rem 0;">
        <div class="container">
            <?php the_archive_title('<h1 style="color: white; margin: 0;">', '</h1>'); ?>
            <?php the_archive_description('<div style="color: rgba(255, 255, 255, 0.9); margin-top: 1rem;">', '</div>'); ?>
        </div>
    </div>

    <?php if (have_posts()) : ?>
        
        <section style="padding: 4rem 0;">
            <div class="container">
                
                <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 2rem;">
                    <?php
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?> style="background: var(--color-white); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm);">
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail" style="height: 250px; overflow: hidden;">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: 100%; object-fit: cover;')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content" style="padding: 1.5rem;">
                                
                                <div class="post-meta" style="display: flex; gap: 1rem; margin-bottom: 1rem; font-size: 0.9rem; color: var(--color-text-light);">
                                    <span><?php echo get_the_date(); ?></span>
                                    <span>•</span>
                                    <span><?php the_category(', '); ?></span>
                                </div>
                                
                                <h2 class="entry-title" style="margin-bottom: 1rem;">
                                    <a href="<?php the_permalink(); ?>" style="color: var(--color-text);">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more" style="color: var(--color-primary); font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                                    Weiterlesen →
                                </a>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>

                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('← Zurück', 'master-therapy-pro'),
                    'next_text' => __('Weiter →', 'master-therapy-pro'),
                ));
                ?>
                
            </div>
        </section>

    <?php else : ?>

        <section style="padding: 4rem 0; text-align: center;">
            <div class="container">
                <h2>Keine Beiträge gefunden</h2>
                <p>Es wurden keine Beiträge in diesem Archiv gefunden.</p>
            </div>
        </section>

    <?php endif; ?>

</main>

<?php
get_footer();
