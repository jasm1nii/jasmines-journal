<?php
    class Feeds {

        const Index = "/feeds/";
        const Success = self::Index . "success/";
        const Error = self::Index . "error/";

        const IndexLayout = DIR['layouts'] . "feeds/feeds_index.php";
        const POSTLayout = DIR['layouts'] . "feeds/feeds_post.html.twig";

        public static function loadSubpage($title, $message) {
            $vars = [
                "h2" => $title,
                "message" => $message
            ];

            View::Twig(self::POSTLayout, $vars);
        }

        public static function loadDefault() {

            require SITE_ROOT . self::IndexLayout;
            
        }
    }

    if (REQUEST == Feeds::Index) {

        Feeds::loadDefault();

    } else {

        switch (REQUEST) {

            case Feeds::Success:

                Feeds::loadSubpage("yippee!!", "thanks for subscribing!");
                break;

            case Feeds::Error:

                Feeds::loadSubpage("aw shucks", "there was an error with your submission ☹");
                break;

            default:

                Feeds::loadDefault();
                
        }

    }
?>