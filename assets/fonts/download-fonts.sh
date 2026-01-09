#!/bin/bash
#
# Font Download Script für PhysioTherapy Pro Theme
# Lädt Outfit und Figtree von Google Webfonts Helper herunter
#

echo "🔤 Downloading Outfit & Figtree fonts..."
echo ""

# Erstelle Verzeichnisse
mkdir -p outfit figtree

# Outfit Regular (400)
echo "📥 Downloading Outfit Regular..."
curl -L "https://fonts.gstatic.com/s/outfit/v11/QGYyz_MVcBeNP4NjuGObqx1XmO1I4W61O4a0Ew.woff2" -o outfit/outfit-regular.woff2

# Outfit SemiBold (600)
echo "📥 Downloading Outfit SemiBold..."
curl -L "https://fonts.gstatic.com/s/outfit/v11/QGYyz_MVcBeNP4NjuGObqx1XmO1I4bC1O4a0Ew.woff2" -o outfit/outfit-semibold.woff2

# Outfit Bold (700)
echo "📥 Downloading Outfit Bold..."
curl -L "https://fonts.gstatic.com/s/outfit/v11/QGYyz_MVcBeNP4NjuGObqx1XmO1I4Y-1O4a0Ew.woff2" -o outfit/outfit-bold.woff2

# Figtree Regular (400)
echo "📥 Downloading Figtree Regular..."
curl -L "https://fonts.gstatic.com/s/figtree/v5/_Xmz-HUzqDCFdgfMm4GnH5CQW_M.woff2" -o figtree/figtree-regular.woff2

# Figtree Medium (500)
echo "📥 Downloading Figtree Medium..."
curl -L "https://fonts.gstatic.com/s/figtree/v5/_Xmz-HUzqDCFdgfMm4GnH4qQW_M.woff2" -o figtree/figtree-medium.woff2

# Figtree SemiBold (600)
echo "📥 Downloading Figtree SemiBold..."
curl -L "https://fonts.gstatic.com/s/figtree/v5/_Xmz-HUzqDCFdgfMm4GnH3aRW_M.woff2" -o figtree/figtree-semibold.woff2

echo ""
echo "✅ Download abgeschlossen!"
echo ""
echo "📁 Dateien befinden sich in:"
echo "   - outfit/"
echo "   - figtree/"
echo ""
echo "📌 Nächster Schritt:"
echo "   Kopieren Sie die Ordner 'outfit' und 'figtree' nach:"
echo "   wp-content/themes/physiotherapy-pro/assets/fonts/"
