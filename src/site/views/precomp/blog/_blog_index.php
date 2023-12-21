<?php

    namespace JasminesJournal\Site\Views\Partials\Blog;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    use JasminesJournal\Core\View\Extension;
    use JasminesJournal\Site\FileRouter\BlogEntry;
    use JasminesJournal\Site\Models\ArticlesDatabase;
    use JasminesJournal\Site\Models\NotesDatabase;

    abstract class IndexSection {

        protected static string $source_dir;
        protected static string $template;
        protected static object $database;

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

            $type = get_called_class();
            $slug = rtrim($content_path, '.html.twig');

            return ltrim($slug, DIR['content'] . "blog/{$type}");

        }

        private static function buildTwig(): object {

            return Extension\PartialTwig::buildTwigEnv();

        }

        final protected static function renderTwig(string $file, ?bool $use_db = false): ?string {

            $entry = $use_db ? $file : self::getContent($file);

            return self::buildTwig()->render(
                $entry,
                [
                    'layout'    => static::$template,
                    'slug'      => self::getSlug($entry)
                ]
            );

        }

        abstract protected static function makeList(): ?string;

        final public static function getTags(): ?array {

            static::$database->getTags();

            return static::$database->unique_tag_count;
            
        }

    }

    final class Notes extends IndexSection {

        protected static string $source_dir
            = SITE_ROOT . DIR['content'] . 'blog/notes';
        
        protected static string $template
            = DIR['layouts'] . "blog/_blog_notes_preview.html.twig";

        final public static function makeList(): ?string {

            static::$database = new NotesDatabase;
            $file = static::$database->getNewestEntry();

            return parent::renderTwig(
                file: $file, use_db: true
            );

        }

    }

    final class Articles extends IndexSection {

        protected static string $source_dir
            = SITE_ROOT . DIR['content'] . 'blog/articles';

        protected static string $template
            = DIR['layouts'] . "blog/_blog_articles_preview.html.twig";

        final public static function makeList(): ?string {

            static::$database = new ArticlesDatabase;
            $content = [];

            foreach (static::$database->getEntries(row_total: 5) as $file) {

                $content[] = parent::renderTwig(
                    file: $file['File Path'], use_db: true
                );

            }

            return implode("", $content);

        }

    }

?>