# Font-Dateinamen - Unterstützte Namenskonventionen

Die CSS-Dateien sind flexibel und unterstützen mehrere Namenskonventionen.

## ✅ Unterstützte Dateinamen

### **Figtree**

Der Browser versucht folgende Dateinamen in dieser Reihenfolge:

#### Regular (400)
- `figtree-regular.woff2` ← Empfohlen
- `figtree-v5-latin-regular.woff2` (Google Webfonts Helper)
- `Figtree-Regular.woff2` (CamelCase)
- `figtree-latin-400-normal.woff2` (alternative Benennung)

#### Regular Italic
- `figtree-italic.woff2`
- `figtree-v5-latin-italic.woff2`
- `Figtree-Italic.woff2`
- `figtree-latin-400-italic.woff2`

#### Medium (500)
- `figtree-medium.woff2` ← Empfohlen
- `figtree-v5-latin-500.woff2`
- `Figtree-Medium.woff2`
- `figtree-latin-500-normal.woff2`

#### Medium Italic
- `figtree-medium-italic.woff2`
- `figtree-v5-latin-500italic.woff2`
- `Figtree-MediumItalic.woff2`
- `figtree-latin-500-italic.woff2`

#### SemiBold (600)
- `figtree-semibold.woff2` ← Empfohlen
- `figtree-v5-latin-600.woff2`
- `Figtree-SemiBold.woff2`
- `figtree-latin-600-normal.woff2`

#### SemiBold Italic
- `figtree-semibold-italic.woff2`
- `figtree-v5-latin-600italic.woff2`
- `Figtree-SemiBoldItalic.woff2`
- `figtree-latin-600-italic.woff2`

---

### **Outfit**

#### Regular (400)
- `outfit-regular.woff2` ← Empfohlen
- `outfit-v11-latin-regular.woff2` (Google Webfonts Helper)
- `Outfit-Regular.woff2`
- `outfit-latin-400-normal.woff2`

#### Regular Italic
- `outfit-italic.woff2`
- `outfit-v11-latin-italic.woff2`
- `Outfit-Italic.woff2`
- `outfit-latin-400-italic.woff2`

#### SemiBold (600)
- `outfit-semibold.woff2` ← Empfohlen
- `outfit-v11-latin-600.woff2`
- `Outfit-SemiBold.woff2`
- `outfit-latin-600-normal.woff2`

#### SemiBold Italic
- `outfit-semibold-italic.woff2`
- `outfit-v11-latin-600italic.woff2`
- `Outfit-SemiBoldItalic.woff2`
- `outfit-latin-600-italic.woff2`

#### Bold (700)
- `outfit-bold.woff2` ← Empfohlen
- `outfit-v11-latin-700.woff2`
- `Outfit-Bold.woff2`
- `outfit-latin-700-normal.woff2`

#### Bold Italic
- `outfit-bold-italic.woff2`
- `outfit-v11-latin-700italic.woff2`
- `Outfit-BoldItalic.woff2`
- `outfit-latin-700-italic.woff2`

---

## 📁 Verzeichnisstruktur

```
/assets/fonts/
├── outfit/
│   ├── outfit-regular.woff2
│   ├── outfit-italic.woff2 (optional)
│   ├── outfit-semibold.woff2
│   ├── outfit-semibold-italic.woff2 (optional)
│   ├── outfit-bold.woff2
│   └── outfit-bold-italic.woff2 (optional)
└── figtree/
    ├── figtree-regular.woff2
    ├── figtree-italic.woff2 (optional)
    ├── figtree-medium.woff2
    ├── figtree-medium-italic.woff2 (optional)
    ├── figtree-semibold.woff2
    └── figtree-semibold-italic.woff2 (optional)
```

## 🔍 Font-Dateien scannen

Führen Sie das Scanner-Script aus um zu sehen welche Dateien vorhanden sind:

```bash
cd /pfad/zum/theme/assets/fonts
./scan-fonts.sh
```

## 💡 Wichtig

- **Nur WOFF2 nötig** - WOFF ist für Fallback, wird aber kaum noch benötigt
- **Italic ist optional** - Wird nur geladen wenn vorhanden
- **Browser wählt erste verfügbare Datei** - daher mehrere Alternativen
- **Groß-/Kleinschreibung beachten** - Linux ist case-sensitive!

## 🎯 Empfohlene Benennung

Am einfachsten ist die Kleinschreibung mit Bindestrichen:
- ✅ `outfit-regular.woff2`
- ✅ `figtree-medium.woff2`
- ❌ nicht: `Outfit_Regular.woff2` (funktioniert aber auch)

## 🚀 Quick Fix

Wenn Fonts nicht laden, prüfen Sie:

1. **Dateinamen prüfen:**
   ```bash
   cd /pfad/zum/theme/assets/fonts
   ./scan-fonts.sh
   ```

2. **Dateiberechtigungen:**
   ```bash
   chmod 644 figtree/*.woff2
   chmod 644 outfit/*.woff2
   ```

3. **Browser-Cache leeren:**
   - Strg+F5 (Windows)
   - Cmd+Shift+R (Mac)

4. **Browser DevTools prüfen:**
   - F12 → Network Tab → Filter: "font"
   - Status 200 = OK
   - Status 404 = Datei nicht gefunden
