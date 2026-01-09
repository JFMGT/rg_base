<?php
/**
 * The template for displaying search results
 *
 * @package PhysioTherapy_Pro
 */

get_header();
?>

<main id="main" class="site-main">
    
    <div class="page-header" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%); padding: 3rem 0;">
        <div class="container">
            <?php if (have_posts()) : ?>
                <h1 style="color: white; margin-bottom: 1rem;">
                    Suchergebnisse für: <span style="font-weight: 400;"><?php echo get_search_query(); ?></span>
                </h1>
            <?php else : ?>
                <h1 style="color: white; margin-bottom: 1rem;">
                    Keine Ergebnisse für: <span style="font-weight: 400;"><?php echo get_search_query(); ?></span>
                </h1>
            <?php endif; ?>
        </div>
    </div>

    <section style="padding: 4rem 0;">
        <div class="container">
            
            <?php if (have_posts()) : ?>
                
                <div class="blog-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 2rem;">
                    <?php
                    while (have_posts()) :
                        the_post();
                        
                        $post_type = get_post_type();
                        $post_type_obj = get_post_type_object($post_type);
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?> style="background: var(--color-white); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm);">
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail" style="height: 200px; overflow: hidden;">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('style' => 'width: 100%; height: 100%; object-fit: cover;')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content" style="padding: 1.5rem;">
                                
                                <div class="post-meta" style="display: flex; gap: 0.5rem; margin-bottom: 1rem; font-size: 0.9rem;">
                                    <span style="background: var(--color-primary); color: white; padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.8rem;">
                                        <?php echo $post_type_obj->labels->singular_name; ?>
                                    </span>
                                    <span style="color: var(--color-text-light);">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                </div>
                                
                                <h2 class="entry-title" style="margin-bottom: 1rem;">
                                    <a href="<?php the_permalink(); ?>" style="color: var(--color-text);">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more" style="color: var(--color-primary); font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                                    Mehr erfahren →
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

            <?php else : ?>

                <div style="max-width: 600px; margin: 0 auto; text-align: center; padding: 3rem 0;">
                    <div style="font-size: 5rem; margin-bottom: 2rem; opacity: 0.3;">😕</div>
                    <h2 style="margin-bottom: 1rem;">Keine Ergebnisse gefunden</h2>
                    <p style="color: var(--color-text-light); margin-bottom: 2rem;">
                        Ihre Suche nach "<strong><?php echo get_search_query(); ?></strong>" ergab leider keine Treffer. 
                        Versuchen Sie es mit anderen Suchbegriffen.
                    </p>
                    
                    <div style="margin-bottom: 3rem;">
                        <?php get_search_form(); ?>
                    </div>
                    
                    <div style="text-align: left; background: var(--color-background); padding: 2rem; border-radius: var(--radius-lg);">
                        <h3 style="margin-bottom: 1rem;">Suchtipps:</h3>
                        <ul style="color: var(--color-text-light); line-height: 1.8;">
                            <li>Überprüfen Sie die Rechtschreibung Ihrer Suchbegriffe</li>
                            <li>Verwenden Sie allgemeinere Suchbegriffe</li>
                            <li>Verwenden Sie weniger Suchbegriffe</li>
                            <li>Nutzen Sie Synonyme oder verwandte Begriffe</li>
                        </ul>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </section>

</main>

<?php
get_footer();
