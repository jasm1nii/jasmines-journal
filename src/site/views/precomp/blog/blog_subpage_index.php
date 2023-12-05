<?php

    namespace JasminesJournal\Site\Views\Partials\Blog\Subpage;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    use JasminesJournal\Core\Views\Render\Extension;
    use JasminesJournal\Site\FileRouter\BlogEntry;

    final class Index {

        // BlogEntry::matchURLToFile() isn't used, because matching with the index URL (instead of the entry URL) will return an invalid result.

        private static function getContent(string $file): ?string {

            $dir = preg_split('/\/(src)/', $file);

            return "/src/{$dir[1]}";

        }

        private static function getSlug(string $content_path, string $type): string {

            $base_slug = rtrim($content_path, '.html.twig');

            return ltrim($base_slug, DIR['content'] . "blog/{$type}");

        }

        private static function buildTwig(): object {

            return Extension\PartialTwig::buildTwigEnv();

        }

        private static function makeList(string $type, string $source, string $template): ?array {

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

        final public static function render(string $type): ?string {

            $source     = SITE_ROOT . DIR['content'] . "blog/{$type}";
            $template   = DIR['layouts'] . "blog/{$type}/_{$type}_index.html.twig";

            return implode("", self::makeList($type, $source, $template));

        }

    }

?>