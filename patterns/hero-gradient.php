<?php
/**
 * Title: Hero mit Gradient
 * Slug: physio/hero-gradient
 * Categories: featured, header
 * Description: Hero mit Hintergrundbild und Farbverlauf-Overlay
 */
?>

<!-- wp:cover {"dimRatio":40,"customOverlayColor":"#1FA7A0","minHeight":650,"minHeightUnit":"px","isDark":true,"align":"full","className":"is-style-full-width hero-gradient","style":{"color":{"gradient":"linear-gradient(135deg,rgb(31,167,160) 0%,rgb(139,197,63) 100%)"}}} -->
<div class="wp-block-cover alignfull is-style-full-width hero-gradient is-dark" style="min-height:650px">
    <span aria-hidden="true" class="wp-block-cover__background has-background-dim-40 has-background-dim has-background-gradient has-vivid-cyan-blue-to-vivid-purple-gradient-background"></span>
    <div class="wp-block-cover__inner-container">

        <!-- wp:group {"className":"is-style-container","layout":{"type":"constrained","contentSize":"900px"}} -->
        <div class="wp-block-group is-style-container">

            <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"4rem","fontWeight":"800","lineHeight":"1.2"},"spacing":{"margin":{"bottom":"1.5rem"}}}} -->
            <h1 class="wp-block-heading has-text-align-center" style="margin-bottom:1.5rem;font-size:4rem;font-weight:800;line-height:1.2">
                Moderne Physiotherapie für mehr Lebensqualität
            </h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25rem","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"2.5rem"}}}} -->
            <p class="has-text-align-center" style="margin-bottom:2.5rem;font-size:1.25rem;line-height:1.6">
                Vertrauen Sie auf über 15 Jahre Erfahrung in der Behandlung von Schmerzen und Bewegungseinschränkungen. Wir sind für Sie da.
            </p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"1rem"}}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill","style":{"border":{"radius":"50px"},"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2.5rem","right":"2.5rem"}}}} -->
                <div class="wp-block-button is-style-fill">
                    <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" style="border-radius:50px;padding-top:1rem;padding-right:2.5rem;padding-bottom:1rem;padding-left:2.5rem">
                        Online Termin buchen
                    </a>
                </div>
                <!-- /wp:button -->

                <!-- wp:button {"className":"is-style-outline","style":{"border":{"radius":"50px","width":"2px"},"spacing":{"padding":{"top":"1rem","bottom":"1rem","left":"2.5rem","right":"2.5rem"}}}} -->
                <div class="wp-block-button is-style-outline">
                    <a class="wp-block-button__link wp-element-button" style="border-width:2px;border-radius:50px;padding-top:1rem;padding-right:2.5rem;padding-bottom:1rem;padding-left:2.5rem">
                        Kontakt aufnehmen
                    </a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

        </div>
        <!-- /wp:group -->

    </div>
</div>
<!-- /wp:cover -->
