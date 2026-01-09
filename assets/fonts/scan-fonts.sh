#!/bin/bash
#
# Font-Dateinamen-Scanner
# Scannt die Font-Verzeichnisse und zeigt die tatsächlichen Dateinamen
#

echo "🔍 Scanning Font Files..."
echo ""

# Figtree
echo "📁 Figtree:"
if [ -d "figtree" ]; then
    find figtree -type f \( -name "*.woff2" -o -name "*.woff" -o -name "*.ttf" \) | sort
    if [ $(find figtree -type f \( -name "*.woff2" -o -name "*.woff" \) | wc -l) -eq 0 ]; then
        echo "   ⚠️  Keine Font-Dateien gefunden"
    fi
else
    echo "   ⚠️  Verzeichnis nicht gefunden"
fi
echo ""

# Outfit
echo "📁 Outfit:"
if [ -d "outfit" ]; then
    find outfit -type f \( -name "*.woff2" -o -name "*.woff" -o -name "*.ttf" \) | sort
    if [ $(find outfit -type f \( -name "*.woff2" -o -name "*.woff" \) | wc -l) -eq 0 ]; then
        echo "   ⚠️  Keine Font-Dateien gefunden"
    fi
else
    echo "   ⚠️  Verzeichnis nicht gefunden"
fi
echo ""

# Andere Fonts
for dir in poppins montserrat raleway playfair-display inter open-sans lato source-sans-pro; do
    if [ -d "$dir" ]; then
        count=$(find "$dir" -type f \( -name "*.woff2" -o -name "*.woff" \) | wc -l)
        if [ $count -gt 0 ]; then
            echo "📁 $dir: ($count Dateien)"
            find "$dir" -type f \( -name "*.woff2" -o -name "*.woff" \) | sort | head -5
            echo ""
        fi
    fi
done

echo "✅ Scan abgeschlossen"
echo ""
echo "💡 Hilfe:"
echo "   Wenn Sie die Dateien hochgeladen haben, sollten sie oben erscheinen."
echo "   Typische Dateinamen:"
echo "   - figtree-regular.woff2 oder figtree-v5-latin-regular.woff2"
echo "   - Figtree-Regular.woff2 oder Figtree_400.woff2"
