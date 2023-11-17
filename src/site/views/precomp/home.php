<?php

    namespace Site\Views\Layouts;

    include SITE_ROOT . DIR['models'] . "guestbook/guestbook_preview.php";
    use Core\Views\Render\View as View;
    use Site\Models\NewestMessage as NewestMessage;

    include View::UTILS;
    use Core\Views\Render\Extension\Utils as Utils;

    //

    final class Home extends View {

        const LAYOUT = DIR['layouts'] . "home/home_layout.html.twig";
        const INCLUDES = DIR['layouts'] . "home/includes/";

        private static function getNewestGuestbookMessage() {

            return NewestMessage::get();

        }

        private static function formatGuestbookDate() {

            $date = self::getNewestGuestbookMessage()['Date'];

            return Utils::formatTimeDifference(strtotime($date));

        }

        public function __construct() {

            $vars = [
                'src'       => "/_assets/media/main",
                'message'   => self::getNewestGuestbookMessage(),
                'date'      => self::formatGuestbookDate()
            ];

            parent::Twig(self::LAYOUT, $vars, self::INCLUDES);

        }

    }

?>
