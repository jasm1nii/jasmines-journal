<?php
    require_once dirname(__DIR__,1).'/src/vendor/autoload.php';

    use League\CommonMark\Environment\Environment;
    use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
    use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
    use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
    use League\CommonMark\GithubFlavoredMarkdownConverter;

    // Customize the extension's configuration if needed
    // Default values are shown below - you can omit this configuration if you're happy with those defaults
    // and don't want to customize them
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
?>