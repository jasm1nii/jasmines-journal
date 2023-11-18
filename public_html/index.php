<?php
    
    define("REQUEST", $_SERVER['REQUEST_URI']);
    define("SITE_ROOT", dirname($_SERVER['DOCUMENT_ROOT'], 1));
    
    require SITE_ROOT . "/config/src_paths.php";

    // composer
    require SITE_ROOT . "/vendor/autoload.php";

    // core functions
    require SITE_ROOT . "/src/core/controller/router.php";
    require SITE_ROOT . '/src/core/view/view.php';

    switch (REQUEST) {

        case "":
        case "/":
        case "/index":

            Route::loadLayoutClasses('home.php');

            new JasminesJournal\Site\Views\Layouts\Home();

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

            new JasminesJournal\Site\Views\Layouts\LinkGallery();

            break;

        
        case "/site-map/":
        case "/site-map/index/":

            Route::loadLayoutClasses('site-map.php');

            new JasminesJournal\Site\Views\Layouts\SiteMap();

            break;


        case "/credits/":
        case "/credits/index/":

            Route::loadLayoutClasses('credits.php');

            new JasminesJournal\Site\Views\Layouts\Credits();

            break;


        case "/accessibility/":
        case "/accessibility/index/":

            Route::loadLayoutClasses('accessibility.php');

            new JasminesJournal\Site\Views\Layouts\Accessibility();

            break;
        
        
        case str_starts_with(REQUEST, "/guestbook/"):

            Route::forwardToController('guestbook.php');

            break;
        
        
        default:

            Route::NotFound();

   }
   
?>