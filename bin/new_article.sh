#! /usr/bin/bash

echo 'enter a date (format: yyyy/mm/dd)'
echo '* the month can be a single digit'

read date

mkdir -p "resources/drafts/blog/articles/$date"

target_file="resources/drafts/blog/articles/$date/entry.html.twig"

cp "src/site/templates/article_entry.html.twig" $target_file

echo "a blank article was created - opening the text editor..."

codium $target_file