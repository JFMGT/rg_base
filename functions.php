<?php
/**
 * PhysioTherapy Pro Theme Functions
 *
 * @package PhysioTherapy_Pro
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function physio_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('automatic-feed-links');
    add_theme_support('customize-selective-refresh-widgets');

    // Block Patterns Support
    add_theme_support('core-block-patterns');

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Hauptmenü', 'physio-therapy-pro'),
        'footer'  => __('Footer Menü', 'physio-therapy-pro'),
    ));
    
    // Add image sizes
    add_image_size('physio-hero', 1920, 800, true);
    add_image_size('physio-service', 600, 400, true);
    add_image_size('physio-team', 400, 500, true);
}
add_action('after_setup_theme', 'physio_theme_setup');

/**
 * Enqueue Scripts and Styles
 */
function physio_theme_scripts() {
    // Hole ausgewählte Fonts aus dem Customizer
    $heading_font = get_theme_mod('physio_heading_font', 'Outfit');
    $body_font = get_theme_mod('physio_body_font', 'Figtree');

    // Alle verfügbaren Fonts (mit eigenen CSS-Dateien)
    $fonts_with_files = array('Outfit', 'Figtree', 'Poppins', 'Montserrat', 'Raleway', 'Playfair Display', 'Inter', 'Open Sans', 'Lato', 'Source Sans Pro');

    // Sammle zu ladende Fonts (ohne Duplikate)
    $fonts_to_load = array_unique(array($heading_font, $body_font));

    // Lade nur die ausgewählten Fonts
    foreach ($fonts_to_load as $font) {
        if (in_array($font, $fonts_with_files)) {
            $font_slug = strtolower(str_replace(' ', '-', $font));
            $font_file = get_template_directory() . '/assets/fonts/' . $font_slug . '.css';

            // Prüfe ob CSS-Datei existiert
            if (file_exists($font_file)) {
                wp_enqueue_style(
                    'physio-font-' . $font_slug,
                    get_template_directory_uri() . '/assets/fonts/' . $font_slug . '.css',
                    array(),
                    wp_get_theme()->get('Version')
                );
            }
        }
    }

    // Font Awesome
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fontawesome/css/all.min.css', array(), '7.1');

    // Main Stylesheet
    wp_enqueue_style('physio-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Main JavaScript
    wp_enqueue_script('physio-script', get_template_directory_uri() . '/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Comment Reply
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'physio_theme_scripts');

/**
 * Register Widget Areas
 */
function physio_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'physio-therapy-pro'),
        'id'            => 'sidebar-1',
        'description'   => __('Haupt Sidebar Widget Bereich', 'physio-therapy-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Footer Widgets
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('Footer Widget %d', 'physio-therapy-pro'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(__('Footer Widget Bereich %d', 'physio-therapy-pro'), $i),
            'before_widget' => '<div class="footer-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'physio_theme_widgets_init');

/**
 * Custom Post Type: Services/Leistungen
 */
function physio_register_services_post_type() {
    $labels = array(
        'name'                  => _x('Leistungen', 'Post Type General Name', 'physio-therapy-pro'),
        'singular_name'         => _x('Leistung', 'Post Type Singular Name', 'physio-therapy-pro'),
        'menu_name'             => __('Leistungen', 'physio-therapy-pro'),
        'all_items'             => __('Alle Leistungen', 'physio-therapy-pro'),
        'add_new_item'          => __('Neue Leistung hinzufügen', 'physio-therapy-pro'),
        'add_new'               => __('Neu hinzufügen', 'physio-therapy-pro'),
        'edit_item'             => __('Leistung bearbeiten', 'physio-therapy-pro'),
        'update_item'           => __('Leistung aktualisieren', 'physio-therapy-pro'),
        'view_item'             => __('Leistung ansehen', 'physio-therapy-pro'),
        'search_items'          => __('Leistung suchen', 'physio-therapy-pro'),
    );
    
    $args = array(
        'label'                 => __('Leistung', 'physio-therapy-pro'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-heart',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'leistungen'),
    );
    
    register_post_type('service', $args);
}
add_action('init', 'physio_register_services_post_type');

/**
 * Custom Post Type: Team Members
 */
function physio_register_team_post_type() {
    $labels = array(
        'name'                  => _x('Team', 'Post Type General Name', 'physio-therapy-pro'),
        'singular_name'         => _x('Teammitglied', 'Post Type Singular Name', 'physio-therapy-pro'),
        'menu_name'             => __('Team', 'physio-therapy-pro'),
        'all_items'             => __('Alle Teammitglieder', 'physio-therapy-pro'),
        'add_new_item'          => __('Neues Teammitglied hinzufügen', 'physio-therapy-pro'),
        'add_new'               => __('Neu hinzufügen', 'physio-therapy-pro'),
        'edit_item'             => __('Teammitglied bearbeiten', 'physio-therapy-pro'),
        'update_item'           => __('Teammitglied aktualisieren', 'physio-therapy-pro'),
        'view_item'             => __('Teammitglied ansehen', 'physio-therapy-pro'),
        'search_items'          => __('Teammitglied suchen', 'physio-therapy-pro'),
    );
    
    $args = array(
        'label'                 => __('Teammitglied', 'physio-therapy-pro'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'rewrite'               => array('slug' => 'team'),
    );
    
    register_post_type('team', $args);
}
add_action('init', 'physio_register_team_post_type');

/**
 * Custom Post Type: Testimonials
 */
function physio_register_testimonials_post_type() {
    $labels = array(
        'name'                  => _x('Bewertungen', 'Post Type General Name', 'physio-therapy-pro'),
        'singular_name'         => _x('Bewertung', 'Post Type Singular Name', 'physio-therapy-pro'),
        'menu_name'             => __('Bewertungen', 'physio-therapy-pro'),
        'all_items'             => __('Alle Bewertungen', 'physio-therapy-pro'),
        'add_new_item'          => __('Neue Bewertung hinzufügen', 'physio-therapy-pro'),
        'add_new'               => __('Neu hinzufügen', 'physio-therapy-pro'),
        'edit_item'             => __('Bewertung bearbeiten', 'physio-therapy-pro'),
    );
    
    $args = array(
        'label'                 => __('Bewertung', 'physio-therapy-pro'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor'),
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-star-filled',
        'show_in_admin_bar'     => true,
        'can_export'            => true,
    );
    
    register_post_type('testimonial', $args);
}
add_action('init', 'physio_register_testimonials_post_type');

/**
 * Add Custom Meta Boxes
 */
function physio_add_meta_boxes() {
    // Team Member Meta Box
    add_meta_box(
        'team_member_details',
        __('Teammitglied Details', 'physio-therapy-pro'),
        'physio_team_member_meta_box_callback',
        'team',
        'normal',
        'high'
    );

    // Testimonial Meta Box
    add_meta_box(
        'testimonial_details',
        __('Bewertung Details', 'physio-therapy-pro'),
        'physio_testimonial_meta_box_callback',
        'testimonial',
        'normal',
        'high'
    );

    // Service Meta Box
    add_meta_box(
        'service_details',
        __('Leistung Details', 'physio-therapy-pro'),
        'physio_service_meta_box_callback',
        'service',
        'normal',
        'high'
    );

    // Page Options Meta Box
    add_meta_box(
        'page_options',
        __('Seiten-Optionen', 'physio-therapy-pro'),
        'physio_page_options_meta_box_callback',
        'page',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'physio_add_meta_boxes');

/**
 * Team Member Meta Box Callback
 */
function physio_team_member_meta_box_callback($post) {
    wp_nonce_field('physio_save_team_meta', 'physio_team_meta_nonce');
    
    $position = get_post_meta($post->ID, '_team_position', true);
    $qualifications = get_post_meta($post->ID, '_team_qualifications', true);
    $email = get_post_meta($post->ID, '_team_email', true);
    $phone = get_post_meta($post->ID, '_team_phone', true);
    ?>
    <p>
        <label for="team_position"><?php _e('Position/Rolle:', 'physio-therapy-pro'); ?></label><br>
        <input type="text" id="team_position" name="team_position" value="<?php echo esc_attr($position); ?>" class="widefat">
    </p>
    <p>
        <label for="team_qualifications"><?php _e('Qualifikationen:', 'physio-therapy-pro'); ?></label><br>
        <textarea id="team_qualifications" name="team_qualifications" class="widefat" rows="3"><?php echo esc_textarea($qualifications); ?></textarea>
    </p>
    <p>
        <label for="team_email"><?php _e('E-Mail:', 'physio-therapy-pro'); ?></label><br>
        <input type="email" id="team_email" name="team_email" value="<?php echo esc_attr($email); ?>" class="widefat">
    </p>
    <p>
        <label for="team_phone"><?php _e('Telefon:', 'physio-therapy-pro'); ?></label><br>
        <input type="tel" id="team_phone" name="team_phone" value="<?php echo esc_attr($phone); ?>" class="widefat">
    </p>
    <?php
}

/**
 * Testimonial Meta Box Callback
 */
function physio_testimonial_meta_box_callback($post) {
    wp_nonce_field('physio_save_testimonial_meta', 'physio_testimonial_meta_nonce');
    
    $author = get_post_meta($post->ID, '_testimonial_author', true);
    $role = get_post_meta($post->ID, '_testimonial_role', true);
    $rating = get_post_meta($post->ID, '_testimonial_rating', true);
    ?>
    <p>
        <label for="testimonial_author"><?php _e('Autor/Name:', 'physio-therapy-pro'); ?></label><br>
        <input type="text" id="testimonial_author" name="testimonial_author" value="<?php echo esc_attr($author); ?>" class="widefat">
    </p>
    <p>
        <label for="testimonial_role"><?php _e('Rolle/Details:', 'physio-therapy-pro'); ?></label><br>
        <input type="text" id="testimonial_role" name="testimonial_role" value="<?php echo esc_attr($role); ?>" class="widefat" placeholder="z.B. Patient seit 2023">
    </p>
    <p>
        <label for="testimonial_rating"><?php _e('Bewertung (1-5):', 'physio-therapy-pro'); ?></label><br>
        <select id="testimonial_rating" name="testimonial_rating" class="widefat">
            <option value="5" <?php selected($rating, '5'); ?>>5 Sterne</option>
            <option value="4" <?php selected($rating, '4'); ?>>4 Sterne</option>
            <option value="3" <?php selected($rating, '3'); ?>>3 Sterne</option>
            <option value="2" <?php selected($rating, '2'); ?>>2 Sterne</option>
            <option value="1" <?php selected($rating, '1'); ?>>1 Stern</option>
        </select>
    </p>
    <?php
}

/**
 * Service Meta Box Callback
 */
function physio_service_meta_box_callback($post) {
    wp_nonce_field('physio_save_service_meta', 'physio_service_meta_nonce');

    $icon = get_post_meta($post->ID, '_service_icon', true);
    $duration = get_post_meta($post->ID, '_service_duration', true);
    $price = get_post_meta($post->ID, '_service_price', true);
    ?>
    <p>
        <label for="service_icon"><?php _e('Icon (Emoji oder Font Awesome HTML):', 'physio-therapy-pro'); ?></label><br>
        <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr($icon); ?>" class="widefat" placeholder='<i class="fa-solid fa-heart"></i>'>
        <small style="color: #666;">
            Beispiele: 🏥 oder &lt;i class="fa-solid fa-heart"&gt;&lt;/i&gt;
            <a href="https://fontawesome.com/search?o=r&m=free" target="_blank">Font Awesome Icons</a>
        </small>
    </p>
    <p>
        <label for="service_duration"><?php _e('Dauer:', 'physio-therapy-pro'); ?></label><br>
        <input type="text" id="service_duration" name="service_duration" value="<?php echo esc_attr($duration); ?>" class="widefat" placeholder="z.B. 60 Minuten">
    </p>
    <p>
        <label for="service_price"><?php _e('Preis:', 'physio-therapy-pro'); ?></label><br>
        <input type="text" id="service_price" name="service_price" value="<?php echo esc_attr($price); ?>" class="widefat" placeholder="z.B. 80€">
    </p>
    <?php
}

/**
 * Page Options Meta Box Callback
 */
function physio_page_options_meta_box_callback($post) {
    wp_nonce_field('physio_save_page_options', 'physio_page_options_nonce');

    $hide_title = get_post_meta($post->ID, '_hide_page_title', true);
    ?>
    <p>
        <label for="hide_page_title">
            <input type="checkbox" id="hide_page_title" name="hide_page_title" value="1" <?php checked($hide_title, '1'); ?>>
            <?php _e('Seitentitel ausblenden', 'physio-therapy-pro'); ?>
        </label>
    </p>
    <?php
}

/**
 * Save Meta Box Data
 */
function physio_save_meta_boxes($post_id) {
    // Team Member
    if (isset($_POST['physio_team_meta_nonce']) && wp_verify_nonce($_POST['physio_team_meta_nonce'], 'physio_save_team_meta')) {
        if (isset($_POST['team_position'])) {
            update_post_meta($post_id, '_team_position', sanitize_text_field($_POST['team_position']));
        }
        if (isset($_POST['team_qualifications'])) {
            update_post_meta($post_id, '_team_qualifications', sanitize_textarea_field($_POST['team_qualifications']));
        }
        if (isset($_POST['team_email'])) {
            update_post_meta($post_id, '_team_email', sanitize_email($_POST['team_email']));
        }
        if (isset($_POST['team_phone'])) {
            update_post_meta($post_id, '_team_phone', sanitize_text_field($_POST['team_phone']));
        }
    }

    // Testimonial
    if (isset($_POST['physio_testimonial_meta_nonce']) && wp_verify_nonce($_POST['physio_testimonial_meta_nonce'], 'physio_save_testimonial_meta')) {
        if (isset($_POST['testimonial_author'])) {
            update_post_meta($post_id, '_testimonial_author', sanitize_text_field($_POST['testimonial_author']));
        }
        if (isset($_POST['testimonial_role'])) {
            update_post_meta($post_id, '_testimonial_role', sanitize_text_field($_POST['testimonial_role']));
        }
        if (isset($_POST['testimonial_rating'])) {
            update_post_meta($post_id, '_testimonial_rating', sanitize_text_field($_POST['testimonial_rating']));
        }
    }

    // Service
    if (isset($_POST['physio_service_meta_nonce']) && wp_verify_nonce($_POST['physio_service_meta_nonce'], 'physio_save_service_meta')) {
        if (isset($_POST['service_icon'])) {
            // Erlaubt HTML für Font Awesome Icons, aber nur sichere Tags
            $allowed_html = array(
                'i' => array(
                    'class' => array(),
                    'aria-hidden' => array(),
                ),
                'span' => array(
                    'class' => array(),
                ),
            );
            update_post_meta($post_id, '_service_icon', wp_kses($_POST['service_icon'], $allowed_html));
        }
        if (isset($_POST['service_duration'])) {
            update_post_meta($post_id, '_service_duration', sanitize_text_field($_POST['service_duration']));
        }
        if (isset($_POST['service_price'])) {
            update_post_meta($post_id, '_service_price', sanitize_text_field($_POST['service_price']));
        }
    }

    // Page Options
    if (isset($_POST['physio_page_options_nonce']) && wp_verify_nonce($_POST['physio_page_options_nonce'], 'physio_save_page_options')) {
        if (isset($_POST['hide_page_title'])) {
            update_post_meta($post_id, '_hide_page_title', '1');
        } else {
            delete_post_meta($post_id, '_hide_page_title');
        }
    }
}
add_action('save_post', 'physio_save_meta_boxes');

/**
 * Theme Customizer
 */
function physio_customize_register($wp_customize) {
    
    // Colors Section
    $wp_customize->add_section('physio_colors', array(
        'title'    => __('Farben', 'physio-therapy-pro'),
        'priority' => 30,
    ));
    
    // Primary Color
    $wp_customize->add_setting('physio_primary_color', array(
        'default'           => '#1FA7A0',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'physio_primary_color', array(
        'label'    => __('Primärfarbe', 'physio-therapy-pro'),
        'section'  => 'physio_colors',
        'settings' => 'physio_primary_color',
    )));
    
    // Secondary Color
    $wp_customize->add_setting('physio_secondary_color', array(
        'default'           => '#8BC53F',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'physio_secondary_color', array(
        'label'    => __('Sekundärfarbe', 'physio-therapy-pro'),
        'section'  => 'physio_colors',
        'settings' => 'physio_secondary_color',
    )));
    
    // Text Color
    $wp_customize->add_setting('physio_text_color', array(
        'default'           => '#2C3E50',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'physio_text_color', array(
        'label'    => __('Textfarbe', 'physio-therapy-pro'),
        'section'  => 'physio_colors',
        'settings' => 'physio_text_color',
    )));
    
    // Background Color
    $wp_customize->add_setting('physio_background_color', array(
        'default'           => '#FAFBFC',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'physio_background_color', array(
        'label'    => __('Hintergrundfarbe', 'physio-therapy-pro'),
        'section'  => 'physio_colors',
        'settings' => 'physio_background_color',
    )));
    
    // Typography Section
    $wp_customize->add_section('physio_typography', array(
        'title'    => __('Typografie', 'physio-therapy-pro'),
        'priority' => 31,
    ));
    
    // Heading Font
    $wp_customize->add_setting('physio_heading_font', array(
        'default'           => 'Outfit',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('physio_heading_font', array(
        'label'    => __('Überschriften-Schriftart', 'physio-therapy-pro'),
        'section'  => 'physio_typography',
        'type'     => 'select',
        'choices'  => array(
            'Outfit'      => 'Outfit',
            'Poppins'     => 'Poppins',
            'Montserrat'  => 'Montserrat',
            'Raleway'     => 'Raleway',
            'Playfair Display' => 'Playfair Display',
        ),
    ));
    
    // Body Font
    $wp_customize->add_setting('physio_body_font', array(
        'default'           => 'Figtree',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('physio_body_font', array(
        'label'    => __('Fließtext-Schriftart', 'physio-therapy-pro'),
        'section'  => 'physio_typography',
        'type'     => 'select',
        'choices'  => array(
            'Figtree'     => 'Figtree',
            'Inter'       => 'Inter',
            'Open Sans'   => 'Open Sans',
            'Lato'        => 'Lato',
            'Source Sans Pro' => 'Source Sans Pro',
        ),
    ));
    
    // Contact Information Section
    $wp_customize->add_section('physio_contact_info', array(
        'title'    => __('Kontaktinformationen', 'physio-therapy-pro'),
        'priority' => 32,
    ));
    
    // Phone
    $wp_customize->add_setting('physio_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('physio_phone', array(
        'label'    => __('Telefonnummer', 'physio-therapy-pro'),
        'section'  => 'physio_contact_info',
        'type'     => 'text',
    ));
    
    // Email
    $wp_customize->add_setting('physio_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('physio_email', array(
        'label'    => __('E-Mail-Adresse', 'physio-therapy-pro'),
        'section'  => 'physio_contact_info',
        'type'     => 'email',
    ));
    
    // Address
    $wp_customize->add_setting('physio_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('physio_address', array(
        'label'    => __('Adresse', 'physio-therapy-pro'),
        'section'  => 'physio_contact_info',
        'type'     => 'textarea',
    ));
    
    // Opening Hours
    $wp_customize->add_setting('physio_hours', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('physio_hours', array(
        'label'    => __('Öffnungszeiten', 'physio-therapy-pro'),
        'section'  => 'physio_contact_info',
        'type'     => 'textarea',
    ));

    
    // Footer Section
    $wp_customize->add_section('physio_footer', array(
        'title'    => __('Footer Einstellungen', 'physio-therapy-pro'),
        'priority' => 34,
    ));

    // Copyright Text
    $wp_customize->add_setting('physio_copyright', array(
        'default'           => sprintf(__('© %d %s. Alle Rechte vorbehalten.', 'physio-therapy-pro'), date('Y'), get_bloginfo('name')),
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('physio_copyright', array(
        'label'       => __('Copyright Text', 'physio-therapy-pro'),
        'description' => __('HTML ist erlaubt. Verwenden Sie {year} für das aktuelle Jahr und {site} für den Seitennamen.', 'physio-therapy-pro'),
        'section'     => 'physio_footer',
        'type'        => 'textarea',
    ));

    // Footer Logo (zusätzlich zum Header Logo)
    $wp_customize->add_setting('physio_footer_logo', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'physio_footer_logo', array(
        'label'       => __('Footer Logo', 'physio-therapy-pro'),
        'description' => __('Optional: Separates Logo für den Footer. Falls leer, wird das Header-Logo verwendet.', 'physio-therapy-pro'),
        'section'     => 'physio_footer',
        'mime_type'   => 'image',
    )));

    // Show Social Media in Footer
    $wp_customize->add_setting('physio_footer_social', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('physio_footer_social', array(
        'label'    => __('Social Media Icons im Footer anzeigen', 'physio-therapy-pro'),
        'section'  => 'physio_footer',
        'type'     => 'checkbox',
    ));

    // 404 Page Section
    $wp_customize->add_section('physio_404_page', array(
        'title'       => __('404 Fehlerseite', 'physio-therapy-pro'),
        'description' => __('Wählen Sie eine Seite aus, die als 404-Fehlerseite angezeigt wird. Die Seite kann im Block-Editor frei gestaltet werden.', 'physio-therapy-pro'),
        'priority'    => 35,
    ));

    // 404 Page Dropdown
    $wp_customize->add_setting('physio_404_page_id', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('physio_404_page_id', array(
        'label'       => __('404-Seite auswählen', 'physio-therapy-pro'),
        'description' => __('Wählen Sie eine existierende Seite aus oder lassen Sie es leer für die Standard-404-Seite.', 'physio-therapy-pro'),
        'section'     => 'physio_404_page',
        'type'        => 'dropdown-pages',
    ));
}
add_action('customize_register', 'physio_customize_register');

/**
 * Enqueue Customizer Scripts
 */
function physio_customize_preview_js() {
    wp_enqueue_script(
        'physio-customizer',
        get_template_directory_uri() . '/js/customizer.js',
        array('jquery', 'customize-controls'),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('customize_controls_enqueue_scripts', 'physio_customize_preview_js');

/**
 * Display Social Media Icons
 *
 * @param string $class Optional CSS class for the container
 * @return void
 */
function physio_social_media_icons($class = 'footer-social') {
    $social_platforms = array(
        'facebook' => array(
            'url'   => get_theme_mod('physio_facebook'),
            'label' => __('Facebook', 'physio-therapy-pro'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        ),
        'instagram' => array(
            'url'   => get_theme_mod('physio_instagram'),
            'label' => __('Instagram', 'physio-therapy-pro'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
        ),
        'linkedin' => array(
            'url'   => get_theme_mod('physio_linkedin'),
            'label' => __('LinkedIn', 'physio-therapy-pro'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        ),
        'youtube' => array(
            'url'   => get_theme_mod('physio_youtube'),
            'label' => __('YouTube', 'physio-therapy-pro'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        ),
        'twitter' => array(
            'url'   => get_theme_mod('physio_twitter'),
            'label' => __('Twitter/X', 'physio-therapy-pro'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        ),
        'xing' => array(
            'url'   => get_theme_mod('physio_xing'),
            'label' => __('Xing', 'physio-therapy-pro'),
            'icon'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18.188 0c-.517 0-.741.325-.927.66 0 0-7.455 13.224-7.702 13.657.015.024 4.919 9.023 4.919 9.023.17.308.436.66.967.66h3.454c.211 0 .375-.078.463-.22.089-.151.089-.346-.009-.536l-4.879-8.916c-.004-.006-.004-.016 0-.022L22.139.756c.095-.191.097-.387.006-.535C22.056.078 21.894 0 21.686 0h-3.498zM3.648 4.74c-.211 0-.385.074-.473.216-.09.149-.078.339.02.531l2.34 4.05c.004.01.004.016 0 .021L1.86 16.051c-.099.188-.093.381 0 .529.085.142.239.234.45.234h3.461c.518 0 .766-.348.945-.667l3.734-6.609-2.378-4.155c-.172-.315-.434-.659-.962-.659H3.648v.016z"/></svg>',
        ),
    );

    // Check if any social media URL is set
    $has_social = false;
    foreach ($social_platforms as $platform) {
        if (!empty($platform['url'])) {
            $has_social = true;
            break;
        }
    }

    // Only output if at least one platform is set
    if (!$has_social) {
        return;
    }

    echo '<div class="' . esc_attr($class) . '">';

    foreach ($social_platforms as $slug => $platform) {
        if (!empty($platform['url'])) {
            printf(
                '<a href="%s" class="social-link social-link-%s" aria-label="%s" target="_blank" rel="noopener noreferrer">%s</a>',
                esc_url($platform['url']),
                esc_attr($slug),
                esc_attr($platform['label']),
                $platform['icon']
            );
        }
    }

    echo '</div>';
}

/**
 * Output Customizer CSS
 */
function physio_customizer_css() {
    $primary_color = get_theme_mod('physio_primary_color', '#1FA7A0');
    $secondary_color = get_theme_mod('physio_secondary_color', '#8BC53F');
    $text_color = get_theme_mod('physio_text_color', '#2C3E50');
    $background_color = get_theme_mod('physio_background_color', '#FAFBFC');
    $heading_font = get_theme_mod('physio_heading_font', 'Outfit');
    $body_font = get_theme_mod('physio_body_font', 'Figtree');

    // Font Stacks mit besseren Fallbacks
    $font_stacks = array(
        'Outfit' => "'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
        'Poppins' => "'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
        'Montserrat' => "'Montserrat', -apple-system, BlinkMacSystemFont, 'Helvetica Neue', sans-serif",
        'Raleway' => "'Raleway', -apple-system, BlinkMacSystemFont, 'Helvetica', sans-serif",
        'Playfair Display' => "'Playfair Display', Georgia, 'Times New Roman', serif",
        'Figtree' => "'Figtree', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
        'Inter' => "'Inter', -apple-system, BlinkMacSystemFont, 'SF Pro', 'Segoe UI', sans-serif",
        'Open Sans' => "'Open Sans', -apple-system, BlinkMacSystemFont, Arial, sans-serif",
        'Lato' => "'Lato', -apple-system, BlinkMacSystemFont, 'Helvetica Neue', sans-serif",
        'Source Sans Pro' => "'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
    );

    $heading_font_stack = isset($font_stacks[$heading_font]) ? $font_stacks[$heading_font] : $font_stacks['Outfit'];
    $body_font_stack = isset($font_stacks[$body_font]) ? $font_stacks[$body_font] : $font_stacks['Figtree'];

    ?>
    <style type="text/css">
        :root {
            --color-primary: <?php echo esc_attr($primary_color); ?>;
            --color-primary-dark: <?php echo esc_attr(physio_adjust_brightness($primary_color, -20)); ?>;
            --color-primary-light: <?php echo esc_attr(physio_adjust_brightness($primary_color, 20)); ?>;
            --color-secondary: <?php echo esc_attr($secondary_color); ?>;
            --color-secondary-dark: <?php echo esc_attr(physio_adjust_brightness($secondary_color, -20)); ?>;
            --color-secondary-light: <?php echo esc_attr(physio_adjust_brightness($secondary_color, 20)); ?>;
            --color-text: <?php echo esc_attr($text_color); ?>;
            --color-background: <?php echo esc_attr($background_color); ?>;
            --font-heading: <?php echo $heading_font_stack; ?>;
            --font-body: <?php echo $body_font_stack; ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'physio_customizer_css');

/**
 * Helper Function: Adjust Color Brightness
 */
function physio_adjust_brightness($hex, $steps) {
    $steps = max(-255, min(255, $steps));
    $hex = str_replace('#', '', $hex);
    
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }
    
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));
    
    return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT) . str_pad(dechex($g), 2, '0', STR_PAD_LEFT) . str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
}

/**
 * Custom Excerpt Length
 */
function physio_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'physio_excerpt_length');

/**
 * Custom Excerpt More
 */
function physio_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'physio_excerpt_more');

/**
 * Include Custom Functionality
 */
// Include Block Patterns
if (file_exists(get_template_directory() . '/inc/block-patterns.php')) {
    require_once get_template_directory() . '/inc/block-patterns.php';
}

// Include Shortcodes
if (file_exists(get_template_directory() . '/inc/shortcodes.php')) {
    require_once get_template_directory() . '/inc/shortcodes.php';
}

// Include SEO Functions
if (file_exists(get_template_directory() . '/inc/seo-functions.php')) {
    require_once get_template_directory() . '/inc/seo-functions.php';
}

// DEBUG: Temporär aktivieren um Patterns zu prüfen
// Kommentieren Sie die nächste Zeile aus, um zu testen:
// require_once get_template_directory() . '/debug-patterns.php';

/**
 * Enable Block Editor Support
 */
function physio_add_editor_support() {
    // Add support for Block Editor
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-styles');
    add_editor_style('style.css');

    // Add support for custom color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Primärfarbe', 'physiotherapy-pro'),
            'slug'  => 'primary',
            'color' => get_theme_mod('physio_primary_color', '#1FA7A0'),
        ),
        array(
            'name'  => __('Sekundärfarbe', 'physiotherapy-pro'),
            'slug'  => 'secondary',
            'color' => get_theme_mod('physio_secondary_color', '#8BC53F'),
        ),
        array(
            'name'  => __('Textfarbe', 'physiotherapy-pro'),
            'slug'  => 'text',
            'color' => get_theme_mod('physio_text_color', '#2C3E50'),
        ),
        array(
            'name'  => __('Weiß', 'physiotherapy-pro'),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
    ));
}
add_action('after_setup_theme', 'physio_add_editor_support');

/**
 * Register Custom Block Styles
 */
function physio_register_block_styles() {
    // Primary Button Style
    register_block_style('core/button', array(
        'name'  => 'primary',
        'label' => __('Primär', 'physiotherapy-pro'),
    ));

    // Secondary Button Style
    register_block_style('core/button', array(
        'name'  => 'secondary',
        'label' => __('Sekundär', 'physiotherapy-pro'),
    ));

    // Outline Button Style
    register_block_style('core/button', array(
        'name'  => 'outline',
        'label' => __('Umriss', 'physiotherapy-pro'),
    ));

    // Container Width Style for Group Block
    register_block_style('core/group', array(
        'name'  => 'container',
        'label' => __('Container (1200px)', 'physio-therapy-pro'),
    ));

    // Full Width Style for Group Block
    register_block_style('core/group', array(
        'name'  => 'full-width',
        'label' => __('Volle Breite', 'physio-therapy-pro'),
    ));

    // Container Width for Cover Block
    register_block_style('core/cover', array(
        'name'  => 'container',
        'label' => __('Container (1200px)', 'physio-therapy-pro'),
    ));
}
add_action('init', 'physio_register_block_styles');

/* ==========================================================================
   Performance Optimizations
   ========================================================================== */

/**
 * Add lazy loading to all images
 */
function physio_add_lazy_loading($content) {
    // Skip in admin
    if (is_admin()) {
        return $content;
    }

    // Add loading="lazy" to all img tags that don't already have it
    $content = preg_replace('/<img((?![^>]*loading=)[^>]*)>/i', '<img$1 loading="lazy">', $content);

    return $content;
}
add_filter('the_content', 'physio_add_lazy_loading', 20);
add_filter('post_thumbnail_html', 'physio_add_lazy_loading', 20);
add_filter('widget_text', 'physio_add_lazy_loading', 20);

/**
 * Add lazy loading to featured images
 */
function physio_lazy_load_featured_image($attr) {
    if (!is_admin()) {
        $attr['loading'] = 'lazy';
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'physio_lazy_load_featured_image', 10, 1);

/**
 * Enable WebP image support
 */
function physio_enable_webp_upload($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'physio_enable_webp_upload');

/**
 * Display WebP images with fallback
 */
function physio_webp_support($html, $post_id, $post_thumbnail_id) {
    // Get the image URL
    $image_url = wp_get_attachment_url($post_thumbnail_id);

    if (!$image_url) {
        return $html;
    }

    // Check if WebP version exists
    $webp_url = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $image_url);
    $webp_path = str_replace(wp_get_upload_dir()['baseurl'], wp_get_upload_dir()['basedir'], $webp_url);

    if (file_exists($webp_path)) {
        // Extract alt text and other attributes
        preg_match('/<img[^>]+alt="([^"]*)"/', $html, $alt_matches);
        preg_match('/<img[^>]+class="([^"]*)"/', $html, $class_matches);

        $alt = isset($alt_matches[1]) ? $alt_matches[1] : '';
        $class = isset($class_matches[1]) ? $class_matches[1] : '';

        // Create picture element with WebP and fallback
        $html = sprintf(
            '<picture><source srcset="%s" type="image/webp"><img src="%s" alt="%s" class="%s" loading="lazy"></picture>',
            esc_url($webp_url),
            esc_url($image_url),
            esc_attr($alt),
            esc_attr($class)
        );
    }

    return $html;
}
add_filter('post_thumbnail_html', 'physio_webp_support', 10, 3);

/**
 * Add browser caching headers
 */
function physio_add_caching_headers() {
    if (!is_admin()) {
        // Cache static assets for 1 year
        header('Cache-Control: public, max-age=31536000');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
    }
}

/**
 * Preload critical resources
 */
function physio_preload_resources() {
    // Preload fonts
    $heading_font = get_theme_mod('physio_heading_font', 'Outfit');
    $body_font = get_theme_mod('physio_body_font', 'Figtree');

    $fonts = array_unique(array($heading_font, $body_font));

    foreach ($fonts as $font) {
        $font_file = get_template_directory() . '/fonts/' . $font . '.woff2';
        if (file_exists($font_file)) {
            echo '<link rel="preload" href="' . esc_url(get_template_directory_uri() . '/fonts/' . $font . '.woff2') . '" as="font" type="font/woff2" crossorigin>';
        }
    }
}
add_action('wp_head', 'physio_preload_resources', 1);

/**
 * Defer non-critical scripts
 */
function physio_defer_scripts($tag, $handle, $src) {
    // List of scripts to defer
    $defer_scripts = array('jquery', 'physio-navigation', 'physio-customizer');

    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'physio_defer_scripts', 10, 3);

/* ==========================================================================
   Accessibility Enhancements
   ========================================================================== */

/**
 * Add skip link to header
 */
function physio_skip_link() {
    echo '<a class="skip-link screen-reader-text" href="#main">' . __('Zum Inhalt springen', 'physio-therapy-pro') . '</a>';
}
add_action('wp_body_open', 'physio_skip_link');

/**
 * Enhance nav menu accessibility
 */
function physio_nav_menu_args($args) {
    if (!isset($args['container_aria_label']) && isset($args['theme_location'])) {
        switch ($args['theme_location']) {
            case 'primary':
                $args['container_aria_label'] = __('Hauptnavigation', 'physio-therapy-pro');
                break;
            case 'footer':
                $args['container_aria_label'] = __('Footer Navigation', 'physio-therapy-pro');
                break;
        }
    }
    return $args;
}
add_filter('wp_nav_menu_args', 'physio_nav_menu_args');

/**
 * Add ARIA labels to widgets
 */
function physio_widget_aria_label($params) {
    global $wp_registered_widgets;

    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_name = $widget_obj['name'];

    // Add aria-label to widget wrapper
    if (isset($params[0]['before_widget'])) {
        $params[0]['before_widget'] = str_replace(
            'class="widget',
            'class="widget" aria-label="' . esc_attr($widget_name) . '"',
            $params[0]['before_widget']
        );
    }

    return $params;
}
add_filter('dynamic_sidebar_params', 'physio_widget_aria_label');

/**
 * Improve form accessibility
 */
function physio_accessible_search_form($form) {
    $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '" aria-label="' . __('Suchformular', 'physio-therapy-pro') . '">
        <label for="search-field" class="screen-reader-text">' . __('Suche nach:', 'physio-therapy-pro') . '</label>
        <input type="search" id="search-field" class="search-field" placeholder="' . esc_attr__('Suche...', 'physio-therapy-pro') . '" value="' . get_search_query() . '" name="s" required aria-required="true">
        <button type="submit" class="search-submit" aria-label="' . esc_attr__('Suche absenden', 'physio-therapy-pro') . '">
            <span class="screen-reader-text">' . __('Suchen', 'physio-therapy-pro') . '</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
        </button>
    </form>';

    return $form;
}
add_filter('get_search_form', 'physio_accessible_search_form');

/**
 * Add language attribute to HTML tag
 */
function physio_language_attributes($output) {
    return $output . ' lang="' . esc_attr(get_bloginfo('language')) . '"';
}
add_filter('language_attributes', 'physio_language_attributes');

/* ==========================================================================
   Blog Enhancements
   ========================================================================== */

/**
 * Calculate reading time for a post
 *
 * @param int $post_id Optional post ID. Defaults to current post.
 * @return int Reading time in minutes
 */
function physio_get_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute

    return max(1, $reading_time); // Minimum 1 minute
}

/**
 * Display reading time
 *
 * @param int $post_id Optional post ID
 * @return void
 */
function physio_reading_time($post_id = null) {
    $time = physio_get_reading_time($post_id);
    printf(
        '<span class="reading-time" aria-label="%s">⏱ %d %s</span>',
        esc_attr(sprintf(__('%d Minuten Lesezeit', 'physio-therapy-pro'), $time)),
        $time,
        _n('Min.', 'Min.', $time, 'physio-therapy-pro')
    );
}

/**
 * Get related posts based on categories and tags
 *
 * @param int $post_id Optional post ID
 * @param int $posts_per_page Number of related posts to retrieve
 * @return WP_Query|false
 */
function physio_get_related_posts($post_id = null, $posts_per_page = 3) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    // Get post categories and tags
    $categories = wp_get_post_categories($post_id);
    $tags = wp_get_post_tags($post_id, array('fields' => 'ids'));

    // Build query arguments
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $posts_per_page,
        'post__not_in'   => array($post_id),
        'orderby'        => 'rand',
        'tax_query'      => array(
            'relation' => 'OR',
        ),
    );

    // Add category query if available
    if (!empty($categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $categories,
        );
    }

    // Add tag query if available
    if (!empty($tags)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => $tags,
        );
    }

    // If no categories or tags, return false
    if (empty($categories) && empty($tags)) {
        return false;
    }

    $related_query = new WP_Query($args);

    return $related_query->have_posts() ? $related_query : false;
}

/**
 * Display related posts section
 *
 * @param int $post_id Optional post ID
 * @param int $posts_per_page Number of posts to display
 * @return void
 */
function physio_related_posts($post_id = null, $posts_per_page = 3) {
    $related_query = physio_get_related_posts($post_id, $posts_per_page);

    if (!$related_query) {
        return;
    }

    ?>
    <section class="related-posts">
        <div class="container-narrow">
            <h2 class="related-posts-title"><?php _e('Ähnliche Beiträge', 'physio-therapy-pro'); ?></h2>

            <div class="related-posts-grid">
                <?php
                while ($related_query->have_posts()) :
                    $related_query->the_post();
                    ?>
                    <article class="related-post-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="related-post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="related-post-content">
                            <div class="related-post-meta">
                                <span class="post-date"><?php echo get_the_date(); ?></span>
                                <?php if (physio_get_reading_time()) : ?>
                                    <span class="meta-separator">•</span>
                                    <?php physio_reading_time(); ?>
                                <?php endif; ?>
                            </div>

                            <h3 class="related-post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <div class="related-post-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="related-post-link">
                                <?php _e('Weiterlesen', 'physio-therapy-pro'); ?> →
                            </a>
                        </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <?php
}

/* ==========================================================================
   Admin Dashboard Enhancements
   ========================================================================== */

/**
 * Add custom dashboard widget for Praxis overview
 */
function physio_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'physio_praxis_overview',
        '🏥 Ihre Praxis auf einen Blick',
        'physio_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'physio_add_dashboard_widget');

/**
 * Dashboard widget content
 */
function physio_dashboard_widget_content() {
    // Get theme settings
    $phone = get_theme_mod('physio_phone');
    $email = get_theme_mod('physio_email');
    $address = get_theme_mod('physio_address');
    $hours = get_theme_mod('physio_hours');

    // Count content
    $services_count = wp_count_posts('service');
    $team_count = wp_count_posts('team');
    $pages_count = wp_count_posts('page');

    ?>
    <div class="physio-dashboard-widget">
        <style>
            .physio-dashboard-widget {
                font-size: 14px;
            }
            .physio-dashboard-section {
                margin-bottom: 20px;
                padding-bottom: 15px;
                border-bottom: 1px solid #ddd;
            }
            .physio-dashboard-section:last-child {
                border-bottom: none;
                margin-bottom: 0;
            }
            .physio-dashboard-section h4 {
                margin: 0 0 10px 0;
                font-size: 14px;
                font-weight: 600;
                color: #1FA7A0;
            }
            .physio-contact-info p {
                margin: 5px 0;
                color: #50575e;
            }
            .physio-quick-links {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                margin-top: 10px;
            }
            .physio-quick-link {
                display: flex;
                align-items: center;
                padding: 10px;
                background: #f6f7f7;
                border-radius: 4px;
                text-decoration: none;
                color: #2271b1;
                transition: all 0.2s;
                font-size: 13px;
            }
            .physio-quick-link:hover {
                background: #1FA7A0;
                color: white;
                transform: translateY(-2px);
            }
            .physio-quick-link span {
                margin-right: 8px;
                font-size: 16px;
            }
            .physio-stats {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
                margin-top: 10px;
            }
            .physio-stat {
                text-align: center;
                padding: 12px;
                background: #f6f7f7;
                border-radius: 4px;
            }
            .physio-stat-number {
                display: block;
                font-size: 24px;
                font-weight: 600;
                color: #1FA7A0;
                margin-bottom: 4px;
            }
            .physio-stat-label {
                display: block;
                font-size: 12px;
                color: #50575e;
            }
        </style>

        <!-- Contact Info -->
        <div class="physio-dashboard-section">
            <h4>📞 Kontaktinformationen</h4>
            <div class="physio-contact-info">
                <?php if ($phone) : ?>
                    <p><strong>Telefon:</strong> <?php echo esc_html($phone); ?></p>
                <?php endif; ?>
                <?php if ($email) : ?>
                    <p><strong>E-Mail:</strong> <?php echo esc_html($email); ?></p>
                <?php endif; ?>
                <?php if ($address) : ?>
                    <p><strong>Adresse:</strong> <?php echo nl2br(esc_html($address)); ?></p>
                <?php endif; ?>
                <?php if ($hours) : ?>
                    <p><strong>Öffnungszeiten:</strong><br><?php echo nl2br(esc_html($hours)); ?></p>
                <?php endif; ?>

                <?php if (!$phone && !$email && !$address) : ?>
                    <p style="color: #d63638;">
                        <em>Kontaktdaten noch nicht hinterlegt.</em><br>
                        <a href="<?php echo admin_url('customize.php'); ?>">Jetzt im Customizer eintragen →</a>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Stats -->
        <div class="physio-dashboard-section">
            <h4>📊 Inhalte im Überblick</h4>
            <div class="physio-stats">
                <div class="physio-stat">
                    <span class="physio-stat-number"><?php echo $services_count->publish; ?></span>
                    <span class="physio-stat-label">Leistungen</span>
                </div>
                <div class="physio-stat">
                    <span class="physio-stat-number"><?php echo $team_count->publish; ?></span>
                    <span class="physio-stat-label">Team-Mitglieder</span>
                </div>
                <div class="physio-stat">
                    <span class="physio-stat-number"><?php echo $pages_count->publish; ?></span>
                    <span class="physio-stat-label">Seiten</span>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="physio-dashboard-section">
            <h4>⚡ Schnellzugriff</h4>
            <div class="physio-quick-links">
                <a href="<?php echo admin_url('edit.php?post_type=service'); ?>" class="physio-quick-link">
                    <span>🏥</span> Leistungen
                </a>
                <a href="<?php echo admin_url('edit.php?post_type=team'); ?>" class="physio-quick-link">
                    <span>👥</span> Team
                </a>
                <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="physio-quick-link">
                    <span>📄</span> Seiten
                </a>
                <a href="<?php echo admin_url('customize.php'); ?>" class="physio-quick-link">
                    <span>🎨</span> Design
                </a>
                <a href="<?php echo admin_url('nav-menus.php'); ?>" class="physio-quick-link">
                    <span>📋</span> Menüs
                </a>
                <a href="<?php echo home_url('/'); ?>" class="physio-quick-link" target="_blank">
                    <span>🌐</span> Website ansehen
                </a>
            </div>
        </div>

        <!-- Help -->
        <div class="physio-dashboard-section" style="border-bottom: none;">
            <h4>💡 Häufige Aufgaben</h4>
            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                <li><strong>Neue Leistung hinzufügen:</strong> Leistungen → Neu hinzufügen</li>
                <li><strong>Team-Mitglied hinzufügen:</strong> Team → Neu hinzufügen</li>
                <li><strong>Kontaktdaten ändern:</strong> Design → Praxis-Informationen</li>
                <li><strong>Farben anpassen:</strong> Design → Farben</li>
            </ul>
        </div>
    </div>
    <?php
}

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {

    $wp_customize->add_section('footer_social_section', [
        'title'       => 'Social Media',
        'priority'    => 160,
        'description' => 'Füge Social-Links als Liste hinzu (Icon + URL).',
    ]);

    $wp_customize->add_setting('footer_social_enable', [
        'default'           => true,
        'sanitize_callback' => static function ($v) { return (bool) $v; },
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('footer_social_enable', [
        'type'    => 'checkbox',
        'section' => 'footer_social_section',
        'label'   => 'Social Icons im Footer anzeigen',
    ]);

    $wp_customize->add_setting('footer_social_links', [
        'default'           => '[]',
        'sanitize_callback' => 'yourtheme_sanitize_social_repeater_json',
        'transport'         => 'refresh',
    ]);

    if (!class_exists('YourTheme_Social_Repeater_Control')) {
        class YourTheme_Social_Repeater_Control extends WP_Customize_Control {
            public $type = 'yourtheme_social_repeater';
            public $platforms = [];

            public function enqueue() {
                wp_enqueue_script(
                    'yourtheme-social-repeater',
                    get_template_directory_uri() . '/assets/customizer/social-repeater.js',
                    ['jquery', 'customize-controls', 'underscore'],
                    '1.0.1',
                    true
                );

                wp_enqueue_style(
                    'yourtheme-social-repeater',
                    get_template_directory_uri() . '/assets/customizer/social-repeater.css',
                    [],
                    '1.0.1'
                );

                // Nur Plattformen an JS übergeben
                wp_localize_script('yourtheme-social-repeater', 'YourThemeSocialRepeater', [
                    'platforms' => $this->platforms,
                ]);
            }

            public function render_content() {
                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                    <?php if (!empty($this->description)) : ?>
                        <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                    <?php endif; ?>
                </label>

                <input type="hidden" <?php $this->link(); ?>
                       value="<?php echo esc_attr($this->value()); ?>"
                       class="yourtheme-social-repeater-input" />

                <div class="yourtheme-social-repeater" data-control-id="<?php echo esc_attr($this->id); ?>">
                    <div class="yourtheme-social-repeater-items"></div>

                    <button type="button" class="button yourtheme-social-repeater-add">
                        Eintrag hinzufügen
                    </button>
                </div>

                <!-- WP Template (nutzt print(), keine <#= ... #> Abhängigkeit) -->
                <script type="text/html" id="tmpl-yourtheme-social-repeater-item">
                    <div class="yourtheme-social-repeater-item">
                        <div class="yourtheme-social-repeater-row">
                            <label>
                                <span class="yourtheme-social-repeater-label">Icon</span>
                                <select class="yourtheme-social-repeater-platform">
                                    <# _.each(platforms, function(p){ #>
                                        <option value="<# print(p.key); #>"><# print(p.label); #></option>
                                    <# }); #>
                                </select>
                            </label>

                            <label class="yourtheme-social-repeater-url-wrap">
                                <span class="yourtheme-social-repeater-label">URL</span>
                                <input type="url" class="yourtheme-social-repeater-url" placeholder="https://…" />
                            </label>

                            <button type="button" class="button-link-delete yourtheme-social-repeater-remove">
                                Entfernen
                            </button>
                        </div>
                    </div>
                </script>
                <?php
            }
        }
    }

    $wp_customize->add_control(new YourTheme_Social_Repeater_Control($wp_customize, 'footer_social_links', [
        'section'     => 'footer_social_section',
        'label'       => 'Social Links (Repeater)',
        'description' => 'Pro Eintrag Icon wählen und URL eintragen. Leere URLs werden im Footer ignoriert.',
        'platforms'   => yourtheme_social_platforms(),
    ]));
});

function yourtheme_social_platforms(): array {
    return [
        ['key' => 'web',       'label' => 'Web (Globus)', 'icon' => 'fa-solid fa-globe'],
        ['key' => 'facebook',  'label' => 'Facebook',     'icon' => 'fa-brands fa-facebook-f'],
        ['key' => 'instagram', 'label' => 'Instagram',    'icon' => 'fa-brands fa-instagram'],
        ['key' => 'bluesky',   'label' => 'Bluesky',      'icon' => 'fa-brands fa-bluesky'], 
        ['key' => 'x',         'label' => 'X',            'icon' => 'fa-brands fa-x-twitter'],
        ['key' => 'linkedin',  'label' => 'LinkedIn',     'icon' => 'fa-brands fa-linkedin-in'],
        ['key' => 'youtube',   'label' => 'YouTube',      'icon' => 'fa-brands fa-youtube'],
        ['key' => 'tiktok',    'label' => 'TikTok',       'icon' => 'fa-brands fa-tiktok'],
        ['key' => 'pinterest', 'label' => 'Pinterest',    'icon' => 'fa-brands fa-pinterest-p'],
        ['key' => 'whatsapp',  'label' => 'WhatsApp',     'icon' => 'fa-brands fa-whatsapp'],
        ['key' => 'github',    'label' => 'GitHub',       'icon' => 'fa-brands fa-github'],
    ];
}

function yourtheme_sanitize_social_repeater_json($value): string {
    if (!is_string($value) || $value === '') return '[]';

    $decoded = json_decode(wp_unslash($value), true);
    if (!is_array($decoded)) return '[]';

    $allowed = array_map(static fn($p) => $p['key'], yourtheme_social_platforms());
    $clean = [];

    foreach ($decoded as $item) {
        if (!is_array($item)) continue;

        $platform = isset($item['platform']) ? sanitize_key($item['platform']) : 'web';
        if (!in_array($platform, $allowed, true)) $platform = 'web';

        $url = isset($item['url']) ? esc_url_raw(trim((string)$item['url'])) : '';

        $clean[] = [
            'platform' => $platform,
            'url'      => $url,
        ];
    }

    return wp_json_encode($clean);
}

function yourtheme_get_footer_social_repeater(): array {
    $json = (string) get_theme_mod('footer_social_links', '[]');
    $items = json_decode($json, true);
    if (!is_array($items)) return [];

    $map = [];
    foreach (yourtheme_social_platforms() as $p) $map[$p['key']] = $p;

    $out = [];
    foreach ($items as $item) {
        if (!is_array($item)) continue;

        $platform = isset($item['platform']) ? sanitize_key($item['platform']) : 'web';
        $url = isset($item['url']) ? trim((string)$item['url']) : '';

        if ($url === '') continue;

        $p = $map[$platform] ?? $map['web'];

        $out[] = [
            'label' => $p['label'] ?? 'Web',
            'icon'  => $p['icon'] ?? 'fa-solid fa-globe',
            'url'   => $url,
        ];
    }

    return $out;
}
