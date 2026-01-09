<?php
/**
 * Title: Hero zentriert
 * Slug: physio/hero-centered
 * Categories: featured, header
 * Description: Vollbreiter Hero mit Hintergrundbild, zentriertem Text und Buttons
 */
?>

<!-- wp:cover {"dimRatio":50,"overlayColor":"black","minHeight":600,"minHeightUnit":"px","isDark":true,"align":"full","className":"is-style-full-width","style":{"color":{"gradient":"linear-gradient(135deg,rgb(31,167,160) 0%,rgb(139,197,63) 100%)"}}} -->
<div class="wp-block-cover alignfull is-style-full-width is-dark" style="min-height:600px">
    <span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span>
    <div class="wp-block-cover__inner-container">

        <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group">

            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"3.5rem","fontWeight":"700"},"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
            <h1 class="wp-block-heading has-text-align-center" style="margin-bottom:1.5rem;font-size:3.5rem;font-weight:700">
                Willkommen in Ihrer Physiotherapie-Praxis
            </h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25rem"},"spacing":{"margin":{"bottom":"2rem"}}}} -->
            <p class="has-text-align-center" style="margin-bottom:2rem;font-size:1.25rem">
                Professionelle Behandlung für Ihr Wohlbefinden. Wir unterstützen Sie auf dem Weg zu mehr Gesundheit und Beweglichkeit.
            </p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"className":"is-style-primary"} -->
                <div class="wp-block-button is-style-primary">
                    <a class="wp-block-button__link wp-element-button">Termin vereinbaren</a>
                </div>
                <!-- /wp:button -->

                <!-- wp:button {"className":"is-style-outline"} -->
                <div class="wp-block-button is-style-outline">
                    <a class="wp-block-button__link wp-element-button">Unsere Leistungen</a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

        </div>
        <!-- /wp:group -->

    </div>
</div>
<!-- /wp:cover -->
