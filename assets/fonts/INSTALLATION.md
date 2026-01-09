# 📦 Font-Installation - Schritt-für-Schritt Anleitung

## Benötigte Schriftschnitte:

### **Outfit** (6 Dateien)
- `outfit-regular.woff2` (Normal, 400)
- `outfit-regular.woff` (Fallback)
- `outfit-semibold.woff2` (SemiBold, 600)
- `outfit-semibold.woff` (Fallback)
- `outfit-bold.woff2` (Bold, 700)
- `outfit-bold.woff` (Fallback)

### **Figtree** (6 Dateien)
- `figtree-regular.woff2` (Normal, 400)
- `figtree-regular.woff` (Fallback)
- `figtree-medium.woff2` (Medium, 500)
- `figtree-medium.woff` (Fallback)
- `figtree-semibold.woff2` (SemiBold, 600)
- `figtree-semibold.woff` (Fallback)

---

## 🚀 Option 1: Google Webfonts Helper (EMPFOHLEN)

### Outfit herunterladen:

1. Öffnen Sie: https://gwfh.mranftl.com/fonts/outfit
2. Wählen Sie die Schnitte aus:
   - ✅ regular (400)
   - ✅ 600
   - ✅ 700
3. **Modern Browsers** wählen (nur WOFF2)
4. Klicken Sie auf **Download**
5. Entpacken Sie das ZIP
6. Kopieren Sie alle `.woff2` Dateien nach: `outfit/`

### Figtree herunterladen:

1. Öffnen Sie: https://gwfh.mranftl.com/fonts/figtree
2. Wählen Sie die Schnitte aus:
   - ✅ regular (400)
   - ✅ 500
   - ✅ 600
3. **Modern Browsers** wählen (nur WOFF2)
4. Klicken Sie auf **Download**
5. Entpacken Sie das ZIP
6. Kopieren Sie alle `.woff2` Dateien nach: `figtree/`

---

## 🌐 Option 2: Direkt von Google Fonts

### Outfit:

1. Besuchen Sie: https://fonts.google.com/specimen/Outfit
2. Klicken Sie auf **Download family**
3. Entpacken Sie die ZIP-Datei
4. Finden Sie die Dateien:
   - `static/Outfit-Regular.ttf`
   - `static/Outfit-SemiBold.ttf`
   - `static/Outfit-Bold.ttf`

### Figtree:

1. Besuchen Sie: https://fonts.google.com/specimen/Figtree
2. Klicken Sie auf **Download family**
3. Entpacken Sie die ZIP-Datei
4. Finden Sie die Dateien:
   - `static/Figtree-Regular.ttf`
   - `static/Figtree-Medium.ttf`
   - `static/Figtree-SemiBold.ttf`

### TTF zu WOFF2 konvertieren:

**Online-Konverter (einfachste Methode):**
- https://cloudconvert.com/ttf-to-woff2
- Laden Sie alle 6 TTF-Dateien hoch
- Konvertieren zu WOFF2
- Herunterladen

**Oder mit Tool:**
```bash
# Wenn woff2_compress installiert ist:
woff2_compress Outfit-Regular.ttf
woff2_compress Outfit-SemiBold.ttf
woff2_compress Outfit-Bold.ttf
woff2_compress Figtree-Regular.ttf
woff2_compress Figtree-Medium.ttf
woff2_compress Figtree-SemiBold.ttf
```

---

## 📁 Dateistruktur nach Installation:

```
/assets/fonts/
├── fonts.css
├── download-fonts.sh
├── README.md
├── INSTALLATION.md (diese Datei)
├── outfit/
│   ├── outfit-regular.woff2      ✅ Wichtig
│   ├── outfit-semibold.woff2     ✅ Wichtig
│   └── outfit-bold.woff2         ✅ Wichtig
└── figtree/
    ├── figtree-regular.woff2     ✅ Wichtig
    ├── figtree-medium.woff2      ✅ Wichtig
    └── figtree-semibold.woff2    ✅ Wichtig
```

**Hinweis:** WOFF2 ist ausreichend! WOFF ist nur für sehr alte Browser nötig.

---

## ✅ Installation testen:

1. Fonts in die richtigen Ordner kopieren
2. WordPress-Cache leeren
3. Browser-Cache leeren (Strg+F5)
4. Website aufrufen
5. Browser-DevTools öffnen (F12)
6. **Network** Tab → Filter auf "font"
7. Sie sollten sehen:
   - ✅ `outfit-regular.woff2` (Status: 200)
   - ✅ `outfit-semibold.woff2` (Status: 200)
   - ✅ `outfit-bold.woff2` (Status: 200)
   - ✅ `figtree-regular.woff2` (Status: 200)
   - ✅ `figtree-medium.woff2` (Status: 200)
   - ✅ `figtree-semibold.woff2` (Status: 200)

---

## 🎨 Ohne Installation?

**Kein Problem!** Das Theme funktioniert auch ohne lokale Fonts:

- Verwendet automatisch **System-Fonts** als Fallback
- Performance bleibt optimal (0 KB Download)
- Sieht immer noch professionell aus
- Unterschied ist minimal auf modernen Systemen

---

## 📊 Dateigrößen (ungefähr):

- Outfit Regular: ~12 KB
- Outfit SemiBold: ~12 KB
- Outfit Bold: ~12 KB
- Figtree Regular: ~10 KB
- Figtree Medium: ~10 KB
- Figtree SemiBold: ~10 KB

**Gesamt:** ~66 KB (sehr klein!)

---

## 🔧 Probleme?

**Fonts werden nicht geladen:**
- Prüfen Sie die Dateinamen (Groß-/Kleinschreibung!)
- Prüfen Sie die Ordnernamen: `outfit` und `figtree`
- Cache leeren (Browser + WordPress)
- Dateirechte prüfen (644 für Dateien, 755 für Ordner)

**Fonts sehen anders aus:**
- Das ist normal - System-Fonts werden als Fallback genutzt
- Laden Sie die WOFF2-Dateien herunter für optimale Darstellung
