<?php

    namespace Site\Views\Layouts;

    use Core\Views\Render\View as View;

    final class FeedsIndex extends View {

        private static $layout = DIR['layouts'] . "feeds/feeds_index.html.twig";

        public function __construct() {

            parent::Twig(self::$layout, null, null);

        }

    }

    final class FeedsPOST extends View {

        private static $layout = DIR['layouts'] . "feeds/feeds_post.html.twig";

        public function __construct($POST_redirect) {
            
            if ($POST_redirect == 'success' || $POST_redirect == null) {

                $title = "yippee!!";

                $message = "thanks for subscribing!";

            } elseif ($POST_redirect == 'error') {

                $title = "aw shucks";

                $message = "there was an error with your submission ☹";

            }

            $vars = [
                "h2"        => $title,
                "message"   => $message
            ];

            parent::Twig(self::$layout, $vars, null);

        }


    }

?>