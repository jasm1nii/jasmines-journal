<?php 

    namespace JasminesJournal\Site\Request;

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\Views\Layouts as Layouts;
    use JasminesJournal\Site\Views\Generator as Generator;

    class Index {

        use About, Blog, Resources, Feeds, Guestbook;

        public static function dispatch() {

            match (true) {

                REQUEST == "/", REQUEST == "/index"
                    => new Layouts\Home(),

                REQUEST == "/link-gallery"
                    => new Layouts\LinkGallery(),

                REQUEST == "/site-map"
                    => new Layouts\SiteMap(),

                REQUEST == "/credits"
                    => new Layouts\Credits(),

                REQUEST == "/accessibility"
                    => new Layouts\Accessibility(),

                //

                REQUEST == "/articles.xml"
                    => new Generator\XMLFeeds(
                        $type = 'articles',
                        $max_entries = 'total_entries'),

                REQUEST == "/notes.xml"
                    => new Generator\XMLFeeds(
                        $type = 'notes',
                        $max_entries = 'total_entries'),

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

                default => Route::NotFound()
                
            };

        }

    }

?>