<?php

    namespace JasminesJournal\Site\Views\Partials;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    include \Core\Views\Render\View::TWIG_PARTIAL;

    class NotesIndex_List {

        const SOURCE_DIR = SITE_ROOT . DIR['content'] . 'blog/notes';
        const TEMPLATE = DIR['layouts'] . "blog/notes/_notes_index.html.twig";

        public static function make() {

            $twig = \Core\Views\Render\Extension\PartialTwig::buildTwigEnv();

            $files = glob(self::SOURCE_DIR . "/*/*/*/entry.html.twig");
            asort($files, SORT_NATURAL);

            $content = [];

            foreach (array_reverse($files) as $article) {
                
                $dir = preg_split('/\/(src)/', $article);
                $content_path = "/src/{$dir[1]}";

                $slug_1 = rtrim($content_path, '.html.twig');
                $slug_2 = ltrim($slug_1, DIR['content'] . 'blog/notes');

                $content[] = $twig->render($content_path,
                    [
                        'layout' => self::TEMPLATE,
                        'slug' => $slug_2
                    ]);

            }

            return $content;

        }

    }

    

    //

    
    
    

?>