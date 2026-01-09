<?php
/**
 * Debug Script für Block Patterns
 *
 * Fügen Sie diese Zeile temporär in functions.php ein:
 * require_once get_template_directory() . '/debug-patterns.php';
 *
 * Dann rufen Sie Ihre WordPress-Seite auf und schauen Sie in den
 * HTML-Quellcode am Ende der Seite.
 */

add_action('wp_footer', 'physio_debug_patterns');
add_action('admin_footer', 'physio_debug_patterns');

function physio_debug_patterns() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
    $physio_patterns = array_filter($patterns, function($pattern) {
        return isset($pattern['categories']) && in_array('physio-sections', $pattern['categories']);
    });

    echo '<!-- DEBUG: Block Patterns -->';
    echo "\n<!-- Physio Patterns gefunden: " . count($physio_patterns) . " -->\n";

    foreach ($physio_patterns as $pattern) {
        echo "<!-- Pattern: " . $pattern['title'] . " -->\n";
    }

    echo '<!-- /DEBUG -->';
}
