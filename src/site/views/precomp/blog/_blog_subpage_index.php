<?php

    namespace JasminesJournal\Site\Views\Partials\Blog\Subpage;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    use JasminesJournal\Core\Views\Render\Extension;
    use JasminesJournal\Site\FileRouter\BlogEntry;
    use JasminesJournal\Site\Models\ArticlesDatabase;
    use JasminesJournal\Site\Models\NotesDatabase;

    final class Index {

        private static function getSlug(string $content_path, string $type): string {

            $base_slug = rtrim($content_path, '.html.twig');

            return ltrim($base_slug, DIR['content'] . "blog/{$type}");

        }

        private static function buildTwig(): object {

            return Extension\PartialTwig::buildTwigEnv();

        }

        private static function makeListFromRows(string $type, ?int $rows): ?array {

            $database = match ($type) {
                'articles' => new ArticlesDatabase,
                'notes'    => new NotesDatabase
            };

            $template   = DIR['layouts'] . "blog/{$type}/_{$type}_index.html.twig";
            $content    = [];

            foreach ($database->getEntries($rows) as $article) {

                $path = $article['File Path'];

                if (file_exists(SITE_ROOT . $path)) {

                    $content[] = self::buildTwig()->render($path,
                        [
                            'layout'    => $template,
                            'slug'      => self::getSlug($path, $type)
                        ]);
                    
                } else {

                    $database->removeMissing($path);

                }

            }

            return $content;

        }

        final public static function renderRows(string $type, ?int $rows): ?string {

            return implode("", self::makeListFromRows($type, $rows));

        }

    }