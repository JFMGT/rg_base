<?php
/**
 * SEO Functions - Schema.org Markup & Meta Tags
 *
 * @package PhysioTherapy_Pro
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Schema.org JSON-LD for Service Post Type
 */
function physio_add_service_schema() {
    if (!is_singular('service')) {
        return;
    }

    $post_id = get_the_ID();
    $duration = get_post_meta($post_id, '_service_duration', true);
    $price = get_post_meta($post_id, '_service_price', true);

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'MedicalProcedure',
        'name' => get_the_title(),
        'description' => get_the_excerpt() ?: wp_trim_words(get_the_content(), 30),
        'url' => get_permalink(),
    );

    if (has_post_thumbnail()) {
        $schema['image'] = get_the_post_thumbnail_url($post_id, 'full');
    }

    if ($duration) {
        $schema['procedureType'] = $duration;
    }

    // Provider Organization
    $schema['provider'] = array(
        '@type' => 'MedicalOrganization',
        'name' => get_bloginfo('name'),
        'url' => home_url(),
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'physio_add_service_schema');

/**
 * Add Schema.org JSON-LD for Team Member
 */
function physio_add_team_schema() {
    if (!is_singular('team')) {
        return;
    }

    $post_id = get_the_ID();
    $position = get_post_meta($post_id, '_team_position', true);
    $qualifications = get_post_meta($post_id, '_team_qualifications', true);
    $email = get_post_meta($post_id, '_team_email', true);
    $phone = get_post_meta($post_id, '_team_phone', true);

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => get_the_title(),
        'description' => get_the_excerpt() ?: wp_trim_words(get_the_content(), 30),
        'url' => get_permalink(),
    );

    if (has_post_thumbnail()) {
        $schema['image'] = get_the_post_thumbnail_url($post_id, 'full');
    }

    if ($position) {
        $schema['jobTitle'] = $position;
    }

    if ($qualifications) {
        $schema['award'] = $qualifications;
    }

    if ($email) {
        $schema['email'] = $email;
    }

    if ($phone) {
        $schema['telephone'] = $phone;
    }

    // Work Organization
    $schema['worksFor'] = array(
        '@type' => 'MedicalOrganization',
        'name' => get_bloginfo('name'),
        'url' => home_url(),
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'physio_add_team_schema');

/**
 * Add Schema.org JSON-LD for Organization (Homepage)
 */
function physio_add_organization_schema() {
    if (!is_front_page()) {
        return;
    }

    $phone = get_theme_mod('physio_phone', '');
    $email = get_theme_mod('physio_email', '');
    $address = get_theme_mod('physio_address', '');

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'MedicalBusiness',
        'name' => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'url' => home_url(),
    );

    if (has_custom_logo()) {
        $logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($logo_id, 'full');
        if ($logo) {
            $schema['logo'] = $logo[0];
        }
    }

    if ($phone) {
        $schema['telephone'] = $phone;
    }

    if ($email) {
        $schema['email'] = $email;
    }

    if ($address) {
        $schema['address'] = array(
            '@type' => 'PostalAddress',
            'streetAddress' => $address,
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'physio_add_organization_schema');

/**
 * Add Schema.org JSON-LD for Testimonials
 */
function physio_add_testimonial_schema() {
    if (!is_singular('testimonial')) {
        return;
    }

    $post_id = get_the_ID();
    $author = get_post_meta($post_id, '_testimonial_author', true);
    $rating = get_post_meta($post_id, '_testimonial_rating', true);

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Review',
        'reviewBody' => get_the_content(),
        'datePublished' => get_the_date('c'),
    );

    if ($author) {
        $schema['author'] = array(
            '@type' => 'Person',
            'name' => $author,
        );
    }

    if ($rating) {
        $schema['reviewRating'] = array(
            '@type' => 'Rating',
            'ratingValue' => $rating,
            'bestRating' => '5',
        );
    }

    $schema['itemReviewed'] = array(
        '@type' => 'MedicalBusiness',
        'name' => get_bloginfo('name'),
        'url' => home_url(),
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
}
add_action('wp_head', 'physio_add_testimonial_schema');

/**
 * Add Open Graph Meta Tags
 */
function physio_add_open_graph_tags() {
    if (is_singular()) {
        $post_id = get_the_ID();
        ?>
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>" />
        <meta property="og:description" content="<?php echo esc_attr(wp_trim_words(get_the_excerpt() ?: get_the_content(), 30)); ?>" />
        <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>" />
        <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
        <?php if (has_post_thumbnail()) : ?>
        <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'large')); ?>" />
        <?php endif; ?>
        <meta property="article:published_time" content="<?php echo esc_attr(get_the_date('c')); ?>" />
        <meta property="article:modified_time" content="<?php echo esc_attr(get_the_modified_date('c')); ?>" />
        <?php
    } else {
        ?>
        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
        <meta property="og:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
        <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>" />
        <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>" />
        <?php
    }

    // Twitter Card Tags
    ?>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo esc_attr(is_singular() ? get_the_title() : get_bloginfo('name')); ?>" />
    <meta name="twitter:description" content="<?php echo esc_attr(is_singular() ? wp_trim_words(get_the_excerpt() ?: get_the_content(), 30) : get_bloginfo('description')); ?>" />
    <?php if (is_singular() && has_post_thumbnail()) : ?>
    <meta name="twitter:image" content="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" />
    <?php endif;
}
add_action('wp_head', 'physio_add_open_graph_tags');

/**
 * Add Canonical URL
 */
function physio_add_canonical_url() {
    if (is_singular()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '" />' . "\n";
    } elseif (is_home() || is_front_page()) {
        echo '<link rel="canonical" href="' . esc_url(home_url('/')) . '" />' . "\n";
    } elseif (is_archive()) {
        echo '<link rel="canonical" href="' . esc_url(get_post_type_archive_link(get_post_type())) . '" />' . "\n";
    }
}
add_action('wp_head', 'physio_add_canonical_url');

/**
 * Generate Breadcrumbs
 */
function physio_breadcrumbs() {
    // Settings
    $separator = '<span class="breadcrumb-separator"> / </span>';
    $home_title = __('Home', 'physiotherapy-pro');

    // Don't display on homepage
    if (is_front_page()) {
        return;
    }

    echo '<nav class="breadcrumbs" aria-label="Breadcrumb">';
    echo '<ol class="breadcrumb-list">';

    // Home
    echo '<li class="breadcrumb-item"><a href="' . esc_url(home_url('/')) . '">' . esc_html($home_title) . '</a></li>';
    echo $separator;

    if (is_singular('service')) {
        echo '<li class="breadcrumb-item"><a href="' . esc_url(get_post_type_archive_link('service')) . '">' . __('Leistungen', 'physiotherapy-pro') . '</a></li>';
        echo $separator;
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_post_type_archive('service')) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . __('Leistungen', 'physiotherapy-pro') . '</li>';
    } elseif (is_singular('team')) {
        echo '<li class="breadcrumb-item">' . __('Team', 'physiotherapy-pro') . '</li>';
        echo $separator;
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_singular('post')) {
        $categories = get_the_category();
        if ($categories) {
            $category = $categories[0];
            echo '<li class="breadcrumb-item"><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a></li>';
            echo $separator;
        }
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_page()) {
        if (wp_get_post_parent_id(get_the_ID())) {
            $parent_id = wp_get_post_parent_id(get_the_ID());
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_post($parent_id);
                $breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb . $separator;
            }
        }
        echo '<li class="breadcrumb-item active" aria-current="page">' . get_the_title() . '</li>';
    } elseif (is_category()) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . single_cat_title('', false) . '</li>';
    } elseif (is_tag()) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . single_tag_title('', false) . '</li>';
    } elseif (is_search()) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . __('Suchergebnisse für: ', 'physiotherapy-pro') . get_search_query() . '</li>';
    } elseif (is_404()) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . __('Seite nicht gefunden', 'physiotherapy-pro') . '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}
