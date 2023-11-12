<?php
    $nav = new DOMDocument();
    $nav->loadHTMLFile(SITE_ROOT . DIR['includes'] . '/headernav.shtml');

    $blog_index = $nav->getElementById('blog');
    $blog_subindex = $nav->createElement('ul');
    $blog_index->appendChild($blog_subindex);

    $articles_index = $nav->createElement('li');
    $blog_subindex->appendChild($articles_index);

    $articles_a = $nav->createElement('a', 'articles');
    $articles_a_href = $nav->createAttribute('href');
    $articles_a_href->value = '/blog/articles';
    $articles_a->appendChild($articles_a_href);

    $articles_index->appendChild($articles_a);

    $notes_index = $nav->createElement('li');
    $blog_subindex->appendChild($notes_index);

    $notes_a = $nav->createElement('a', 'notes');
    $notes_a_href = $nav->createAttribute('href');
    $notes_a_href->value = '/blog/notes';
    $notes_a->appendChild($notes_a_href);

    $notes_index->appendChild($notes_a);

    $nav_html = $nav->saveHTML();
?>