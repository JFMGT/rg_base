<?php
/**
 * Hero Block Template
 *
 * @package PhysioTherapy_Pro
 */

$heading = isset($block['data']['heading']) ? $block['data']['heading'] : 'Ihre Gesundheit in besten Händen';
$text = isset($block['data']['text']) ? $block['data']['text'] : 'Professionelle Physiotherapie mit individueller Betreuung. Wir helfen Ihnen dabei, Ihre Beweglichkeit zurückzugewinnen und Schmerzen zu lindern.';
$primary_button_text = isset($block['data']['primary_button_text']) ? $block['data']['primary_button_text'] : 'Termin vereinbaren';
$primary_button_url = isset($block['data']['primary_button_url']) ? $block['data']['primary_button_url'] : home_url('/kontakt');
$secondary_button_text = isset($block['data']['secondary_button_text']) ? $block['data']['secondary_button_text'] : 'Unsere Leistungen';
$secondary_button_url = isset($block['data']['secondary_button_url']) ? $block['data']['secondary_button_url'] : home_url('/leistungen');
?>

<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <InnerBlocks
                allowedBlocks="<?php echo esc_attr(wp_json_encode(array('core/heading', 'core/paragraph', 'core/buttons'))); ?>"
                template="<?php echo esc_attr(wp_json_encode(array(
                    array('core/heading', array(
                        'level' => 1,
                        'content' => $heading,
                        'textColor' => 'white',
                    )),
                    array('core/paragraph', array(
                        'content' => $text,
                        'fontSize' => 'large',
                    )),
                    array('core/buttons', array(), array(
                        array('core/button', array(
                            'text' => $primary_button_text,
                            'url' => $primary_button_url,
                            'className' => 'is-style-primary',
                        )),
                        array('core/button', array(
                            'text' => $secondary_button_text,
                            'url' => $secondary_button_url,
                            'className' => 'is-style-outline',
                        )),
                    )),
                ))); ?>"
            />
        </div>
    </div>
    <div class="hero-image" style="background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 800%22><rect fill=%22%232D7D8E%22 width=%221200%22 height=%22800%22/><circle cx=%22600%22 cy=%22400%22 r=%22300%22 fill=%22%234DA3B5%22 opacity=%220.3%22/></svg>') center/cover;"></div>
</section>
