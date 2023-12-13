<?php

    namespace JasminesJournal\Site\Views\Layouts;

    use JasminesJournal\Site\Views\Layouts\DefaultLayout;

    final class Credits extends DefaultLayout {

        protected string $content = DIR['content'] . "credits.html.twig";

        final protected function render(): void {

            parent::Twig($this->content, $this->setVars(), null);

        }

    }