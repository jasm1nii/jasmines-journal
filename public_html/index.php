<?php
    
    define("REQUEST", $_SERVER['REQUEST_URI']);
    define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1));

    // composer
    require SITE_ROOT . "/vendor/autoload.php";

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\Views\Layouts as Layouts;
    use JasminesJournal\Site\Views\Generator as Generator;

    switch (REQUEST) {

        case "":
        case "/":
        case "/index":

            new Layouts\Home();
            break;


        case str_starts_with(REQUEST, "/about/"):

            Route::forwardToController('about.php');
            break;


        case str_starts_with(REQUEST, "/blog/"):

            Route::forwardToController('blog.php');
            break;


        case str_starts_with(REQUEST, "/resources/"):

            Route::forwardToController('resources.php');
            break;


        case str_starts_with(REQUEST, "/feeds/"):

            Route::forwardToController('feeds.php');
            break;

        case "/articles.xml":

            new Generator\ArticlesXML($max_entries = 'total_entries', $debug = false);
            break;


        case "/notes.xml":

            new Generator\NotesXML($max_entries = 'total_entries', $debug = false);
            break;


        case "/link-gallery/":
        case "/link-gallery/index/":

            new Layouts\LinkGallery();
            break;

        
        case "/site-map/":
        case "/site-map/index/":

            new Layouts\SiteMap();
            break;


        case "/credits/":
        case "/credits/index/":

            new Layouts\Credits();
            break;


        case "/accessibility/":
        case "/accessibility/index/":

            new Layouts\Accessibility();
            break;
        
        
        case str_starts_with(REQUEST, "/guestbook/"):

            Route::forwardToController('guestbook.php');
            break;
        
        
        default:

            Route::NotFound();

   }
   
?>