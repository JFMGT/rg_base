# Font-Installation für PhysioTherapy Pro Theme

## Übersicht

Das Theme nutzt **lokale Fonts** statt Google Fonts, um DSGVO-konform zu sein und die Performance zu verbessern.

## Standard-Fonts

Die Standard-Fonts **Outfit** und **Figtree** sollten lokal installiert werden für optimale Darstellung.

### Font-Dateien herunterladen

**Outfit:**
1. Besuchen Sie: https://fonts.google.com/specimen/Outfit
2. Klicken Sie auf "Download family"
3. Extrahieren Sie die Dateien
4. Konvertieren Sie TTF zu WOFF2 (https://cloudconvert.com/ttf-to-woff2)
5. Kopieren Sie die Dateien nach: `/assets/fonts/outfit/`
   - `outfit-regular.woff2`
   - `outfit-semibold.woff2`
   - `outfit-bold.woff2`

**Figtree:**
1. Besuchen Sie: https://fonts.google.com/specimen/Figtree
2. Klicken Sie auf "Download family"
3. Extrahieren Sie die Dateien
4. Konvertieren Sie TTF zu WOFF2
5. Kopieren Sie die Dateien nach: `/assets/fonts/figtree/`
   - `figtree-regular.woff2`
   - `figtree-medium.woff2`
   - `figtree-semibold.woff2`

## Verzeichnisstruktur

```
/assets/fonts/
├── fonts.css           # Font-Definitionen (bereits vorhanden)
├── README.md           # Diese Datei
├── outfit/             # Outfit Font-Dateien (zu erstellen)
│   ├── outfit-regular.woff2
│   ├── outfit-regular.woff
│   ├── outfit-semibold.woff2
│   ├── outfit-semibold.woff
│   ├── outfit-bold.woff2
│   └── outfit-bold.woff
└── figtree/            # Figtree Font-Dateien (zu erstellen)
    ├── figtree-regular.woff2
    ├── figtree-regular.woff
    ├── figtree-medium.woff2
    ├── figtree-medium.woff
    ├── figtree-semibold.woff2
    └── figtree-semibold.woff
```

## Alternative Fonts (System-Fonts)

Die folgenden Fonts nutzen automatisch System-Fonts als Fallback und müssen NICHT installiert werden:
- Poppins → verwendet System-Fonts
- Montserrat → verwendet System-Fonts
- Raleway → verwendet System-Fonts
- Playfair Display → verwendet Georgia als Fallback
- Inter → verwendet SF Pro / Segoe UI
- Open Sans → verwendet Arial
- Lato → verwendet Helvetica Neue
- Source Sans Pro → verwendet Segoe UI

## Aktueller Status

✅ **Lokale Font-Einbindung aktiv** - Keine Google Fonts werden geladen
✅ **DSGVO-konform** - Alle Fonts lokal oder System-Fonts
⚠️ **Outfit & Figtree fehlen** - Werden durch System-Fonts ersetzt bis installiert

## Font-Auswahl im Customizer

Die Font-Auswahl funktioniert jetzt korrekt:

1. WordPress Admin → Design → Customizer
2. Sektion "Typografie" öffnen
3. **Überschriften-Schriftart** wählen (für h1-h6)
4. **Fließtext-Schriftart** wählen (für Body-Text)
5. Änderungen werden sofort angewendet

## Performance-Hinweise

- **WOFF2** ist das modernste und kleinste Format (bevorzugt)
- **WOFF** ist der Fallback für ältere Browser
- System-Fonts haben **null** Ladezeit
- Outfit + Figtree zusammen: ca. 60-80 KB (wenn installiert)

## Troubleshooting

**Fonts werden nicht angezeigt:**
1. Cache leeren (Browser + WordPress)
2. Prüfen ob `fonts.css` geladen wird (Seitenquelltext)
3. Console auf Fehler prüfen (F12)

**Customizer-Änderungen funktionieren nicht:**
1. Customizer → Änderung machen → "Veröffentlichen" klicken
2. Browser-Cache leeren (Strg+F5)
3. WordPress-Cache leeren (wenn Plugin aktiv)
