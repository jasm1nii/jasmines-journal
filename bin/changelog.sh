#! /usr/bin/bash

year=$(date +'%-Y')
month=$(date +'%-m')

target_dir="src/site/content/changelog/$year"
target_file="$target_dir/$month.html.twig"

if [ -f "$target_file" ]; then

    echo "opening changelog file..."

else

    mkdir -p "$target_dir"
    cp "src/site/templates/changelog.html.twig" "$target_file"
    echo "created a new changelog file - opening the text editor..."

fi

codium "$target_file"