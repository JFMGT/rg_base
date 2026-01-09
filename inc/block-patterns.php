<?php
/**
 * Block Patterns Registration System
 *
 * @package Master_Pro
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Block Pattern Category
 *
 * This function registers a custom block pattern category for the theme.
 * Child themes can override this or add additional categories.
 */
function master_register_block_pattern_category() {
    register_block_pattern_category(
        'master-sections',
        array('label' => __('Master Sections', 'master-pro'))
    );
}
add_action('init', 'master_register_block_pattern_category');

/**
 * Load Block Patterns from /patterns/ directory
 *
 * This function automatically loads block patterns from the theme's /patterns/ directory.
 * Child themes can add their own patterns by creating a /patterns/ directory with pattern files.
 *
 * Pattern files should include headers:
 * - Title: Pattern Title
 * - Slug: unique-pattern-slug
 * - Description: Pattern description
 * - Categories: master-sections, another-category
 */
function master_register_block_patterns() {
    // Load patterns from theme /patterns/ directory
    $pattern_files = glob(get_template_directory() . '/patterns/*.php');

    if ($pattern_files) {
        foreach ($pattern_files as $pattern_file) {
            $pattern_data = get_file_data($pattern_file, array(
                'title'       => 'Title',
                'slug'        => 'Slug',
                'description' => 'Description',
                'categories'  => 'Categories',
            ));

            if (!empty($pattern_data['slug'])) {
                // Start output buffering to capture pattern content
                ob_start();
                include $pattern_file;
                $pattern_content = ob_get_clean();

                // Parse categories
                $categories = !empty($pattern_data['categories'])
                    ? array_map('trim', explode(',', $pattern_data['categories']))
                    : array('master-sections');

                // Register the pattern
                register_block_pattern(
                    $pattern_data['slug'],
                    array(
                        'title'       => $pattern_data['title'] ?: basename($pattern_file, '.php'),
                        'description' => $pattern_data['description'],
                        'content'     => $pattern_content,
                        'categories'  => $categories,
                    )
                );
            }
        }
    }

    // Allow child themes to load their own patterns
    $child_pattern_files = glob(get_stylesheet_directory() . '/patterns/*.php');

    if ($child_pattern_files && get_template_directory() !== get_stylesheet_directory()) {
        foreach ($child_pattern_files as $pattern_file) {
            $pattern_data = get_file_data($pattern_file, array(
                'title'       => 'Title',
                'slug'        => 'Slug',
                'description' => 'Description',
                'categories'  => 'Categories',
            ));

            if (!empty($pattern_data['slug'])) {
                ob_start();
                include $pattern_file;
                $pattern_content = ob_get_clean();

                $categories = !empty($pattern_data['categories'])
                    ? array_map('trim', explode(',', $pattern_data['categories']))
                    : array('master-sections');

                register_block_pattern(
                    $pattern_data['slug'],
                    array(
                        'title'       => $pattern_data['title'] ?: basename($pattern_file, '.php'),
                        'description' => $pattern_data['description'],
                        'content'     => $pattern_content,
                        'categories'  => $categories,
                    )
                );
            }
        }
    }
}
add_action('init', 'master_register_block_patterns');
