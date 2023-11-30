#! /usr/bin/bash

echo "what would you like to do?"
echo "* syntax: (post type) (action)"
echo "** post type: article | note"
echo "** action: new-draft | publish-draft | unpublish-draft"

read -r post_type option

if [ "$post_type" = "article" ]; then

    post_dir="articles"

elif [ "$post_type" = "note" ]; then

    post_dir="notes"

else

    echo "the post type is not valid!"
    exit

fi

if [ -z "$option" ]; then

    echo "the action parameter cannot be empty!"
    exit

fi

if [[ "$option" = "new-draft" || "$option" = "new" ]]; then

    echo "enter a date (format: yyyy/mm/dd)"
    echo "* the month can be a single digit"
    read -r date

    mkdir -p "resources/drafts/blog/$post_dir/$date"

    target_file="resources/drafts/blog/$post_dir/$date/entry.html.twig"

    cp "src/site/templates/note_entry.html.twig" "$target_file"

    echo "a blank note was created - opening the text editor..."
    codium "$target_file"


elif [[ "$option" = "publish-draft" || "$option" = "publish" ]]; then

    echo "enter the date of the draft file (format: yyyy/mm/dd)"
    read -r date

    mkdir -p "src/site/content/blog/$post_dir/$date"

    draft_dir="resources/drafts/blog/$post_dir/$date"
    draft_file="$draft_dir/entry.html.twig"

    published_file="src/site/content/blog/$post_dir/$date/entry.html.twig"

    mv "$draft_file" "$published_file"
    rmdir "$draft_dir"

    echo "moved to public directory"


elif [[ "$option" = "unpublish-draft" || "$option" = "unpublish" ]]; then

    echo "enter the date of the draft file (format: yyyy/mm/dd)"

    read -r date

    published_dir="src/site/content/blog/$post_dir/$date"
    published_file="$published_dir/entry.html.twig"

    draft_file="resources/drafts/blog/$post_dir/$date/entry.html.twig"

    mv "$published_file" "$draft_file"
    rmdir "$published_dir"

    echo "moved to drafts directory"


fi