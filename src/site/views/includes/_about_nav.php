<?php

    namespace JasminesJournal\Site\Views\Partials;

    class AboutNav {

        public static function make() {

            libxml_use_internal_errors(true);

            $nav = new \DOMDocument;
            $nav->loadHTMLFile(__DIR__.'/headernav.shtml');

            $about_index = $nav->getElementById('about');
            $about_subindex = $nav->createElement('ul');
            $about_index->appendChild($about_subindex);
            $changelog_index = $nav->createElement('li');
            $about_subindex->appendChild($changelog_index);

            $changelog_a = $nav->createElement('a','changelog');
            $changelog_a_href = $nav->createAttribute('href');
            $changelog_a_href->value = '/about/changelog';
            $changelog_a->appendChild($changelog_a_href);
            $changelog_index->appendChild($changelog_a);

            return $nav->saveHTML();

        }

    }
    
?>