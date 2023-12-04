<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\Views\Render\View;
    use JasminesJournal\Site\Models\GuestbookLatest;
    use JasminesJournal\Core\Views\Render\Extension\Utils;
    use JasminesJournal\Core\Route;


    final class Home extends View {

        const LAYOUT    = DIR['layouts'] . "home/home_layout.html.twig";
        const INCLUDES  = DIR['layouts'] . "home/includes/";

        private static function getNewestGuestbookMessage(): ?array {

            try {

                return GuestbookLatest::get();

            } catch (\PDOException $e) {

                return null;

            }

        }

        private static function formatGuestbookDate(): ?string {

            $array = self::getNewestGuestbookMessage();

            if ($array !== null) {
            
                $date = $array['Date'];

                return Utils::formatTimeDifference(strtotime($date));

            } else {

                return null;

            }

        }

        public function __construct() {

            $vars = [
                'src'           => "/_assets/media/main",
                'message'       => self::getNewestGuestbookMessage(),
                'date'          => self::formatGuestbookDate(),
                'last_updated'  => Route::getLastUpdated(SITE_ROOT . DIR['content'] . '{changelog/*/*,blog/*/*.xml}')
            ];

            parent::Twig(self::LAYOUT, $vars, self::INCLUDES);

        }

    }

?>
