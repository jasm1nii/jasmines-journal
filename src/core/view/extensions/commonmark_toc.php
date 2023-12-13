<?php

    namespace JasminesJournal\Core\Views\Render\Extension;

    use League\CommonMark\Environment\Environment;

    use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
    use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
    use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer;
    use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
    use League\CommonMark\Extension\DescriptionList\DescriptionListExtension;

    use League\CommonMark\MarkdownConverter;

    class MarkdownWithTOC {

        private static array $config = [

            'heading_permalink' => [
                'html_class'            => 'heading-permalink',
                'id_prefix'             => '',
                'apply_id_to_heading'   => true,
                'heading_class'         => '',
                'fragment_prefix'       => '',
                'insert'                => 'before',
                'min_heading_level'     => 1,
                'max_heading_level'     => 6,
                'title'                 => 'Permalink',
                'symbol'                => HeadingPermalinkRenderer::DEFAULT_SYMBOL,
                'aria_hidden'           => true,
            ],

            'table_of_contents' => [
                'html_class'            => 'table-of-contents',
                'position'              => 'placeholder',
                'style'                 => 'bullet',
                'min_heading_level'     => 1,
                'max_heading_level'     => 6,
                'normalize'             => 'relative',
                'placeholder'           => '[TOC]',
            ],
            
        ];

        private static function configureEnvironment(): object {

            $env = new Environment(self::$config);

            $env->addExtension(new CommonMarkCoreExtension());
            $env->addExtension(new HeadingPermalinkExtension());
            $env->addExtension(new TableOfContentsExtension());
            $env->addExtension(new DescriptionListExtension());

            return new MarkdownConverter($env);

        }

        public static function convert(string $abs_file_path): string {

            $commonmark = self::configureEnvironment();

            return $commonmark->convert(file_get_contents($abs_file_path));

        }

    }