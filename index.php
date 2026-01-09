<?php
/**
 * The main template file
 *
 * @package PhysioTherapy_Pro
 */

get_header();
?>

<main id="main" class="site-main">
    
    <?php if (have_posts()) : ?>
        
        <section class="blog-section" style="padding: 4rem 0;">
            <div class="container">
                
                <header class="section-header">
                    <?php if (is_home() && !is_front_page()) : ?>
                        <h1><?php single_post_title(); ?></h1>
                    <?php else : ?>
                        <h1>Neuigkeiten & Artikel</h1>
                    <?php endif; ?>
                </header>

                <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 2rem;">
                    <?php
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?> style="background: var(--color-white); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm); transition: all 0.3s ease;">
                            
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
                                    <?php physio_reading_time(); ?>
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
                    'prev_text' => __('← Zurück', 'physio-therapy-pro'),
                    'next_text' => __('Weiter →', 'physio-therapy-pro'),
                ));
                ?>
                
            </div>
        </section>

    <?php else : ?>

        <section class="no-results" style="padding: 4rem 0; text-align: center;">
            <div class="container">
                <h1>Keine Beiträge gefunden</h1>
                <p>Es tut uns leid, aber es wurden keine Beiträge gefunden.</p>
            </div>
        </section>

    <?php endif; ?>

</main>

<?php
get_footer();
