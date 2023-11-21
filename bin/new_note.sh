#! /usr/bin/bash

echo 'enter a date (format: yyyy/mm/dd)'
echo '* the month can be a single digit'

read date

mkdir -p src/site/content/blog/notes/$date

target_file=src/site/content/blog/notes/$date/entry.html.twig

cp src/site/templates/note_entry.html.twig $target_file

echo 'a blank note was created - opening the text editor...'

codium $target_file