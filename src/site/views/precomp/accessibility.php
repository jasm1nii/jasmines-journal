<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Site\Views\Layouts\DefaultLayout;
    use JasminesJournal\Core\Views\Render\Layout;

    final class Accessibility extends Layout {

        use DefaultLayout;

        protected string $content = DIR['content'] . "accessibility.html.twig";

        final protected function render(): void {

            parent::Twig($this->content, $this->setVars(), null);

        }

    }

?>