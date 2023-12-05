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

        public static function convert(string $abs_file_path): string {

            $commonmark_config = [

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

            $commonmark_env = new Environment($commonmark_config);

            $commonmark_env->addExtension(new CommonMarkCoreExtension());
            $commonmark_env->addExtension(new HeadingPermalinkExtension());
            $commonmark_env->addExtension(new TableOfContentsExtension());
            $commonmark_env->addExtension(new DescriptionListExtension());

            $commonmark = new MarkdownConverter($commonmark_env);

            return $commonmark->convert(file_get_contents($abs_file_path));

        }

    }

?>