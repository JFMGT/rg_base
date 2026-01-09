# Anleitung: Verschiebbare Blöcke auf der Startseite

## Übersicht

Ihre Website wurde erfolgreich auf ein flexibles Block-System umgestellt. Sie können jetzt alle Sektionen auf der Startseite frei per Drag & Drop im WordPress-Editor anordnen!

## Wie funktioniert es?

### 1. Startseite bearbeiten

1. Loggen Sie sich in WordPress ein
2. Gehen Sie zu **Seiten** → **Alle Seiten**
3. Klicken Sie auf **Startseite** (oder "Home")
4. Der WordPress Block-Editor öffnet sich

### 2. Block-Patterns einfügen

Im Block-Editor finden Sie unter der Kategorie **"Physio Sektionen"** folgende vorgefertigte Sektionen:

- **Hero Sektion** - Große Einstiegssektion mit Überschrift und Buttons
- **Leistungen Sektion** - Zeigt Ihre Services an
- **Über Uns Sektion** - Informationen über Ihre Praxis
- **Team Sektion** - Stellt Ihr Team vor
- **Bewertungen Sektion** - Kundenbewertungen
- **Call-to-Action Sektion** - Abschluss-Sektion mit Kontakt-Aufforderung

### 3. Sektionen hinzufügen

1. Klicken Sie auf das **+** Symbol im Editor
2. Suchen Sie nach "Physio" oder scrollen Sie zur Kategorie "Physio Sektionen"
3. Klicken Sie auf eine Sektion, um sie einzufügen
4. Die Sektion wird automatisch mit Beispielinhalten gefüllt

### 4. Sektionen verschieben

- Klicken Sie auf eine Sektion
- Nutzen Sie die Pfeile ↑↓ in der Toolbar, um die Sektion nach oben oder unten zu verschieben
- Oder ziehen Sie die Sektion per Drag & Drop an die gewünschte Position

### 5. Inhalte bearbeiten

Jede Sektion kann direkt im Editor bearbeitet werden:

- **Texte ändern**: Einfach auf den Text klicken und bearbeiten
- **Buttons anpassen**: URL und Text der Buttons ändern
- **Farben ändern**: Über die Toolbar rechts
- **Bilder austauschen**: Auf das Bild klicken und ersetzen

### 6. Button-Stile

Für Buttons stehen drei Stile zur Verfügung:

- **Primär** (Türkis) - Hauptaktionen
- **Sekundär** (Grün) - Zweitaktionen
- **Umriss** - Transparenter Button mit Rahmen

So ändern Sie den Button-Stil:
1. Button auswählen
2. Rechts in der Sidebar unter "Stile" den gewünschten Stil wählen

## Wichtige Dateien

### Neue Dateien
- `/inc/block-patterns.php` - Definiert die Block-Patterns
- `/inc/shortcodes.php` - Shortcodes für dynamische Inhalte (Services, Team, Testimonials)
- `/front-page-static.php` - Backup der alten statischen Startseite

### Geänderte Dateien
- `/front-page.php` - Neue block-basierte Startseite
- `/functions.php` - Block-Editor Support aktiviert
- `/style.css` - Block-Styles hinzugefügt

## Dynamische Inhalte

Die folgenden Sektionen zeigen automatisch Ihre WordPress-Inhalte:

### Services/Leistungen
Werden aus dem Custom Post Type **"Leistungen"** geladen. Neue Services hinzufügen unter:
**WordPress Admin** → **Leistungen** → **Neu hinzufügen**

### Team
Wird aus dem Custom Post Type **"Team"** geladen. Team-Mitglieder hinzufügen unter:
**WordPress Admin** → **Team** → **Neu hinzufügen**

### Bewertungen
Werden aus dem Custom Post Type **"Bewertungen"** geladen. Neue Bewertungen hinzufügen unter:
**WordPress Admin** → **Bewertungen** → **Neu hinzufügen**

## Shortcodes

Falls Sie die dynamischen Inhalte in anderen Seiten verwenden möchten:

```
[physio_services limit="6"]
[physio_team limit="4"]
[physio_testimonials limit="4"]
```

## Zurück zur alten Version

Falls Sie zur statischen Version zurückkehren möchten:

1. Benennen Sie `front-page.php` um in `front-page-blocks.php`
2. Benennen Sie `front-page-static.php` um in `front-page.php`
3. Löschen Sie den Cache (falls ein Cache-Plugin aktiv ist)

## Support

Bei Fragen oder Problemen:
- Überprüfen Sie, ob alle Plugins aktuell sind
- Stellen Sie sicher, dass Sie WordPress 5.8+ verwenden
- Leeren Sie den Browser-Cache nach Änderungen

## Tipps & Tricks

1. **Vorschau**: Nutzen Sie die Vorschau-Funktion im Editor, um Änderungen vor der Veröffentlichung zu sehen
2. **Reihenfolge ändern**: Experimentieren Sie mit verschiedenen Anordnungen der Sektionen
3. **Farben**: Nutzen Sie die Theme-Farben für ein konsistentes Design
4. **Abstände**: Passen Sie Abstände in den Block-Einstellungen an (Rechte Sidebar → Block → Abstand)

Viel Erfolg mit Ihrem neuen flexiblen Block-System! 🎉
