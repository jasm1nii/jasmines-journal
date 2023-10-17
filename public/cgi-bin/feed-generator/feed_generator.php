<?php
    // work in progress!!

    // create beginning of feed template.
    // reference for required elements: https://validator.w3.org/feed/docs/atom.html
    ob_start();
    date_default_timezone_set("Asia/Jakarta");

    echo    '<?xml version="1.0" encoding="utf-8"?>'
            .'<feed xmlns="http://www.w3.org/2005/Atom">'
            // optionally specify feed generator for debugging purposes.
            .'<generator version="1.0">jasmine&apos;s PHP feed generator!! | last modified by system at ' . strtoupper(date("h:i:sa")) . ' (GMT+7)</generator>'
            .'<title>jasmine&apos;s b(rain)log | jasm1nii.xyz</title>'
            .'<subtitle>blog articles by jasmine</subtitle>'
            .'<id>https://jasm1nii.xyz/blog/articles</id>';
    echo    '<link rel="self" href="https://jasm1nii.xyz/blog/articles/articles.xml" type="application/atom+xml"/>';
    echo    '<link rel="alternate" href="https://jasm1nii.xyz/blog/articles" type="text/html"/>';

    // define path to fetch pages from.
    $root = dirname(__DIR__, 2);
    $blog = $root.'/blog/articles';

    // force libxml to parse all HTML elements, including HTML 5. by default, the extension can only read valid HTML 4.
    libxml_use_internal_errors(true);
    
    // match feed update time with the newest entry.
    // i'm personally not using the system modification time to avoid sending uneccessary notifications to feed readers.
    $article_list = glob($blog.'/*/*/*/*.html');
    $first_article = array_pop($article_list);
    $first_article_content = file_get_contents($first_article);
    $first_article_dom = new DOMDocument;
    $first_article_dom->loadHTML($first_article_content);
    $feed_updated = $first_article_dom->getElementsByTagName('time');
    foreach ($feed_updated as $feed_updated_text) {
        echo    '<updated>' . $feed_updated_text->getAttribute('datetime') . 'T00:00:00+07:00</updated>';
    }

    // rest of the template.
    echo    '<author>'
            .'<name>jasmine</name>'
            .'<email>contact@jasm1nii.xyz</email>'
            .'<uri>https://jasm1nii.xyz/</uri>'
            .'</author>'
            .'<icon>https://jasm1nii.xyz/assets/media/itchio-textless-white.svg</icon>'
            .'<logo>https://jasm1nii.xyz/assets/media/main/07042023-me_compressed.webp</logo>';

    // output entries.
    $i = 0;
    foreach (array_reverse(glob($blog.'/*/*/*/*.html')) as $article) {
        $article_content = file_get_contents($article);
        $article_dom = new DOMDocument;
        $article_dom->loadHTML($article_content);

        echo    '<entry>';

        // title
        $title = $article_dom->getElementsByTagName('h2');
        foreach ($title as $title_text) {
            echo    '<title>'.$title_text->nodeValue.'</title>';
        }

        // id
        echo    '<id>https://jasm1nii.xyz/blog/articles/' . ltrim($article, $blog) . '</id>';

        // alternate link
        echo    '<link rel="alternate" type="text/html" href="https://jasm1nii.xyz/blog/articles/' . ltrim($article, $blog) . '"/>';

        $updated = $article_dom->getElementsByTagName('time');
        $t = 0;
        foreach ($updated as $updated_text) {
            echo    '<updated>' . $updated_text->getAttribute('datetime') . 'T00:00:00+07:00</updated>';
            if(++$t > 0) break;
        }

        // summary
        $x = new DOMXPath($article_dom);
        $summary_class = 'p-summary';
        $summary = $x->query("//*[@class='" . $summary_class . "']");
        if ($summary->length > 0) {
            echo    '<summary type="html">';
            echo    $summary->item(0)->nodeValue;
            echo    '</summary>';
        }

        // content
        // HTML entities must be escaped - note that XML only defines five of them.
        // reference: https://en.wikipedia.org/wiki/List_of_XML_and_HTML_character_entity_references
        $content_class = 'e-content';
        $content = $x->query("//*[@class='" . $content_class . "']");
        if ($content->length > 0) {
            echo    '<content type="html">' . preg_replace('/\s\s+/', ' ',(substr($content->item(0)->nodeValue,0,500))) . '... (&lt;a href="https://jasm1nii.xyz/blog/articles/' . ltrim($article, $blog) . '"&gt;read more&lt;/a&gt;)' . '</content>';
        } else {
            // fallback for older markup
            $content_class = 'entry';
            $content = $x->query("//*[@class='" . $content_class . "']");
            if ($content->length >= 0) {
                echo    '<content type="html">' . 'whoops - this page contains markup that can&apos;t be parsed for feed-reader friendliness. read more on the website!' . '</content>';
            }
        }

        echo    '</entry>';
        if(++$i > 9) break;
    }
    echo '</feed>';

    $xml_str = ob_get_contents();
    ob_end_clean();
    file_put_contents($blog.'/articles.xml', $xml_str);
?>