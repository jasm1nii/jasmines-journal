<?php

    namespace JasminesJournal\Site\Views\Layouts;
    
    use JasminesJournal\Core\Views\Render\Layout;

    final class FeedsIndex extends Layout {

        protected string $layout = DIR['layouts'] . "feeds/feeds_index.html.twig";

        final protected function render(): void {

            parent::Twig($this->layout, null, null);

        }

    }

    final class FeedsPOST extends Layout {

        protected string $layout = DIR['layouts'] . "feeds/feeds_post.html.twig";

        final public function __construct(string $POST_redirect = null) {
            
            if ($POST_redirect == 'success' || $POST_redirect == null) {

                $this->title    = "yippee!!";
                $this->message  = "thanks for subscribing!";

            } elseif ($POST_redirect == 'error') {

                $this->title    = "aw shucks";
                $this->message  = "there was an error with your submission ☹";

            }

            $this->render();

        }

        final protected function render(): void {

            $vars = [
                "h2"        => $this->title,
                "message"   => $this->message
            ];

            parent::Twig($this->layout, $vars, null);

        }

    }

?>