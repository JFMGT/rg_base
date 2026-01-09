<?php
/**
 * Template for displaying search forms
 *
 * @package Master_Pro
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>" style="display: flex; gap: 0.5rem; max-width: 600px;">
    <label style="flex: 1; position: relative;">
        <span class="screen-reader-text"><?php echo _x('Suche nach:', 'label', 'master-therapy-pro'); ?></span>
        <input 
            type="search" 
            class="search-field" 
            placeholder="<?php echo esc_attr_x('Suchen...', 'placeholder', 'master-therapy-pro'); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s"
            style="width: 100%; padding: 0.75rem 1rem; border: 2px solid var(--color-border); border-radius: var(--radius-sm); font-size: 1rem; transition: border-color 0.15s ease;"
        />
    </label>
    <button 
        type="submit" 
        class="search-submit btn-primary"
        style="padding: 0.75rem 1.5rem; white-space: nowrap; border: none; cursor: pointer;"
    >
        🔍 <?php echo esc_attr_x('Suchen', 'submit button', 'master-therapy-pro'); ?>
    </button>
</form>
