<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <?php
            // Footer Widget Areas
            for ($i = 1; $i <= 4; $i++) {
                if (is_active_sidebar('footer-' . $i)) {
                    dynamic_sidebar('footer-' . $i);
                }
            }
            
            // Default Footer Content if no widgets
            if (!is_active_sidebar('footer-1') && !is_active_sidebar('footer-2') && !is_active_sidebar('footer-3') && !is_active_sidebar('footer-4')) :
            ?>

                <div class="footer-widget">
                    <h3>Öffnungszeiten</h3>
                    <?php
                    $hours = get_theme_mod('physio_hours');
                    if ($hours) :
                        echo '<p>' . nl2br(esc_html($hours)) . '</p>';
                    else :
                        ?>
                        <p>
                            Mo-Fr: 8:00 - 18:00 Uhr<br>
                            Sa: 9:00 - 13:00 Uhr
                        </p>
                    <?php endif; ?>
                </div>    

               <div class="footer-widget">
                    <h3>Kontakt</h3>
                    <?php
                    $phone = get_theme_mod('physio_phone');
                    $email = get_theme_mod('physio_email');
                    $address = get_theme_mod('physio_address');
                    
                    if ($phone) :
                        echo '<p>Tel: <a href="tel:' . esc_attr($phone) . '">' . esc_html($phone) . '</a></p>';
                    endif;
                    
                    if ($email) :
                        echo '<p>E-Mail: <a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a></p>';
                    endif;
                    
                    if ($address) :
                        echo '<p>' . nl2br(esc_html($address)) . '</p>';
                    endif;
                    ?>
                </div>
                
                <div class="footer-widget">
                    <h3>Navigation</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </div>
                
                
                
                 <div class="footer-widget">
                </div>
            <?php endif; ?>
        </div>
        
        <div class="footer-bottom">
            <?php
            // Footer Logo - Check for footer-specific logo first, fallback to header logo
            $footer_logo = get_theme_mod('physio_footer_logo');
            $header_logo = get_theme_mod('custom_logo');
            $logo_to_use = $footer_logo ? $footer_logo : $header_logo;

            if ($logo_to_use) {
                $logo_url = wp_get_attachment_image_url($logo_to_use, 'medium');
                if ($logo_url) {
                    echo '<div class="footer-logo">';
                    echo '<a href="' . esc_url(home_url('/')) . '" rel="home">';
                    echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('name')) . '">';
                    echo '</a>';
                    echo '</div>';
                }
            }

            // Copyright Text with placeholder support
            $copyright = get_theme_mod('physio_copyright', sprintf(__('© %d %s. Alle Rechte vorbehalten.', 'physio-therapy-pro'), date('Y'), get_bloginfo('name')));

            // Replace placeholders
            $copyright = str_replace('{year}', date('Y'), $copyright);
            $copyright = str_replace('{site_name}', get_bloginfo('name'), $copyright);

            echo '<p class="footer-copyright">' . wp_kses_post($copyright) . '</p>';

            // Social Media Icons - Only show if enabled in Customizer
            if (get_theme_mod('physio_footer_social', true)) {
                physio_social_media_icons('footer-social');
            }
            ?>
            
            
            <?php if ( get_theme_mod('footer_social_enable', true) ) : ?>
  <?php $items = yourtheme_get_footer_social_repeater(); ?>
  <?php if (!empty($items)) : ?>
    <div class="footer-social">
      <?php foreach ($items as $it) :
        $is_external = (bool) preg_match('#^https?://#i', $it['url']);
      ?>
        <a class="social-link"
           href="<?php echo esc_url($it['url']); ?>"
           aria-label="<?php echo esc_attr($it['label']); ?>"
           <?php if ($is_external) : ?>target="_blank" rel="noopener noreferrer"<?php endif; ?>>
          <i class="<?php echo esc_attr($it['icon']); ?>" aria-hidden="true"></i>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
