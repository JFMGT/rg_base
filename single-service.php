<?php
/**
 * The template for displaying single service
 *
 * @package PhysioTherapy_Pro
 */

get_header();
?>

<main id="main" class="site-main">
    
    <?php
    while (have_posts()) :
        the_post();
        
        $icon = get_post_meta(get_the_ID(), '_service_icon', true);
        $duration = get_post_meta(get_the_ID(), '_service_duration', true);
        $price = get_post_meta(get_the_ID(), '_service_price', true);
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <!-- Service Header -->
            <div class="page-header" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%); padding: 4rem 0;">
                <div class="container">
                    <div style="max-width: 800px; margin: 0 auto; text-align: center;">
                        <?php if ($icon) : ?>
                            <div style="font-size: 4rem; margin-bottom: 1rem; color:white">
                                <?php
                                // Erlaubt HTML für Font Awesome Icons
                                $allowed_html = array(
                                    'i' => array('class' => array(), 'aria-hidden' => array()),
                                    'span' => array('class' => array()),
                                );
                                echo wp_kses($icon, $allowed_html);
                                ?>
                            </div>
                        <?php endif; ?>
                        
                        <h1 style="color: white; margin-bottom: 1rem;"><?php the_title(); ?></h1>
                        
                        <?php if ($duration || $price) : ?>
                            <div style="color: rgba(255, 255, 255, 0.9); font-size: 1.1rem; display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap;">
                                <?php if ($duration) : ?>
                                    <span><i class="fa-solid fa-stopwatch"></i> <?php echo esc_html($duration); ?></span>
                                <?php endif; ?>
                                <?php if ($price) : ?>
                                    <span><i class="fa-solid fa-tag"></i> <?php echo esc_html($price); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Service Content -->
            <div class="container" style="padding: 4rem 2rem;">
                
                <div style="max-width: 900px; margin: 0 auto;">
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div style="margin-bottom: 3rem; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-lg);">
                            <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto;')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content" style="line-height: 1.8; font-size: 1.1rem;">
                        <?php the_content(); ?>
                    </div>

                    <!-- Service Details Box -->
                    <div style="background: var(--color-background); border-radius: var(--radius-lg); padding: 2rem; margin-top: 3rem; border: 4px solid var(--color-primary);">
                        <h3 style="margin-bottom: 1.5rem; color: var(--color-primary);">Details zur Behandlung</h3>
                        
                        <div style="display: grid; gap: 1rem;">
                            <?php if ($duration) : ?>
                                <div style="display: flex; gap: 1rem; align-items: start;">
                                    <span style="font-size: 1.5rem;"><i class="fa-solid fa-stopwatch"></i></span>
                                    <div>
                                        <strong>Behandlungsdauer:</strong><br>
                                        <?php echo esc_html($duration); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($price) : ?>
                                <div style="display: flex; gap: 1rem; align-items: start;">
                                    <span style="font-size: 1.5rem;"><i class="fa-solid fa-tag"></i></span>
                                    <div>
                                        <strong>Kosten:</strong><br>
                                        <?php echo esc_html($price); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div style="display: flex; gap: 1rem; align-items: start;">
                                <span style="font-size: 1.5rem;"><i class="fa-solid fa-clipboard"></i></span>
                                <div>
                                    <strong>Verordnung:</strong><br>
                                    Auf ärztliche Verordnung oder als Privatleistung
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 1rem; align-items: start;">
                                <span style="font-size: 1.5rem;"><i class="fa-solid fa-clipboard"></i></span>
                                <div>
                                    <strong>Durchführung:</strong><br>
                                    Von unseren qualifizierten Therapeuten
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Box -->
                    <div style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%); border-radius: var(--radius-lg); padding: 3rem; margin-top: 3rem; text-align: center; color: white;">
                        <h3 style="color: white; margin-bottom: 1rem;">Interessiert an dieser Behandlung?</h3>
                        <p style="font-size: 1.1rem; margin-bottom: 2rem; opacity: 0.95;">
                            Vereinbaren Sie jetzt einen Termin für eine individuelle Beratung.
                        </p>
                        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                            <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="btn-secondary">
                                Termin vereinbaren
                            </a>
                            <a href="tel:<?php echo esc_attr(get_theme_mod('physio_phone', '')); ?>" class="btn-outline" style="background: transparent; color: white; border-color: white;">
                                Direkt anrufen
                            </a>
                        </div>
                    </div>

                    <!-- Navigation to other services -->
                    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid var(--color-border);">
                        <h3 style="margin-bottom: 1.5rem;">Weitere Leistungen</h3>
                        
                        <?php
                        // Get other services
                        $other_services = new WP_Query(array(
                            'post_type'      => 'service',
                            'posts_per_page' => 3,
                            'post__not_in'   => array(get_the_ID()),
                            'orderby'        => 'rand',
                        ));
                        
                        if ($other_services->have_posts()) :
                            ?>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                                <?php
                                while ($other_services->have_posts()) : $other_services->the_post();
                                    $other_icon = get_post_meta(get_the_ID(), '_service_icon', true);
                                    ?>
                                    <a href="<?php the_permalink(); ?>" style="display: block; padding: 1.5rem; background: var(--color-background); border-radius: var(--radius-md); transition: all 0.3s ease; text-decoration: none; color: inherit;">
                                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">
                                            <?php
                                            if ($other_icon) {
                                                // Erlaubt HTML für Font Awesome Icons
                                                $allowed_html = array(
                                                    'i' => array('class' => array(), 'aria-hidden' => array()),
                                                    'span' => array('class' => array()),
                                                );
                                                echo wp_kses($other_icon, $allowed_html);
                                            } else {
                                                echo '🏥';
                                            }
                                            ?>
                                        </div>
                                        <h4 style="margin-bottom: 0.5rem; color: var(--color-primary);">
                                            <?php the_title(); ?>
                                        </h4>
                                        <p style="font-size: 0.9rem; color: var(--color-text-light); margin: 0;">
                                            <?php echo wp_trim_words(get_the_excerpt(), 12); ?>
                                        </p>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                            <?php
                            wp_reset_postdata();
                        endif;
                        ?>
                        
                        <div style="text-align: center; margin-top: 2rem;">
                            <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="btn-primary">
                                Alle Leistungen ansehen
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </article>

    <?php endwhile; ?>

</main>

<?php
get_footer();
