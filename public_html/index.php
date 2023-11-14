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

            Route::execute('home.php');
            new Site\Views\Layouts\Home();
            break;

        case str_starts_with(REQUEST, "/about/"):

            Route::execute('about.php', 'use_controller');
            break;

        case "/link-gallery/":
        case "/link-gallery/index/":

            Route::execute('link-gallery.php');
            new Site\Views\Layouts\LinkGallery();
            break;

        case str_starts_with(REQUEST, "/blog/"):

            Route::execute('blog.php', 'use_controller');
            break;

        case str_starts_with(REQUEST, "/resources/"):

            Route::execute('resources.php', 'use_controller');
            break;
            
        /*

        case "/accessibility/":
        case "/accessibility/index/":

            $content = DIR['content'] . "accessibility.html.twig";
            $layout = View::Subpage;
            $slug = trim("/accessibility/", "/");
            $updated = filemtime(SITE_ROOT . $content);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::Twig($content, $vars, null);
            break;

        case "/credits/":
        case "/credits/index/":

            $content = DIR['content'] . "credits.html.twig";
            $layout = View::Subpage;
            $slug = trim("/credits/", "/");
            $updated = filemtime(SITE_ROOT . $content);

            $vars = [
                'layout' => $layout,
                'slug' => $slug,
                'updated' => $updated
            ];

            View::Twig($content, $vars, null);
            break;
        
        case "/site-map/":
        case "/site-map/index/":

            $content = DIR['content'] . "site-map.html.twig";
            $layout = DIR['layouts'] . "site-map_layout.html.twig";

            $vars = [
                'layout' => $layout
            ];

            View::Twig($content, $vars, null);
            break;
        
        case str_starts_with(REQUEST, "/feeds/"):

            Route::execute('feeds/feeds.php');
            break;

        case str_starts_with(REQUEST, "/guestbook/"):

            Route::execute('guestbook/guestbook.php');
            break;*/
        
        default:

            Route::NotFound();

   }
?>