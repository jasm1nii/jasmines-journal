<?php

    namespace JasminesJournal\Site\Views\Partials\Blog\Subpage;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    use JasminesJournal\Core\View\Extension;
    use JasminesJournal\Site\Models\ArticlesDatabase;
    use JasminesJournal\Site\Models\NotesDatabase;

    final class Index {

        private static function buildTwig(): object {

            return Extension\PartialTwig::buildTwigEnv();

        }

        final public static function renderRows(
            string $type,
            ?int $rows,
            ?string $sort_tag = null
        ): ?string {

            $database = match ($type) {
                'articles' => new ArticlesDatabase,
                'notes'    => new NotesDatabase
            };

            $content    = [];
            $template   = DIR['layouts'] . "blog/{$type}/_{$type}_index.html.twig";

            $articles = $database->getEntries(
                row_limit: $rows,
                sort_tag: $sort_tag
            );

            $i = 0;
            foreach ($articles as $article) {

                $path = $article['File Path'];

                if (file_exists(SITE_ROOT . $path)) {

                    $content[] = self::buildTwig()->render($path,
                        [
                            'layout'    => $template,
                            'slug'      => $article['Relative URL'],
                            'id'        => $article['ID']
                        ]);

                } else {

                    $database->removeMissing($path);

                }

            }

            return implode("", $content);

        }

    }