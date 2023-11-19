<?php
    
    define("REQUEST", $_SERVER['REQUEST_URI']);
    define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1));

    // composer
    require SITE_ROOT . "/vendor/autoload.php";

    use JasminesJournal\Core\Route as Route;
    use JasminesJournal\Site\Views\Layouts as Layouts;

    switch (REQUEST) {

        case "":
        case "/":
        case "/index":

            Route::loadLayoutClasses('home.php');

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


        case "/link-gallery/":
        case "/link-gallery/index/":

            Route::loadLayoutClasses('link-gallery.php');

            new Layouts\LinkGallery();

            break;

        
        case "/site-map/":
        case "/site-map/index/":

            Route::loadLayoutClasses('site-map.php');

            new Layouts\SiteMap();

            break;


        case "/credits/":
        case "/credits/index/":

            Route::loadLayoutClasses('credits.php');

            new Layouts\Credits();

            break;


        case "/accessibility/":
        case "/accessibility/index/":

            Route::loadLayoutClasses('accessibility.php');

            new Layouts\Accessibility();

            break;
        
        
        case str_starts_with(REQUEST, "/guestbook/"):

            Route::forwardToController('guestbook.php');

            break;
        
        
        default:

            Route::NotFound();

   }
   
?>