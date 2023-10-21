<?php
    date_default_timezone_set($timezone);

    $i = 0;
    foreach ((glob($blog_entries)) as $article) {
        $article_content = file_get_contents($article);
        // force libxml to parse all HTML elements, including HTML 5. by default, the extension can only read valid HTML 4.
        libxml_use_internal_errors(true);
        $article_dom = new DOMDocument;
        $article_dom->loadHTML($article_content);
        $x = new DOMXPath($article_dom);

        // title
        $title_class = 'p-name';
        $title = $x->query("//*[@class='" . $title_class . "']");
        if ($title->length > 0) {
            $title_data = $title[0]->nodeValue;
        } elseif ($title->length == 0)   {
            $title = $article_dom->getElementsByTagName('title');
            $title_data = $title[0]->nodeValue;
        } else {
            $title_data = $feed_title;
        }

        // id & alternate link
        $id_data = $blog_directory_url . '/' . ltrim($article, $blog_root);

        // date updated
        $updated_class = 'dt-updated';
        $updated = $x->query("//*[@class='" . $updated_class . "']");
        if ($updated->length > 0) {
            $timestamp = $updated[0]->getAttribute('datetime');
            if (strlen($timestamp) == 10) {
                $updated_data = $timestamp . 'T00:00:00' . date('P');
            }
            elseif (strlen($timestamp) == 25 || strlen($timestamp) == 20) {
                $updated_data = $timestamp;
            }
        }
        if ($updated->length == 0) {
            $updated = $article_dom->getElementsByTagName('time');
            $timestamp = $updated[0]->getAttribute('datetime');
            if (strlen($timestamp) == 10) {
                $updated_data = $timestamp . 'T00:00:00' . date('P');
            } elseif (strlen($timestamp) == 25 || strlen($timestamp) == 20) {
                $updated_data = $timestamp;
            } else {
                $article_modified = filemtime($article);
                $updated_data = date(DATE_ATOM, $article_modified);
            }
        }

        // date published
        $published_class = 'dt-published';
        $published = $x->query("//*[@class='" . $published_class . "']");
        if ($published->length > 0) {
            $timestamp = $published[0]->getAttribute('datetime');
            if (strlen($timestamp) == 10) {
                $published_data = $timestamp . 'T00:00:00' . date('P');
            }
            elseif (strlen($timestamp) == 25 || strlen($timestamp) == 20) {
                $published_data = $timestamp;
            }
        }
        if ($published->length == 0) {
            $published = $article_dom->getElementsByTagName('time');
            $timestamp = $published[0]->getAttribute('datetime');
            if (strlen($timestamp) == 10) {
                $published_data = $timestamp . 'T00:00:00' . date('P');
            } elseif (strlen($timestamp) == 25 || strlen($timestamp) == 20) {
                $published_data = $timestamp;
            } else {
                $article_created = filectime($article);
                $published_data = date(DATE_ATOM, $article_created);
            }
        }

        // content
        $content_class = 'e-content';
        $content = $x->query("//*[@class='" . $content_class . "']");
        if ($content->length > 0) {
            $content_data = $content->item(0)->nodeValue;
        } elseif (!empty($content)) {
            $content = $article_dom->getElementsByTagName('article');
            $content_data = $content->item(0)->nodeValue;
        } else {
            $content_data = 'Content could not be parsed as a preview - view the original article on the website.';
        }

        if(++$i > ($max_entries-1) ) break;
        $data[$i] = [
            'title'=>$title_data,
            'id'=>$id_data,
            'updated'=>$updated_data,
            'published'=>$published_data,
            'content'=>$content_data
        ];
    }
    
    $updated = array_column($data, 'updated');
    array_multisort($updated, SORT_DESC, $data);

    $sxe = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><feed xmlns="http://www.w3.org/2005/Atom"></feed>');

    // optionally specify feed generator for debugging purposes.
    $generator = $sxe->addChild('generator', 'PHP feed generator by jasm1nii.xyz | Last modified by system at ' . strtoupper(date("h:i:sa")) . ' (GMT' . date('P') . ')');
    $generator->addAttribute('version','1.2');
    $generator->addAttribute('uri','https://github.com/jasm1nii/xml-feed-generator');

    $sxe->addChild('title', $feed_title);
    $sxe->addChild('subtitle', $feed_subtitle);
    $sxe->addChild('updated', $data[0]['updated']);

    $sxe->addChild('id', $blog_url);
    $link_self = $sxe->addChild('link');
    $link_self->addAttribute('rel','self');
    $link_self->addAttribute('type', 'application/atom+xml');
    $link_self->addAttribute('href', $feed_url);
    
    $link_alternate = $sxe->addChild('link');
    $link_alternate->addAttribute('rel','alternate');
    $link_alternate->addAttribute('type', 'text/html');
    $link_alternate->addAttribute('href', $blog_url);

    $author = $sxe->addChild('author');
    $author->addChild('name', $author_name);
    $author->addChild('email', $author_email);
    $author->addChild('uri', $author_homepage);

    $sxe->addChild('rights', $rights);
    $sxe->addChild('icon', $feed_icon);
    $sxe->addChild('logo', $feed_logo);

    for ($i=0; $i < count($data); $i++) {
        $entry = $sxe->addChild('entry');

        $title = $data[$i]['title'];
        $entry->addChild('title', $title);

        $id = $data[$i]['id'];
        $entry->addChild('id', $id);
        $alt_entry = $entry->addChild('link');
        $alt_entry->addAttribute('rel','alternate');
        $alt_entry->addAttribute('type','text/html');
        $alt_entry->addAttribute('href',$id);

        $updated = $data[$i]['updated'];
        $entry->addChild('updated',$updated);

        $published = $data[$i]['published'];
        $entry->addChild('published',$published);

        $content = $data[$i]['content'];
        $content_child = $entry->addChild('content', nl2br(preg_replace("/\n\s+/", "",(htmlspecialchars($content, ENT_XML1)))));
        $content_child->addAttribute('type','html');
    }

    echo $sxe->saveXML($blog_root . DIRECTORY_SEPARATOR . $file);

    echo    nl2br(strtoupper(date("h:i:sa")) . ' - Feed successfully generated in ' . realpath($blog_root) . DIRECTORY_SEPARATOR . $file . "\n");
    echo    'Validate your feed at https://validator.w3.org/feed/';
?>