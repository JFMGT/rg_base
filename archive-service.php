<?php
/**
 * The template for displaying service archive
 *
 * @package Master_Pro
 */

get_header();
?>

<main id="main" class="site-main">
    
    <div class="page-header" style="background: linear-gradient(135deg, rgb(31, 167, 160) 48%, rgb(139, 197, 63) 97%); padding: 3rem 0;">
        <div class="container">
            <h1 style="color: white; margin: 0;">Unsere Services</h1>
            <p style="margin-top: 1rem; font-size: 1.1rem;">
                Professionelle Dienstleistungen für Ihre Bedürfnisse
            </p>
        </div>
    </div>

    <section class="services-section">
        <div class="container">
            
            <?php if (have_posts()) : ?>
                
                <div class="services-grid">
                    <?php
                    while (have_posts()) :
                        the_post();
                        
                        $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                        $duration = get_post_meta(get_the_ID(), '_service_duration', true);
                        $price = get_post_meta(get_the_ID(), '_service_price', true);
                        ?>
                        
                        <div class="service-card">
                            <div class="service-icon">
                                <?php
                                if ($icon) {
                                    // Erlaubt HTML für Font Awesome Icons
                                    $allowed_html = array(
                                        'i' => array('class' => array(), 'aria-hidden' => array()),
                                        'span' => array('class' => array()),
                                    );
                                    echo wp_kses($icon, $allowed_html);
                                } else {
                                    echo '🛠️';
                                }
                                ?>
                            </div>

                            <h3><?php the_title(); ?></h3>
                            
                            <?php if (has_excerpt()) : ?>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                            <?php else : ?>
                                <p><?php echo wp_trim_words(get_the_content(), 25); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($duration || $price) : ?>
                                <div style="margin-bottom: 1rem; color: var(--color-text-light); font-size: 0.9rem;">
                                    <?php if ($duration) : ?>
                                        <span>⏱ <?php echo esc_html($duration); ?></span>
                                    <?php endif; ?>
                                    <?php if ($duration && $price) : ?>
                                        <span> • </span>
                                    <?php endif; ?>
                                    <?php if ($price) : ?>
                                        <span><?php echo esc_html($price); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" class="service-link">
                                Mehr erfahren →
                            </a>
                        </div>
                        
                    <?php endwhile; ?>
                </div>

                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('← Zurück', 'master-therapy-pro'),
                    'next_text' => __('Weiter →', 'master-therapy-pro'),
                ));
                ?>

            <?php else : ?>
                
                <div style="text-align: center; padding: 3rem 0;">
                    <p style="font-size: 1.25rem; color: var(--color-text-light);">
                        Keine Services gefunden.
                    </p>
                </div>

            <?php endif; ?>

        </div>
    </section>

    <!-- CTA Section -->
    <section class="hero-section" style="min-height: 300px;">
        <div class="container">
            <div class="hero-content" style="text-align: center; max-width: 800px; margin: 0 auto;">
                <h2 style="color: white;">Haben Sie Fragen zu unseren Services?</h2>
                <p style="font-size: 1.1rem;">Wir beraten Sie gerne persönlich und finden die passende Lösung für Sie.</p>
                <div class="hero-buttons" style="justify-content: center;">
                    <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="btn-secondary">Jetzt Kontakt aufnehmen</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
