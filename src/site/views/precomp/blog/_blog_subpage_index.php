<?php

    namespace JasminesJournal\Site\Views\Partials\Blog\Subpage;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    use JasminesJournal\Core\Views\Render\Extension;
    use JasminesJournal\Site\FileRouter\BlogEntry;
    use JasminesJournal\Site\Models\Blog\NotesDatabase;

    final class Index {

        // BlogEntry::matchURLToFile() isn't used, because matching with the index URL (instead of the entry URL) will return an invalid result.

        #[\Depreciated]
        private static function getContent(string $file): ?string {

            return preg_split('/(' . preg_quote(SITE_ROOT, '/') . ')/', $file)[1];

        }

        private static function getSlug(string $content_path, string $type): string {

            $base_slug = rtrim($content_path, '.html.twig');

            return ltrim($base_slug, DIR['content'] . "blog/{$type}");

        }

        private static function buildTwig(): object {

            return Extension\PartialTwig::buildTwigEnv();

        }

        #[\Depreciated]
        private static function makeList(string $type, string $source): ?array {

            $template = DIR['layouts'] . "blog/{$type}/_{$type}_index.html.twig";

            $content = [];

            foreach (BlogEntry::getFiles($source) as $article) {
                
                $content_path = self::getContent($article);

                $content[] = self::buildTwig()->render($content_path,
                    [
                        'layout'    => $template,
                        'slug'      => self::getSlug($content_path, $type)
                    ]);

            }

            return $content;

        }

        private static function makeListFromRows(string $type, ?int $rows): ?array {

            $database = match ($type) {
                'articles' => null,
                'notes'    => new NotesDatabase
            };

            $template = DIR['layouts'] . "blog/{$type}/_{$type}_index.html.twig";

            $content = [];

            foreach ($database->getEntries($rows) as $article) {

                $content[] = self::buildTwig()->render($article['File Path'],
                    [
                        'layout'    => $template,
                        'slug'      => self::getSlug($article['File Path'], $type)
                    ]);

            }

            return $content;

        }

        #[\Depreciated]
        final public static function render(string $type): ?string {

            $source = SITE_ROOT . DIR['content'] . "blog/{$type}";

            return implode("", self::makeList($type, $source));

        }

        final public static function renderRows(string $type, ?int $rows): ?string {

            return implode("", self::makeListFromRows($type, $rows));

        }

    }

?>