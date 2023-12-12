<?php

    namespace JasminesJournal\Site\Views\Partials\Blog;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    use JasminesJournal\Core\Views\Render\Extension;
    use JasminesJournal\Site\FileRouter\BlogEntry;

    abstract class IndexSection {

        protected static string $source_dir;
        protected static string $template;

        final protected static function getFiles(): ?array {

            return BlogEntry::getFiles(static::$source_dir);

        }

        // BlogEntry::matchURLToFile() isn't used, because matching with the index URL (instead of the entry URL) will return an invalid result.

        private static function getContent(string $file): ?string {

            $dir = preg_quote(SITE_ROOT, '/');
            $path = preg_split('/(' . $dir .')/', $file);

            return $path[1];

        }

        private static function getSlug(string $content_path): ?string {

            $type = get_class();
            $slug = rtrim($content_path, '.html.twig');

            return ltrim($slug, DIR['content'] . "blog/{$type}");

        }

        private static function buildTwig(): object {

            return Extension\PartialTwig::buildTwigEnv();

        }

        final protected static function renderTwig(string $file): ?string {

            return self::buildTwig()->render(
                self::getContent($file),
                [
                    'layout'    => static::$template,
                    'slug'      => self::getSlug(self::getContent($file))
                ]
            );

        }

        abstract protected static function makeList(): ?string;

    }

    final class Notes extends IndexSection {

        protected static string $source_dir    = SITE_ROOT . DIR['content'] . 'blog/notes';
        
        protected static string $template      = DIR['layouts'] . "blog/_blog_notes_preview.html.twig";

        final public static function makeList(): ?string {

            $file = parent::getFiles()[0];

            $content = parent::renderTwig($file);

            return $content;

        }

    }

    final class Articles extends IndexSection {

        protected static string $source_dir    = SITE_ROOT . DIR['content'] . 'blog/articles';

        protected static string $template      = DIR['layouts'] . "blog/_blog_articles_preview.html.twig";

        final public static function makeList(): ?string {

            $content = [];

            $i = 0;

            foreach (parent::getFiles() as $file) {

                $content[] = parent::renderTwig($file);

                if (++$i > 4) break;

            }

            return implode("", $content);

        }

    }

?>