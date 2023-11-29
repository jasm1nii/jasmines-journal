#! /usr/bin/bash

echo "what would you like to do?"
echo "options: new-draft | publish-draft | unpublish-draft "

read -r option

if [[ "$option" = "new-draft" || "$option" = "new" ]]; then

    echo "enter a date (format: yyyy/mm/dd)"
    echo "* the month can be a single digit"

    read -r date

    mkdir -p "resources/drafts/blog/notes/$date"

    target_file="resources/drafts/blog/notes/$date/entry.html.twig"

    cp "src/site/templates/note_entry.html.twig" "$target_file"

    echo "a blank note was created - opening the text editor..."

    codium "$target_file"


elif [[ "$option" = "publish-draft" || "$option" = "publish" ]]; then

    echo "enter the date of the draft file (format: yyyy/mm/dd)"

    read -r date

    mkdir -p "src/site/content/blog/notes/$date"

    draft_dir="resources/drafts/blog/notes/$date"
    draft_file="$draft_dir/entry.html.twig"

    published_file="src/site/content/blog/notes/$date/entry.html.twig"

    mv "$draft_file" "$published_file"

    rmdir "$draft_dir"

    echo "moved to public directory"


elif [[ "$option" = "unpublish-draft" || "$option" = "unpublish" ]]; then

    echo "enter the date of the draft file (format: yyyy/mm/dd)"

    read -r date

    published_dir="src/site/content/blog/notes/$date"
    published_file="$published_dir/entry.html.twig"

    draft_file="resources/drafts/blog/notes/$date/entry.html.twig"

    mv "$published_file" "$draft_file"

    rmdir "$published_dir"

    echo "moved to drafts directory"


fi