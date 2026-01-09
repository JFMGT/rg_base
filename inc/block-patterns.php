<?php
/**
 * Block Patterns
 *
 * @package PhysioTherapy_Pro
 */

/**
 * Register Block Pattern Category
 */
function physio_register_block_pattern_category() {
    register_block_pattern_category(
        'physio-sections',
        array('label' => __('Physio Sektionen', 'physiotherapy-pro'))
    );
}
add_action('init', 'physio_register_block_pattern_category');

/**
 * Register Block Patterns
 */
function physio_register_block_patterns() {

    // Hero Section Pattern
    register_block_pattern(
        'physiotherapy-pro/hero-section',
        array(
            'title'       => __('Hero Sektion', 'physiotherapy-pro'),
            'description' => __('Große Hero-Sektion mit Überschrift, Text und Buttons', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"hero-section","layout":{"type":"constrained","contentSize":"600px"}} -->
<div class="wp-block-group hero-section">
    <!-- wp:heading {"textAlign":"left","level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} -->
    <h1 class="wp-block-heading has-text-align-left has-white-color has-text-color has-link-color">Ihre Gesundheit in besten Händen</h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"left","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"large"} -->
    <p class="has-text-align-left has-white-color has-text-color has-link-color has-large-font-size">Professionelle Physiotherapie mit individueller Betreuung. Wir helfen Ihnen dabei, Ihre Beweglichkeit zurückzugewinnen und Schmerzen zu lindern.</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"}} -->
    <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-primary"} -->
        <div class="wp-block-button is-style-primary"><a class="wp-block-button__link wp-element-button" href="/kontakt">Termin vereinbaren</a></div>
        <!-- /wp:button -->

        <!-- wp:button {"className":"is-style-outline"} -->
        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/leistungen">Unsere Leistungen</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
        )
    );

    // Services Section Pattern
    register_block_pattern(
        'physiotherapy-pro/services-section',
        array(
            'title'       => __('Leistungen Sektion', 'physiotherapy-pro'),
            'description' => __('Zeigt Services aus dem Custom Post Type an', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"services-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group services-section">
    <!-- wp:paragraph {"className":"section-subtitle","align":"center"} -->
    <p class="section-subtitle has-text-align-center">Unsere Leistungen</p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"level":2,"textAlign":"center"} -->
    <h2 class="wp-block-heading has-text-align-center">Individuelle Therapieangebote</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center">Wir bieten ein breites Spektrum an physiotherapeutischen Leistungen für Ihre individuellen Bedürfnisse.</p>
    <!-- /wp:paragraph -->

    <!-- wp:shortcode -->
    [physio_services limit="6"]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->',
        )
    );

    // About Section Pattern
    register_block_pattern(
        'physiotherapy-pro/about-section',
        array(
            'title'       => __('Über Uns Sektion', 'physiotherapy-pro'),
            'description' => __('Über uns Sektion mit Text und Features', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"about-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group about-section">
    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column {"width":"50%"} -->
        <div class="wp-block-column" style="flex-basis:50%">
            <!-- wp:paragraph {"className":"section-subtitle"} -->
            <p class="section-subtitle">Über uns</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading {"level":2} -->
            <h2 class="wp-block-heading">Kompetenz und Erfahrung für Ihre Gesundheit</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>Seit über 15 Jahren sind wir Ihr Partner für professionelle Physiotherapie. Unser erfahrenes Team aus qualifizierten Therapeuten bietet Ihnen individuelle Behandlungen auf höchstem Niveau.</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph -->
            <p>Mit modernster Ausstattung und kontinuierlicher Weiterbildung garantieren wir Ihnen eine optimale Betreuung auf dem neuesten Stand der Wissenschaft.</p>
            <!-- /wp:paragraph -->

            <!-- wp:list {"className":"about-features"} -->
            <ul class="about-features">
                <li>Über 15 Jahre Erfahrung</li>
                <li>Hochqualifiziertes Therapeuten-Team</li>
                <li>Moderne Behandlungsmethoden</li>
                <li>Individuelle Therapiepläne</li>
                <li>Zentrale Lage mit guter Erreichbarkeit</li>
            </ul>
            <!-- /wp:list -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"className":"is-style-primary"} -->
                <div class="wp-block-button is-style-primary"><a class="wp-block-button__link wp-element-button" href="/ueber-uns">Mehr über uns</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"width":"50%"} -->
        <div class="wp-block-column" style="flex-basis:50%">
            <!-- wp:image {"className":"about-image"} -->
            <figure class="wp-block-image about-image"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 600 700\'%3E%3Crect fill=\'%232D7D8E\' width=\'600\' height=\'700\'/%3E%3Ccircle cx=\'300\' cy=\'350\' r=\'200\' fill=\'%234DA3B5\' opacity=\'0.5\'/%3E%3Ctext x=\'300\' y=\'360\' font-size=\'60\' fill=\'white\' text-anchor=\'middle\' font-family=\'Arial\'%3EÜber uns%3C/text%3E%3C/svg%3E" alt="Über uns"/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->',
        )
    );

    // Team Section Pattern
    register_block_pattern(
        'physiotherapy-pro/team-section',
        array(
            'title'       => __('Team Sektion', 'physiotherapy-pro'),
            'description' => __('Zeigt Team-Mitglieder an', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"team-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group team-section">
    <!-- wp:paragraph {"className":"section-subtitle","align":"center"} -->
    <p class="section-subtitle has-text-align-center">Unser Team</p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"level":2,"textAlign":"center"} -->
    <h2 class="wp-block-heading has-text-align-center">Lernen Sie uns kennen</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center">Unser engagiertes Team aus erfahrenen Physiotherapeuten freut sich darauf, Sie zu betreuen.</p>
    <!-- /wp:paragraph -->

    <!-- wp:shortcode -->
    [physio_team]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->',
        )
    );

    // Testimonials Section Pattern
    register_block_pattern(
        'physiotherapy-pro/testimonials-section',
        array(
            'title'       => __('Bewertungen Sektion', 'physiotherapy-pro'),
            'description' => __('Zeigt Kundenbewertungen an', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"testimonials-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group testimonials-section">
    <!-- wp:paragraph {"className":"section-subtitle","align":"center"} -->
    <p class="section-subtitle has-text-align-center">Bewertungen</p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"level":2,"textAlign":"center"} -->
    <h2 class="wp-block-heading has-text-align-center">Das sagen unsere Patienten</h2>
    <!-- /wp:heading -->

    <!-- wp:shortcode -->
    [physio_testimonials limit="4"]
    <!-- /wp:shortcode -->
</div>
<!-- /wp:group -->',
        )
    );

    // CTA Section Pattern
    register_block_pattern(
        'physiotherapy-pro/cta-section',
        array(
            'title'       => __('Call-to-Action Sektion', 'physiotherapy-pro'),
            'description' => __('CTA-Sektion mit Kontakt-Aufforderung', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"cta-section","layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group cta-section">
    <!-- wp:heading {"textAlign":"center","level":2,"style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} -->
    <h2 class="wp-block-heading has-text-align-center has-white-color has-text-color has-link-color">Bereit für den ersten Schritt?</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white","fontSize":"large"} -->
    <p class="has-text-align-center has-white-color has-text-color has-link-color has-large-font-size">Vereinbaren Sie noch heute einen Termin und starten Sie Ihren Weg zu mehr Beweglichkeit und Lebensqualität.</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-secondary"} -->
        <div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button" href="/kontakt">Jetzt Termin vereinbaren</a></div>
        <!-- /wp:button -->

        <!-- wp:button {"className":"is-style-outline"} -->
        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="tel:">📞 Anrufen</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
        )
    );

    // Text + Bild Pattern (Text links, Bild rechts)
    register_block_pattern(
        'physiotherapy-pro/text-image-section',
        array(
            'title'       => __('Text + Bild', 'physiotherapy-pro'),
            'description' => __('Zweispaltig: Text links, Bild rechts', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"content-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group content-section">
    <!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">
        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:heading {"level":2} -->
            <h2 class="wp-block-heading">Überschrift hier</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>Fügen Sie hier Ihren Text ein. Sie können mehrere Absätze hinzufügen, um Ihre Inhalte ausführlich zu beschreiben.</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph -->
            <p>Weitere Informationen können hier ergänzt werden. Der Text passt sich automatisch an die Spaltenbreite an.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"className":"is-style-primary"} -->
                <div class="wp-block-button is-style-primary"><a class="wp-block-button__link wp-element-button">Mehr erfahren</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:image {"sizeSlug":"large","className":"content-image"} -->
            <figure class="wp-block-image size-large content-image"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 600 400\'%3E%3Crect fill=\'%23E5E7EB\' width=\'600\' height=\'400\'/%3E%3Ctext x=\'300\' y=\'200\' font-size=\'24\' fill=\'%238A8A8A\' text-anchor=\'middle\' font-family=\'Arial\'%3EBild hier einfügen%3C/text%3E%3C/svg%3E" alt=""/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->',
        )
    );

    // Bild + Text Pattern (Bild links, Text rechts)
    register_block_pattern(
        'physiotherapy-pro/image-text-section',
        array(
            'title'       => __('Bild + Text', 'physiotherapy-pro'),
            'description' => __('Zweispaltig: Bild links, Text rechts', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"content-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group content-section">
    <!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center">
        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:image {"sizeSlug":"large","className":"content-image"} -->
            <figure class="wp-block-image size-large content-image"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 600 400\'%3E%3Crect fill=\'%23E5E7EB\' width=\'600\' height=\'400\'/%3E%3Ctext x=\'300\' y=\'200\' font-size=\'24\' fill=\'%238A8A8A\' text-anchor=\'middle\' font-family=\'Arial\'%3EBild hier einfügen%3C/text%3E%3C/svg%3E" alt=""/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
            <!-- wp:heading {"level":2} -->
            <h2 class="wp-block-heading">Überschrift hier</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>Fügen Sie hier Ihren Text ein. Sie können mehrere Absätze hinzufügen, um Ihre Inhalte ausführlich zu beschreiben.</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph -->
            <p>Weitere Informationen können hier ergänzt werden. Der Text passt sich automatisch an die Spaltenbreite an.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"className":"is-style-primary"} -->
                <div class="wp-block-button is-style-primary"><a class="wp-block-button__link wp-element-button">Mehr erfahren</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->',
        )
    );

    // Nur Text Pattern
    register_block_pattern(
        'physiotherapy-pro/text-only-section',
        array(
            'title'       => __('Nur Text', 'physiotherapy-pro'),
            'description' => __('Einfache Textsektion mit Überschrift und Absätzen', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"content-section","layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group content-section">
    <!-- wp:heading {"level":2} -->
    <h2 class="wp-block-heading">Überschrift hier</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Fügen Sie hier Ihren Haupttext ein. Dieser Bereich eignet sich perfekt für längere Textabschnitte, Erklärungen oder Detailinformationen.</p>
    <!-- /wp:paragraph -->

    <!-- wp:paragraph -->
    <p>Sie können mehrere Absätze hinzufügen. Der Text ist auf eine angenehme Lesebreite begrenzt und zentriert dargestellt.</p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"level":3} -->
    <h3 class="wp-block-heading">Zwischenüberschrift</h3>
    <!-- /wp:heading -->

    <!-- wp:paragraph -->
    <p>Nutzen Sie Zwischenüberschriften, um Ihren Text zu strukturieren und die Lesbarkeit zu verbessern.</p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->',
        )
    );

    // Highlight Box Pattern
    register_block_pattern(
        'physiotherapy-pro/highlight-box',
        array(
            'title'       => __('Highlight Box', 'physiotherapy-pro'),
            'description' => __('Hervorgehobener Bereich für wichtige Informationen', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"highlight-box","layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group highlight-box">
    <!-- wp:heading {"level":3,"textAlign":"center"} -->
    <h3 class="wp-block-heading has-text-align-center">Wichtiger Hinweis</h3>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center">Dieser hervorgehobene Bereich eignet sich für wichtige Informationen, besondere Angebote oder Call-to-Actions.</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-primary"} -->
        <div class="wp-block-button is-style-primary"><a class="wp-block-button__link wp-element-button">Jetzt handeln</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
        )
    );

    // FAQ Section Pattern
    register_block_pattern(
        'physiotherapy-pro/faq-section',
        array(
            'title'       => __('FAQ Sektion', 'physiotherapy-pro'),
            'description' => __('Häufig gestellte Fragen mit Accordion-Funktion', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"faq-section","layout":{"type":"constrained","contentSize":"900px"}} -->
<div class="wp-block-group faq-section">
    <!-- wp:paragraph {"className":"section-subtitle","align":"center"} -->
    <p class="section-subtitle has-text-align-center">FAQ</p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"level":2,"textAlign":"center"} -->
    <h2 class="wp-block-heading has-text-align-center">Häufig gestellte Fragen</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center">Hier finden Sie Antworten auf die am häufigsten gestellten Fragen.</p>
    <!-- /wp:paragraph -->

    <!-- wp:group {"className":"faq-container"} -->
    <div class="wp-block-group faq-container">
        <!-- wp:group {"className":"faq-item"} -->
        <div class="wp-block-group faq-item">
            <!-- wp:heading {"level":3,"className":"faq-question"} -->
            <h3 class="wp-block-heading faq-question">Was kostet eine Behandlung?</h3>
            <!-- /wp:heading -->

            <!-- wp:group {"className":"faq-answer"} -->
            <div class="wp-block-group faq-answer">
                <!-- wp:paragraph -->
                <p>Die Kosten für eine physiotherapeutische Behandlung variieren je nach Art der Therapie. In der Regel werden die Kosten von Ihrer Krankenkasse übernommen, wenn Sie eine ärztliche Verordnung haben. Privatpatienten erhalten eine detaillierte Rechnung nach der Behandlung.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"faq-item"} -->
        <div class="wp-block-group faq-item">
            <!-- wp:heading {"level":3,"className":"faq-question"} -->
            <h3 class="wp-block-heading faq-question">Brauche ich eine Überweisung?</h3>
            <!-- /wp:heading -->

            <!-- wp:group {"className":"faq-answer"} -->
            <div class="wp-block-group faq-answer">
                <!-- wp:paragraph -->
                <p>Ja, für eine physiotherapeutische Behandlung benötigen Sie eine Verordnung (Rezept) von Ihrem Arzt. Diese können Sie bei Ihrem Hausarzt, Orthopäden oder anderen Fachärzten erhalten. Das Rezept ist in der Regel 28 Tage gültig.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"faq-item"} -->
        <div class="wp-block-group faq-item">
            <!-- wp:heading {"level":3,"className":"faq-question"} -->
            <h3 class="wp-block-heading faq-question">Wie lange dauert eine Behandlung?</h3>
            <!-- /wp:heading -->

            <!-- wp:group {"className":"faq-answer"} -->
            <div class="wp-block-group faq-answer">
                <!-- wp:paragraph -->
                <p>Die Dauer einer Behandlung hängt von der verordneten Therapieform ab. Eine typische physiotherapeutische Einzelbehandlung dauert zwischen 20 und 60 Minuten. Ihr Therapeut wird die genaue Dauer mit Ihnen beim ersten Termin besprechen.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"className":"faq-item"} -->
        <div class="wp-block-group faq-item">
            <!-- wp:heading {"level":3,"className":"faq-question"} -->
            <h3 class="wp-block-heading faq-question">Kann ich auch ohne Termin kommen?</h3>
            <!-- /wp:heading -->

            <!-- wp:group {"className":"faq-answer"} -->
            <div class="wp-block-group faq-answer">
                <!-- wp:paragraph -->
                <p>Nein, wir arbeiten ausschließlich mit Terminvergabe, um Ihnen eine optimale und individuelle Betreuung garantieren zu können. Bitte vereinbaren Sie einen Termin telefonisch oder über unser Online-Buchungssystem.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->',
        )
    );

    // Einzelnes FAQ Item Pattern
    register_block_pattern(
        'physiotherapy-pro/faq-item',
        array(
            'title'       => __('FAQ Element', 'physiotherapy-pro'),
            'description' => __('Einzelne FAQ-Frage zum Hinzufügen', 'physiotherapy-pro'),
            'categories'  => array('physio-sections'),
            'content'     => '<!-- wp:group {"className":"faq-item"} -->
<div class="wp-block-group faq-item">
    <!-- wp:heading {"level":3,"className":"faq-question"} -->
    <h3 class="wp-block-heading faq-question">Ihre Frage hier?</h3>
    <!-- /wp:heading -->

    <!-- wp:group {"className":"faq-answer"} -->
    <div class="wp-block-group faq-answer">
        <!-- wp:paragraph -->
        <p>Ihre Antwort hier. Sie können beliebige Blöcke hinzufügen: Text, Bilder, Listen, etc.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->',
        )
    );

    // Load Hero Patterns from /patterns/ directory
    $hero_pattern_files = glob(get_template_directory() . '/patterns/*.php');

    if ($hero_pattern_files) {
        foreach ($hero_pattern_files as $pattern_file) {
            $pattern_data = get_file_data($pattern_file, array(
                'title'       => 'Title',
                'slug'        => 'Slug',
                'description' => 'Description',
                'categories'  => 'Categories',
            ));

            if (!empty($pattern_data['slug'])) {
                // Start output buffering
                ob_start();
                include $pattern_file;
                $pattern_content = ob_get_clean();

                // Parse categories
                $categories = !empty($pattern_data['categories'])
                    ? array_map('trim', explode(',', $pattern_data['categories']))
                    : array('physio-sections');

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
}
add_action('init', 'physio_register_block_patterns');
