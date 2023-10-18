<?php
    // work in progress!!
    
    // GENERAL SETTINGS -------------------------------------------------------------------

    // the timezone referenced by the system for automatic timestamping.
    // suported timezones: https://www.php.net/manual/en/timezones.php
    $timezone = 'Asia/Jakarta';
    $max_entries = 10;

    // FEED METADATA //
    // certain characters must be escaped as HTML entities - note that XML only accepts five of them.
    // reference for character entities: https://en.wikipedia.org/wiki/List_of_XML_and_HTML_character_entity_references
    $feed_title = 'jasmine&apos;s b(rain)log | jasm1nii.xyz';
    $feed_subtitle = 'blog articles by jasmine';
    // location of the blog index page (or if unavailable, your main page).
    $blog_url = 'https://jasm1nii.xyz/blog/articles';
    // permalink to the XML feed on your site.
    $feed_url = 'https://jasm1nii.xyz/blog/articles/articles.xml';
    $author_name = 'jasmine';
    $author_email = 'contact@jasm1nii.xyz';
    $author_homepage = 'https://jasm1nii.xyz/';
    $feed_icon = 'https://jasm1nii.xyz/assets/media/itchio-textless-white.svg';
    $feed_logo = 'https://jasm1nii.xyz/assets/media/main/07042023-me_compressed.webp';

    // PATH TO FETCH PAGES FROM //
    // __DIR__ is the directory where *this script* is located.
    // in my case, i first need to go up two directories to get to the site root.
    $site_root = dirname(__DIR__, 2);
    // once i'm there, i specify the parent directory where i keep all of my blog pages.
    // because the values of $blog_root and $blog_entries will be used for generating entry links, forward slashes are a *must*.
    $blog_root = $site_root.'/blog/articles';
    // then, specify a pattern that matches the path of each individual page.
    // for example, this will match /YYYY/MM/DD/entry.html
    $blog_entries = $blog_root.'/*/*/*/*.html';

    // ENTRY METADATA //
    // depending on your site setup, this might not be the same as $blog_url.
    // the generator will appended $blog_root to the URL specified below.
    $blog_directory_url = 'https://jasm1nii.xyz/blog/articles';

    // NAME OF FEED FILE
    $file = 'articles.xml';

    // --------------------------------------------

    // create beginning of feed template.
    ob_start();
    date_default_timezone_set($timezone);

    // reference for required elements: https://validator.w3.org/feed/docs/atom.html
    echo    '<?xml version="1.0" encoding="utf-8"?>'
            .'<feed xmlns="http://www.w3.org/2005/Atom">'
            // optionally specify feed generator for debugging purposes.
            .'<generator uri="https://github.com/jasm1nii/xml-feed-generator" version="1.1">PHP feed generator by jasm1nii.xyz | Last modified by system at ' . strtoupper(date("h:i:sa")) . ' (GMT' . date('P') . ')</generator>'
            .'<title>' . $feed_title . '</title>'
            .'<subtitle>' . $feed_subtitle . '</subtitle>'
            .'<id>' . $blog_url . '</id>'
            .'<link rel="self" href="'. $feed_url .'" type="application/atom+xml"/>'
            .'<link rel="alternate" href="' . $blog_url .'" type="text/html"/>';

    // force libxml to parse all HTML elements, including HTML 5. by default, the extension can only read valid HTML 4.
    libxml_use_internal_errors(true);
    
    // match feed update time with the newest entry.
    $article_list = glob($blog_entries);
    $first_article = array_pop($article_list);
    $first_article_content = file_get_contents($first_article);
    $first_article_dom = new DOMDocument;
    $first_article_dom->loadHTML($first_article_content);
    $feed_updated = $first_article_dom->getElementsByTagName('time');
    if (!empty($feed_updated)) {
            $feed_datetime = $feed_updated[0]->getAttribute('datetime');
            if (strlen($feed_datetime) == 10) {
                echo    '<updated>' . $feed_datetime . 'T00:00:00' . date('P') .'</updated>';
            }
            elseif (strlen($feed_datetime) == 25 || strlen($feed_datetime) == 20) {
                echo    '<updated>' . $feed_datetime .'</updated>';
            }
    // if no RFC 3339 timestamp is found, use the file creation date.
    } else {
        $first_article_created = filectime($first_article);
        echo    '<updated>' . date(DATE_ATOM, $first_article_created) . '</updated>';
    }

    // rest of the template.
    echo    '<author>'
            .'<name>' . $author_name . '</name>'
            .'<email>' . $author_email . '</email>'
            .'<uri>' . $author_homepage . '</uri>'
            .'</author>'
            .'<icon>' . $feed_icon . '</icon>'
            .'<logo>' . $feed_logo . '</logo>';

    // output entries.
    $i = 0;
    foreach (array_reverse(glob($blog_entries)) as $article) {
        $article_content = file_get_contents($article);
        $article_dom = new DOMDocument;
        $article_dom->loadHTML($article_content);

        echo    '<entry>';

        $x = new DOMXPath($article_dom);

        // title
        $title_class = 'p-name';
        $title = $x->query("//*[@class='" . $title_class . "']");
        if ($title->length > 0) {
            echo    '<title>'. $title[0]->nodeValue . '</title>';
        } elseif ($title->length == 0)   {
            $title = $article_dom->getElementsByTagName('title');
            echo    '<title>'.$title[0]->nodeValue.'</title>';
        } else {
            echo    $feed_title;
        }

        // id
        echo    '<id>' . $blog_directory_url . '/' . ltrim($article, $blog_root) . '</id>';

        // alternate link
        echo    '<link rel="alternate" type="text/html" href="' . $blog_directory_url . '/' . ltrim($article, $blog_root) . '"/>';

        // date updated
        $updated_class = 'dt-updated';
        $updated = $x->query("//*[@class='" . $updated_class . "']");
        if ($updated->length > 0) {
            $timestamp = $updated[0]->getAttribute('datetime');
            if (strlen($timestamp) == 10) {
                echo    '<updated>' . $timestamp . 'T00:00:00' . date('P'). '</updated>';
            }
            elseif (strlen($timestamp) == 25 || strlen($timestamp) == 20) {
                echo    '<updated>' . $timestamp .'</updated>';
            }
        }
        if ($updated->length == 0) {
            $updated = $article_dom->getElementsByTagName('time');
            $timestamp = $updated[0]->getAttribute('datetime');
            if (strlen($timestamp) == 10) {
                echo    '<updated>' . $timestamp . 'T00:00:00' . date('P'). '</updated>';
            } elseif (strlen($timestamp) == 25 || strlen($timestamp) == 20) {
                echo    '<updated>' . $timestamp .'</updated>';
            } else {
            $article_created = filemtime($article);
            echo    '<updated>' . date(DATE_ATOM, $article_created) . '</updated>';
            }
        }

        // date published
        $published_class = 'dt-published';
        $published = $x->query("//*[@class='" . $published_class . "']");
        if ($published->length > 0) {
            $timestamp = $published[0]->getAttribute('datetime');
            if (strlen($timestamp) == 10) {
                echo    '<published>' . $timestamp . 'T00:00:00' . date('P'). '</published>';
            }
            elseif (strlen($timestamp) == 25 || strlen($timestamp) == 20) {
                echo    '<published>' . $timestamp .'</published>';
            }
        }
        if ($published->length == 0) {
            $published = $article_dom->getElementsByTagName('time');
            $timestamp = $published[0]->getAttribute('datetime');
            if (strlen($timestamp) == 10) {
                echo    '<published>' . $timestamp . 'T00:00:00' . date('P'). '</published>';
            } elseif (strlen($timestamp) == 25 || strlen($timestamp) == 20) {
                echo    '<published>' . $timestamp .'</published>';
            } else {
            $article_created = filectime($article);
            echo    '<published>' . date(DATE_ATOM, $article_created) . '</published>';
            }
        }

        // summary
        $summary_class = 'p-summary';
        $summary = $x->query("//*[@class='" . $summary_class . "']");
        if ($summary->length > 0) {
            echo    '<summary type="html">';
            echo    $summary->item(0)->nodeValue;
            echo    '</summary>';
        } elseif($summary->length == 0) {
            $summary = get_meta_tags($article)['description'];
            echo    '<summary type="html">';
            echo    $summary;
            echo    '</summary>';
        } else {
            echo    '<summary type="html">' . 'A summary of this content is not available.' . '</summary>';
        }

        // content
        $content_class = 'e-content';
        $content = $x->query("//*[@class='" . $content_class . "']");
        if ($content->length > 0) {
            // strip line breaks and output a maximum of 500 characters.
            echo    '<content type="html">' . preg_replace('/\s\s+/', ' ',(substr($content->item(0)->nodeValue,0,500))) . '... (read more on the original page)' . '</content>';
        } elseif (!empty($content)) {
            $content = $article_dom->getElementsByTagName('article');
            echo    '<content type="html">' . preg_replace('/\s\s+/', ' ',(substr($content->item(0)->nodeValue,0,500))) . '... (read more on the original page)' . '</content>';
        } else {
            echo    '<content type="html">' . 'Content could not be parsed as a preview - view the original article on the website.' . '</content>';
        }

        echo    '</entry>';

        if(++$i > ($max_entries-1)) break;
    }
    echo '</feed>';

    $xml_str = ob_get_contents();
    ob_end_clean();
    file_put_contents($blog_root . DIRECTORY_SEPARATOR . $file, $xml_str);

    echo    strtoupper(date("h:i:sa")) . ' - Feed successfully generated in ' . realpath($blog_root) . DIRECTORY_SEPARATOR . $file;
    echo    '<br/>Validate your feed at https://validator.w3.org/feed/';
?>