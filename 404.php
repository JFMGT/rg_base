<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package PhysioTherapy_Pro
 */

get_header();

// Check if a custom 404 page is selected in the Customizer
$custom_404_page_id = get_theme_mod('physio_404_page_id');

if ($custom_404_page_id && get_post_status($custom_404_page_id) === 'publish') {
    // Display the custom 404 page
    $custom_page = get_post($custom_404_page_id);
    ?>

    <main id="main" class="site-main">
        <article class="custom-404-page">
            <?php
            // Set up post data for the custom page
            setup_postdata($custom_page);

            // Display the page content
            echo apply_filters('the_content', $custom_page->post_content);

            // Reset post data
            wp_reset_postdata();
            ?>
        </article>
    </main>

    <?php
} else {
    // Display default 404 page
    ?>

    <main id="main" class="site-main">

        <section class="error-404 not-found" style="padding: 6rem 0; text-align: center;">
            <div class="container-narrow">
            
            <div style="font-size: 8rem; margin-bottom: 2rem; opacity: 0.3;">
                🔍
            </div>
            
            <h1 style="font-size: 4rem; color: var(--color-primary); margin-bottom: 1rem;">404</h1>
            <h2 style="margin-bottom: 1.5rem;">Seite nicht gefunden</h2>
            
            <p style="font-size: 1.2rem; color: var(--color-text-light); margin-bottom: 3rem;">
                Die gesuchte Seite existiert leider nicht. Möglicherweise wurde sie verschoben oder gelöscht.
            </p>

            <!-- Search Form -->
            <div style="max-width: 600px; margin: 0 auto 3rem;">
                <?php get_search_form(); ?>
            </div>

            <!-- Helpful Links -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 4rem;">
                
                <div style="padding: 2rem; background: var(--color-background); border-radius: var(--radius-lg);">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🏠</div>
                    <h3 style="margin-bottom: 1rem;">Zur Startseite</h3>
                    <p style="color: var(--color-text-light); margin-bottom: 1rem;">
                        Besuchen Sie unsere Startseite für einen Überblick über unsere Praxis.
                    </p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                        Startseite besuchen
                    </a>
                </div>

                <div style="padding: 2rem; background: var(--color-background); border-radius: var(--radius-lg);">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🏥</div>
                    <h3 style="margin-bottom: 1rem;">Unsere Leistungen</h3>
                    <p style="color: var(--color-text-light); margin-bottom: 1rem;">
                        Entdecken Sie unser umfangreiches Behandlungsangebot.
                    </p>
                    <a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>" class="btn-primary">
                        Leistungen ansehen
                    </a>
                </div>

                <div style="padding: 2rem; background: var(--color-background); border-radius: var(--radius-lg);">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📞</div>
                    <h3 style="margin-bottom: 1rem;">Kontakt</h3>
                    <p style="color: var(--color-text-light); margin-bottom: 1rem;">
                        Nehmen Sie direkt Kontakt mit uns auf.
                    </p>
                    <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="btn-primary">
                        Kontakt aufnehmen
                    </a>
                </div>

            </div>

        </div>
    </section>

    </main>

<?php
}
// End if/else for custom 404 page

get_footer();
