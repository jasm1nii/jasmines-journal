<?php

    // uncomment when doing maintenance 🔧

    /*
        http_response_code(503);
        require "503.shtml";

        __halt_compiler();
    */

    require __DIR__ . '/../vendor/autoload.php';

    use JasminesJournal\Core\Controller\Route;

    use JasminesJournal\Site\RequestRouter\{About, Blog, Resources, Feeds, Guestbook};
    use JasminesJournal\Site\Views\Layouts;
    use JasminesJournal\Site\Views\Generator;

    match (true) {

        REQUEST == "/",
        REQUEST == "/index"

            => new Layouts\Home,


        REQUEST == "/link-gallery"

            => new Layouts\LinkGallery,


        REQUEST == "/site-map"

            => new Layouts\SiteMap,


        REQUEST == "/credits"

            => new Layouts\Credits,


        REQUEST == "/accessibility"

            => new Layouts\Accessibility,


        //

        REQUEST == "/articles.xml"

            => new Generator\XMLFeeds(
                type: 'articles',
                max_entries: 'total_entries'),


        REQUEST == "/notes.xml"

            => new Generator\XMLFeeds(
                type: 'notes',
                max_entries: 'total_entries'),


        //

        str_starts_with(REQUEST, "/about")

            => About::dispatch(),


        str_starts_with(REQUEST, "/blog")

            => Blog::dispatch(),


        str_starts_with(REQUEST, "/resources")

            => Resources::dispatch(),


        str_starts_with(REQUEST, "/feeds")

            => Feeds::dispatch(),


        str_starts_with(REQUEST, "/guestbook")

            => Guestbook::dispatch(),
            

        default
        
            => Route::notFound()
        
    };