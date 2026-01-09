<?php
/**
 * Template Name: Kontakt
 * Template for displaying contact page
 *
 * @package PhysioTherapy_Pro
 */

get_header();
?>

<main id="main" class="site-main">
    
    <div class="page-header" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%); padding: 3rem 0;">
        <div class="container">
            <h1 style="color: white; margin: 0;">Kontakt</h1>
        </div>
    </div>

    <section class="contact-section">
        <div class="container">
            <div class="contact-container">
                
                <!-- Contact Information -->
                <div class="contact-info">
                    <h2 style="margin-bottom: 2rem;">Kontaktinformationen</h2>
                    
                    <?php
                    $phone = get_theme_mod('physio_phone');
                    $email = get_theme_mod('physio_email');
                    $address = get_theme_mod('physio_address');
                    $hours = get_theme_mod('physio_hours');
                    ?>
                    
                    <?php if ($address) : ?>
                        <div class="contact-item">
                            <div class="contact-icon">📍</div>
                            <div class="contact-details">
                                <h4>Adresse</h4>
                                <p><?php echo nl2br(esc_html($address)); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($phone) : ?>
                        <div class="contact-item">
                            <div class="contact-icon">📞</div>
                            <div class="contact-details">
                                <h4>Telefon</h4>
                                <p><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($email) : ?>
                        <div class="contact-item">
                            <div class="contact-icon">✉️</div>
                            <div class="contact-details">
                                <h4>E-Mail</h4>
                                <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($hours) : ?>
                        <div class="contact-item">
                            <div class="contact-icon">🕐</div>
                            <div class="contact-details">
                                <h4>Öffnungszeiten</h4>
                                <p><?php echo nl2br(esc_html($hours)); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!$address && !$phone && !$email && !$hours) : ?>
                        <div class="contact-item">
                            <div class="contact-icon">📍</div>
                            <div class="contact-details">
                                <h4>Adresse</h4>
                                <p>Musterstraße 123<br>12345 Musterstadt</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">📞</div>
                            <div class="contact-details">
                                <h4>Telefon</h4>
                                <p><a href="tel:+4912345678">+49 123 456 78</a></p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">✉️</div>
                            <div class="contact-details">
                                <h4>E-Mail</h4>
                                <p><a href="mailto:info@praxis.de">info@praxis.de</a></p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">🕐</div>
                            <div class="contact-details">
                                <h4>Öffnungszeiten</h4>
                                <p>Mo-Fr: 8:00 - 18:00 Uhr<br>Sa: 9:00 - 13:00 Uhr</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Contact Form -->
                <div class="contact-form">
                    <h2 style="margin-bottom: 1.5rem;">Nachricht senden</h2>
                    
                    <?php
                    // Check if Contact Form 7 plugin is active
                    if (shortcode_exists('contact-form-7')) {
                        echo do_shortcode('[contact-form-7 id="1"]');
                    } else {
                        // Default HTML form if no plugin
                        ?>
                        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                            <input type="hidden" name="action" value="contact_form_submission">
                            <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                            
                            <div class="form-group">
                                <label for="contact_name">Name *</label>
                                <input type="text" id="contact_name" name="contact_name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="contact_email">E-Mail *</label>
                                <input type="email" id="contact_email" name="contact_email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="contact_phone">Telefon</label>
                                <input type="tel" id="contact_phone" name="contact_phone">
                            </div>
                            
                            <div class="form-group">
                                <label for="contact_subject">Betreff</label>
                                <input type="text" id="contact_subject" name="contact_subject">
                            </div>
                            
                            <div class="form-group">
                                <label for="contact_message">Nachricht *</label>
                                <textarea id="contact_message" name="contact_message" required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label style="display: flex; align-items: start; gap: 0.5rem; cursor: pointer;">
                                    <input type="checkbox" required style="margin-top: 0.25rem;">
                                    <span style="font-size: 0.9rem;">Ich habe die Datenschutzerklärung zur Kenntnis genommen. *</span>
                                </label>
                            </div>
                            
                            <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">
                                Nachricht senden
                            </button>
                        </form>
                        
                        <p style="margin-top: 1rem; font-size: 0.9rem; color: var(--color-text-light);">
                            * Pflichtfelder
                        </p>
                        <?php
                    }
                    ?>
                </div>

            </div>
        </div>
    </section>

    <!-- Map Section (Optional) -->
    <section style="padding: 0; height: 400px; background: var(--color-border);">
        <!-- Platzhalter für Google Maps oder andere Karte -->
        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--color-primary-light) 0%, var(--color-primary) 100%);">
            <div style="text-align: center; color: white;">
                <p style="font-size: 1.5rem; margin-bottom: 0.5rem;">🗺️</p>
                <p>Hier könnte Ihre Google Maps Karte eingebunden werden</p>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
