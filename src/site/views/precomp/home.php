<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Core\View\Main\Layout;
    use JasminesJournal\Site\Models\GuestbookLatest;
    use JasminesJournal\Core\View\Extension\Utils;
    use JasminesJournal\Core\Route;


    final class Home extends Layout {

        protected string $layout = DIR['layouts'] . "home/home_layout.html.twig";
        protected static string $includes_path = DIR['layouts'] . "home/includes/";

        private static function getNewestGuestbookMessage(): ?array {

            try {

                $msg = new GuestbookLatest();
                $msg->get();

                return $msg->comment;

            } catch (Exception) {

                return null;

            };

        }

        private static function formatGuestbookDate(): ?string {

            $array = self::getNewestGuestbookMessage();

            if ($array !== null) {

                $date = $array['Date'];
                return Utils::formatTimeDifference(strtotime($date));

            } else {

                return null;

            };

        }

        final protected function render(): void {

            $vars = [
                'src'           => "/_assets/media/main",
                'message'       => self::getNewestGuestbookMessage(),
                'date'          => self::formatGuestbookDate(),
                'last_updated'  => Route::getLastUpdated(SITE_ROOT . DIR['content'] . '{changelog/*/*,blog/*/*.xml}'),
            ];

            parent::Twig($this->layout, $vars, self::$includes_path);

        }

    }
