<?php
    class About {

        const Partial = SITE_ROOT . DIR['includes'] . "_headernav_about-changelog.php";

        public static function Nav() {

            include self::Partial;
            return $nav_html;

        }
    }

    switch (REQUEST) {

        case "/about/":
        case "/about/index/":

            $page = DIR['content'] . "about.html.twig";
            $vars = [
                "layout" => DIR['layouts'] . "about_layout.html.twig",
                "nav" => About::Nav(),
                "updated" => filemtime(SITE_ROOT . $page)
            ];

            View::Twig($page, $vars, null);

            break;

        case str_starts_with(REQUEST, "/about/changelog/"):

            Route::execute('changelog/changelog.php');
            break;
    
    }

?>