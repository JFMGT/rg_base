<?php
/**
 * Shortcodes for Dynamic Content
 *
 * @package PhysioTherapy_Pro
 */

/**
 * Services Shortcode
 */
function physio_services_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 6,
    ), $atts);

    $services_args = array(
        'post_type'      => 'service',
        'posts_per_page' => intval($atts['limit']),
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );

    $services_query = new WP_Query($services_args);

    ob_start();
    ?>
    <div class="services-grid">
        <?php
        if ($services_query->have_posts()) :
            while ($services_query->have_posts()) : $services_query->the_post();
                $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                $duration = get_post_meta(get_the_ID(), '_service_duration', true);
                $price = get_post_meta(get_the_ID(), '_service_price', true);
                ?>
                <div class="service-card">
                    <div class="service-icon">
                        <?php
                        if ($icon) {
                            // Erlaubt HTML für Font Awesome Icons
                            $allowed_html = array(
                                'i' => array('class' => array(), 'aria-hidden' => array()),
                                'span' => array('class' => array()),
                            );
                            echo wp_kses($icon, $allowed_html);
                        } else {
                            echo '🏥';
                        }
                        ?>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <?php if ($duration || $price) : ?>
                        <div style="margin-bottom: 1rem; color: var(--color-text-light); font-size: 0.9rem;">
                            <?php if ($duration) : ?>
                                <span>⏱ <?php echo esc_html($duration); ?></span>
                            <?php endif; ?>
                            <?php if ($duration && $price) : ?>
                                <span> • </span>
                            <?php endif; ?>
                            <?php if ($price) : ?>
                                <span><?php echo esc_html($price); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" class="service-link">
                        Mehr erfahren →
                    </a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            // Default Services if none exist
            $default_services = array(
                array('icon' => '🏃', 'title' => 'Krankengymnastik', 'desc' => 'Gezielte Übungen zur Wiederherstellung und Verbesserung der Beweglichkeit und Kraft.'),
                array('icon' => '💆', 'title' => 'Manuelle Therapie', 'desc' => 'Behandlung von Funktionsstörungen des Bewegungsapparates mit speziellen Handgrifftechniken.'),
                array('icon' => '⚡', 'title' => 'Elektrotherapie', 'desc' => 'Schmerzlinderung und Heilungsförderung durch therapeutischen Einsatz von Strom.'),
                array('icon' => '🌊', 'title' => 'Lymphdrainage', 'desc' => 'Sanfte Massage zur Entstauung und Förderung des Lymphflusses.'),
                array('icon' => '🔥', 'title' => 'Wärmetherapie', 'desc' => 'Entspannung der Muskulatur und Verbesserung der Durchblutung durch Wärme.'),
                array('icon' => '🧘', 'title' => 'Prävention', 'desc' => 'Vorbeugende Maßnahmen zur Gesunderhaltung und Vermeidung von Beschwerden.'),
            );

            foreach ($default_services as $service) :
                ?>
                <div class="service-card">
                    <div class="service-icon"><?php echo $service['icon']; ?></div>
                    <h3><?php echo $service['title']; ?></h3>
                    <p><?php echo $service['desc']; ?></p>
                    <a href="<?php echo esc_url(home_url('/leistungen')); ?>" class="service-link">
                        Mehr erfahren →
                    </a>
                </div>
                <?php
            endforeach;
        endif;
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('physio_services', 'physio_services_shortcode');

/**
 * Team Shortcode
 */
function physio_team_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $team_args = array(
        'post_type'      => 'team',
        'posts_per_page' => intval($atts['limit']),
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );

    $team_query = new WP_Query($team_args);

    ob_start();
    ?>
    <div class="team-grid">
        <?php
        if ($team_query->have_posts()) :
            while ($team_query->have_posts()) : $team_query->the_post();
                $position = get_post_meta(get_the_ID(), '_team_position', true);
                ?>
                <div class="team-member">
                    <div class="team-member-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('physio-team'); ?>
                        <?php else : ?>
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 500'%3E%3Crect fill='%232D7D8E' width='400' height='500'/%3E%3Ccircle cx='200' cy='200' r='80' fill='white' opacity='0.3'/%3E%3Cpath d='M200 280 Q150 320 100 500 L300 500 Q250 320 200 280 Z' fill='white' opacity='0.3'/%3E%3C/svg%3E" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="team-member-info">
                        <h3 class="team-member-name"><?php the_title(); ?></h3>
                        <?php if ($position) : ?>
                            <p class="team-member-role"><?php echo esc_html($position); ?></p>
                        <?php endif; ?>
                        <div class="team-member-bio">
                            <?php echo wp_trim_words(get_the_content(), 20); ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            // Default Team Members
            $default_team = array(
                array('name' => 'Dr. Maria Schmidt', 'role' => 'Leitende Physiotherapeutin', 'initials' => 'MS'),
                array('name' => 'Thomas Müller', 'role' => 'Physiotherapeut', 'initials' => 'TM'),
                array('name' => 'Lisa Weber', 'role' => 'Physiotherapeutin', 'initials' => 'LW'),
                array('name' => 'Michael Fischer', 'role' => 'Physiotherapeut', 'initials' => 'MF'),
            );

            foreach ($default_team as $member) :
                ?>
                <div class="team-member">
                    <div class="team-member-image">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 500'%3E%3Crect fill='%232D7D8E' width='400' height='500'/%3E%3Ctext x='200' y='260' font-size='80' fill='white' text-anchor='middle' font-family='Arial' font-weight='bold'%3E<?php echo $member['initials']; ?>%3C/text%3E%3C/svg%3E" alt="<?php echo $member['name']; ?>">
                    </div>
                    <div class="team-member-info">
                        <h3 class="team-member-name"><?php echo $member['name']; ?></h3>
                        <p class="team-member-role"><?php echo $member['role']; ?></p>
                        <div class="team-member-bio">
                            Langjährige Erfahrung in der Physiotherapie mit Spezialisierung auf verschiedene Behandlungsmethoden.
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
        endif;
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('physio_team', 'physio_team_shortcode');

/**
 * Testimonials Shortcode
 */
function physio_testimonials_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 4,
    ), $atts);

    $testimonial_args = array(
        'post_type'      => 'testimonial',
        'posts_per_page' => intval($atts['limit']),
        'orderby'        => 'rand',
    );

    $testimonial_query = new WP_Query($testimonial_args);

    ob_start();
    ?>
    <div class="testimonials-grid">
        <?php
        if ($testimonial_query->have_posts()) :
            while ($testimonial_query->have_posts()) : $testimonial_query->the_post();
                $author = get_post_meta(get_the_ID(), '_testimonial_author', true);
                $role = get_post_meta(get_the_ID(), '_testimonial_role', true);
                $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                $initials = '';
                if ($author) {
                    $name_parts = explode(' ', $author);
                    $initials = strtoupper(substr($name_parts[0], 0, 1) . (isset($name_parts[1]) ? substr($name_parts[1], 0, 1) : ''));
                }
                ?>
                <div class="testimonial-card">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-text">
                        <?php the_content(); ?>
                    </div>
                    <?php if ($rating) : ?>
                        <div style="color: #FFB800; margin-bottom: 1rem;">
                            <?php echo str_repeat('★', intval($rating)); ?>
                        </div>
                    <?php endif; ?>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            <?php echo $initials ? $initials : '?'; ?>
                        </div>
                        <div>
                            <div class="testimonial-name"><?php echo $author ? esc_html($author) : 'Anonym'; ?></div>
                            <?php if ($role) : ?>
                                <div class="testimonial-details"><?php echo esc_html($role); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            // Default Testimonials
            $default_testimonials = array(
                array('text' => 'Hervorragende Behandlung! Nach meinem Bandscheibenvorfall wurde ich hier optimal betreut. Das Team ist sehr kompetent und einfühlsam.', 'author' => 'Michael K.', 'role' => 'Patient seit 2022'),
                array('text' => 'Endlich konnte ich meine Rückenschmerzen loswerden. Die Therapeuten nehmen sich Zeit und gehen individuell auf die Beschwerden ein.', 'author' => 'Sandra M.', 'role' => 'Patient seit 2021'),
                array('text' => 'Moderne Praxis mit tollem Team. Die Behandlungen sind sehr effektiv und ich fühle mich rundum gut aufgehoben.', 'author' => 'Thomas B.', 'role' => 'Patient seit 2023'),
            );

            foreach ($default_testimonials as $testimonial) :
                $name_parts = explode(' ', $testimonial['author']);
                $initials = strtoupper(substr($name_parts[0], 0, 1) . substr($name_parts[1], 0, 1));
                ?>
                <div class="testimonial-card">
                    <div class="testimonial-quote">"</div>
                    <div class="testimonial-text">
                        <?php echo esc_html($testimonial['text']); ?>
                    </div>
                    <div style="color: #FFB800; margin-bottom: 1rem;">★★★★★</div>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar"><?php echo $initials; ?></div>
                        <div>
                            <div class="testimonial-name"><?php echo esc_html($testimonial['author']); ?></div>
                            <div class="testimonial-details"><?php echo esc_html($testimonial['role']); ?></div>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
        endif;
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('physio_testimonials', 'physio_testimonials_shortcode');
