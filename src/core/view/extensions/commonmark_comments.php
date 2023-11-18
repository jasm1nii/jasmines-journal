<?php

    namespace JasminesJournal\Core\Views\Render\Extension;

    use League\CommonMark\Environment\Environment;
    use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
    use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
    use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
    use League\CommonMark\GithubFlavoredMarkdownConverter;

    class MarkdownComments {

        public static function convert($content) {

            $config = [
                'html_input' => 'strip',
                'disallowed_raw_html' => [
                    'disallowed_tags' => ['title', 'textarea', 'style', 'xmp', 'iframe', 'noembed', 'noframes', 'script', 'plaintext'],
                ],
                'allow_unsafe_links' => false
            ];

            $environment = new Environment($config);
            $environment->addExtension(new CommonMarkCoreExtension());
            $environment->addExtension(new DisallowedRawHtmlExtension());

            $commonmark = new GithubFlavoredMarkdownConverter();

            $output = $commonmark->convert($content);

            return $output;

        }
    
    }

?>