<?php
/**
 * The sidebar containing the main widget area
 *
 * @package PhysioTherapy_Pro
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area" style="background: var(--color-white); border-radius: var(--radius-lg); padding: var(--spacing-lg); box-shadow: var(--shadow-sm);">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>
