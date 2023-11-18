<?php

    namespace JasminesJournal\Site\Views\Layouts;

    include SITE_ROOT . DIR['models'] . "guestbook/guestbook_preview.php";
    use JasminesJournal\Core\Views\Render\View as View;
    use JasminesJournal\Site\Models\GuestbookLatest as GuestbookLatest;

    include View::UTILS;
    use JasminesJournal\Core\Views\Render\Extension\Utils as Utils;

    //

    final class Home extends View {

        const LAYOUT = DIR['layouts'] . "home/home_layout.html.twig";
        const INCLUDES = DIR['layouts'] . "home/includes/";

        private static function getNewestGuestbookMessage() {

            try {

                return GuestbookLatest::get();

            } catch (\PDOException $e) {

                return ['Date' => 0];

            }

        }

        private static function formatGuestbookDate() {
            

            $date = self::getNewestGuestbookMessage()['Date'];

            if ($date == 0) {

                $formatted = null;

            } else {

                $formatted =  Utils::formatTimeDifference(strtotime($date));

            }

            return $formatted;

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
