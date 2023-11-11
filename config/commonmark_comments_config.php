<?php
    use League\CommonMark\Environment\Environment;
    use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
    use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
    use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
    use League\CommonMark\GithubFlavoredMarkdownConverter;

    // Default values are shown below - you can omit this configuration if you're happy with those defaults
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