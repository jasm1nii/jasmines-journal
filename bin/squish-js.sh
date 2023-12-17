#! /usr/bin/bash

echo "relative path to the uncompressed javascript file (omit the \".js\" extension):"

read -r file

source_map_url=$(basename "$file")

terser "public_html/_assets/scripts/$file.js" --compress --mangle --output "public_html/_assets/scripts/$file.min.js" --source-map "url='$source_map_url.min.js.map'"