/**
 * Customizer Enhancements
 *
 * Font-Empfehlungen und Live-Vorschau
 */

(function($) {
    'use strict';

    // Font-Kombinationen - welche Body-Fonts passen zu welchen Heading-Fonts
    const fontPairings = {
        'Outfit': {
            recommended: 'Figtree',
            alternatives: ['Inter', 'Open Sans']
        },
        'Poppins': {
            recommended: 'Inter',
            alternatives: ['Open Sans', 'Lato']
        },
        'Montserrat': {
            recommended: 'Open Sans',
            alternatives: ['Lato', 'Source Sans Pro']
        },
        'Raleway': {
            recommended: 'Lato',
            alternatives: ['Source Sans Pro', 'Open Sans']
        },
        'Playfair Display': {
            recommended: 'Source Sans Pro',
            alternatives: ['Lato', 'Open Sans']
        }
    };

    // Warte bis Customizer geladen ist
    wp.customize.bind('ready', function() {

        // Heading Font Control
        const headingFontControl = wp.customize.control('master_heading_font');

        if (headingFontControl) {
            // Füge Empfehlung hinzu wenn Heading-Font geändert wird
            headingFontControl.container.find('select').on('change', function() {
                const selectedFont = $(this).val();
                updateFontRecommendation(selectedFont);
            });

            // Initiale Empfehlung anzeigen
            const currentHeadingFont = wp.customize('master_heading_font').get();
            updateFontRecommendation(currentHeadingFont);
        }
    });

    /**
     * Zeigt Font-Empfehlung an
     */
    function updateFontRecommendation(headingFont) {
        const pairing = fontPairings[headingFont];
        const headingControl = wp.customize.control('master_heading_font');

        // Entferne alte Empfehlung
        headingControl.container.find('.font-recommendation').remove();

        if (pairing) {
            const recommendationHTML = `
                <p class="font-recommendation" style="
                    margin-top: 8px;
                    padding: 8px 12px;
                    background: #e8f5e9;
                    border-left: 3px solid #4caf50;
                    font-size: 12px;
                    line-height: 1.5;
                    color: #2e7d32;
                ">
                    <strong>💡 Empfehlung:</strong> Passt gut zur Schrift <strong>${pairing.recommended}</strong>
                    <br>
                    <span style="color: #558b57;">Alternativen: ${pairing.alternatives.join(', ')}</span>
                </p>
            `;

            headingControl.container.find('select').after(recommendationHTML);
        }
    }

    // Live-Vorschau für Fonts (optional)
    wp.customize('master_heading_font', function(value) {
        value.bind(function(newval) {
            // Hier könnte Live-Preview implementiert werden
            console.log('Heading Font geändert zu:', newval);
        });
    });

    wp.customize('master_body_font', function(value) {
        value.bind(function(newval) {
            console.log('Body Font geändert zu:', newval);
        });
    });

})(jQuery);
