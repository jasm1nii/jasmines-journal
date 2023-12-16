#! /usr/bin/bash

echo "relative path to the uncompressed javascript file (omit the \".js\" extension):"

read -r file

# this doesn't give me the result i want, so will edit later:
# source_map_url=$(grep -E "\/|[a-z]+$" "$file")

terser "public_html/_assets/scripts/$file.js" --compress --mangle --output "public_html/_assets/scripts/$file.min.js"

# append to the end of terser once i figure out how to get the string:
# --source-map "url='$source_map_url.min.js.map'"