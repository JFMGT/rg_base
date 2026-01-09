<?php
/**
 * The front page template file
 *
 * @package PhysioTherapy_Pro
 */

get_header();
?>

<main id="main" class="site-main">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Ihre Gesundheit in besten Händen</h1>
                <p>Professionelle Physiotherapie mit individueller Betreuung. Wir helfen Ihnen dabei, Ihre Beweglichkeit zurückzugewinnen und Schmerzen zu lindern.</p>
                <div class="hero-buttons">
                    <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="btn-primary">Termin vereinbaren</a>
                    <a href="<?php echo esc_url(home_url('/leistungen')); ?>" class="btn-outline" style="background: transparent; color: white; border-color: white;">Unsere Leistungen</a>
                </div>
            </div>
        </div>
        <div class="hero-image" style="background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 800%22><rect fill=%22%232D7D8E%22 width=%221200%22 height=%22800%22/><circle cx=%22600%22 cy=%22400%22 r=%22300%22 fill=%22%234DA3B5%22 opacity=%220.3%22/></svg>') center/cover;"></div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Unsere Leistungen</span>
                <h2>Individuelle Therapieangebote</h2>
                <p>Wir bieten ein breites Spektrum an physiotherapeutischen Leistungen für Ihre individuellen Bedürfnisse.</p>
            </div>

            <div class="services-grid">
                <?php
                $services_args = array(
                    'post_type'      => 'service',
                    'posts_per_page' => 6,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                );
                
                $services_query = new WP_Query($services_args);
                
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
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <span class="section-subtitle">Über uns</span>
                    <h2>Kompetenz und Erfahrung für Ihre Gesundheit</h2>
                    <p>Seit über 15 Jahren sind wir Ihr Partner für professionelle Physiotherapie. Unser erfahrenes Team aus qualifizierten Therapeuten bietet Ihnen individuelle Behandlungen auf höchstem Niveau.</p>
                    <p>Mit modernster Ausstattung und kontinuierlicher Weiterbildung garantieren wir Ihnen eine optimale Betreuung auf dem neuesten Stand der Wissenschaft.</p>
                    
                    <ul class="about-features">
                        <li>Über 15 Jahre Erfahrung</li>
                        <li>Hochqualifiziertes Therapeuten-Team</li>
                        <li>Moderne Behandlungsmethoden</li>
                        <li>Individuelle Therapiepläne</li>
                        <li>Zentrale Lage mit guter Erreichbarkeit</li>
                    </ul>
                    
                    <a href="<?php echo esc_url(home_url('/ueber-uns')); ?>" class="btn-primary">Mehr über uns</a>
                </div>
                <div class="about-image">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 600 700'%3E%3Crect fill='%232D7D8E' width='600' height='700'/%3E%3Ccircle cx='300' cy='350' r='200' fill='%234DA3B5' opacity='0.5'/%3E%3Ctext x='300' y='360' font-size='60' fill='white' text-anchor='middle' font-family='Arial'%3EÜber uns%3C/text%3E%3C/svg%3E" alt="Über uns" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Unser Team</span>
                <h2>Lernen Sie uns kennen</h2>
                <p>Unser engagiertes Team aus erfahrenen Physiotherapeuten freut sich darauf, Sie zu betreuen.</p>
            </div>

            <div class="team-grid">
                <?php
                $team_args = array(
                    'post_type'      => 'team',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                );
                
                $team_query = new WP_Query($team_args);
                
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
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Bewertungen</span>
                <h2>Das sagen unsere Patienten</h2>
            </div>

            <div class="testimonials-grid">
                <?php
                $testimonial_args = array(
                    'post_type'      => 'testimonial',
                    'posts_per_page' => 4,
                    'orderby'        => 'rand',
                );
                
                $testimonial_query = new WP_Query($testimonial_args);
                
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
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="hero-section" style="min-height: 400px;">
        <div class="container">
            <div class="hero-content" style="text-align: center; max-width: 800px; margin: 0 auto;">
                <h2 style="color: white;">Bereit für den ersten Schritt?</h2>
                <p style="font-size: 1.25rem;">Vereinbaren Sie noch heute einen Termin und starten Sie Ihren Weg zu mehr Beweglichkeit und Lebensqualität.</p>
                <div class="hero-buttons" style="justify-content: center;">
                    <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="btn-secondary">Jetzt Termin vereinbaren</a>
                    <a href="tel:<?php echo esc_attr(get_theme_mod('physio_phone', '')); ?>" class="btn-outline" style="background: transparent; color: white; border-color: white;">
                        📞 Anrufen
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
