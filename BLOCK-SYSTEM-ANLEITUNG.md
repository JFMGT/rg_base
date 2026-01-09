# Master Pro - Block Pattern System

## Übersicht

Master Pro ist ein flexibles WordPress Master-Theme mit einem integrierten Block Pattern System. Das Theme selbst enthält keine vordefinierten Block Patterns, sondern bietet die Infrastruktur für Child-Themes, um eigene Patterns zu registrieren.

## Block Pattern System

### Pattern-Registrierung für Child-Themes

Das Theme stellt ein automatisches Pattern-Ladesystem bereit. Child-Themes können eigene Block Patterns erstellen, indem sie einen `/patterns/` Ordner im Child-Theme anlegen.

### Eigene Patterns erstellen

1. Erstellen Sie einen `/patterns/` Ordner in Ihrem Child-Theme
2. Fügen Sie PHP-Dateien mit Pattern-Definitionen hinzu
3. Jede Pattern-Datei sollte folgende Header enthalten:

```php
<?php
/**
 * Title: Mein Custom Pattern
 * Slug: my-theme/custom-pattern
 * Description: Beschreibung des Patterns
 * Categories: master-sections
 */
?>

<!-- Pattern HTML Code hier -->
```

### Verfügbare Pattern-Kategorie

- **master-sections** - Standard-Kategorie für Theme-Sektionen

### Neue Kategorien hinzufügen

Child-Themes können eigene Pattern-Kategorien registrieren:

```php
function mytheme_register_block_pattern_category() {
    register_block_pattern_category(
        'mytheme-sections',
        array('label' => __('Meine Sektionen', 'my-textdomain'))
    );
}
add_action('init', 'mytheme_register_block_pattern_category');
```

## Dynamische Inhalte - Shortcodes

Das Theme bietet Shortcodes für die Anzeige von Custom Post Types:

### Services
```
[master_services limit="6"]
```
Zeigt Services aus dem Custom Post Type "Services" an.

### Team
```
[master_team limit="4"]
```
Zeigt Team-Mitglieder aus dem Custom Post Type "Team" an.

### Testimonials
```
[master_testimonials limit="4"]
```
Zeigt Testimonials aus dem Custom Post Type "Testimonials" an.

## Custom Post Types

Das Theme registriert folgende Custom Post Types:

### 1. Services
- **Admin:** WordPress Admin → Services → Neu hinzufügen
- **Meta-Felder:** Icon, Dauer, Preis
- **Verwendung:** Für Dienstleistungen und Angebote

### 2. Team
- **Admin:** WordPress Admin → Team → Neu hinzufügen
- **Meta-Felder:** Position, Qualifikationen, E-Mail, Telefon
- **Verwendung:** Für Team-Mitglieder

### 3. Testimonials
- **Admin:** WordPress Admin → Testimonials → Neu hinzufügen
- **Meta-Felder:** Autor, Rolle, Bewertung (1-5)
- **Verwendung:** Für Kundenbewertungen

## Template-Struktur

Das Theme bietet folgende Templates:

- `front-page.php` - Block-Editor-kompatible Startseite
- `page.php` - Standard-Seitentemplate
- `single.php` - Blog-Post Template
- `single-service.php` - Service Detail-Seite
- `archive-service.php` - Service-Übersicht
- `template-contact.php` - Kontakt-Seiten-Template

## Technische Details

### Pattern-Lademechanismus

Das Theme lädt automatisch Patterns aus:
1. `/patterns/` Ordner des Parent-Themes
2. `/patterns/` Ordner des Child-Themes (wenn vorhanden)

Die Patterns werden in der `init` Action Hook registriert und stehen im Block-Editor zur Verfügung.

### Code-Referenz

- `/inc/block-patterns.php` - Pattern-Registrierungssystem
- `/inc/shortcodes.php` - Shortcode-Definitionen
- `/inc/seo-functions.php` - SEO Schema-Markup

## Child-Theme Entwicklung

Master Pro ist als Basis für Child-Themes konzipiert. Alle Funktionen können in Child-Themes erweitert oder überschrieben werden:

```php
// functions.php im Child-Theme
function mytheme_setup() {
    // Eigene Funktionalität hier
}
add_action('after_setup_theme', 'mytheme_setup');
```

## Support & Dokumentation

- Theme folgt WordPress Best Practices
- Kompatibel mit WordPress 5.8+
- PHP 7.4+ erforderlich
- Block-Editor vollständig unterstützt

---

**Master Pro** - Flexible WordPress Master Theme Foundation
