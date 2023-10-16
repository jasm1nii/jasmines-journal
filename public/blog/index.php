<?php
    // import notes.xml
    $notes_xml_source = file_get_contents("notes/notes.xml", FILE_USE_INCLUDE_PATH);
    $notes_xml = new DOMDocument('notes_source');
    $notes_xml->loadXML($notes_xml_source);

    // get information from child elements of first feed entry.
    $notes_title = $notes_xml->getElementsByTagName("title")->item(1);
    $notes_url = $notes_xml->getElementsByTagName("id")->item(1);
    $notes_content = $notes_xml->getElementsByTagName("content")->item(0);

    // import blog index template.
    $blog_index = file_get_contents("blog_index_template.html", FILE_USE_INCLUDE_PATH);
    $main_dom = new DOMDocument('main');
    // force libxml to ignore errors from parsing valid HTML 5 markup; PHP's DOM manipulator will throw a hissy fit if you don't, because it only recognizes HTML 4 elements.
    libxml_use_internal_errors(true);
    $main_dom->loadHTML($blog_index, LIBXML_NOERROR);

    // import children of feed entry into blog index DOM, then return their text values.
    $notes_title = $main_dom->importNode($notes_title, true);
    $notes_title = new DOMText($notes_title->textContent);
    $notes_url = $main_dom->importNode($notes_url, true)->nodeValue;
    $notes_content = $main_dom->importNode($notes_content, true)->nodeValue;

    // fill in post title.
    $notes_title_dom = $main_dom->getElementById('latest-note-title');
    $notes_title_dom->appendChild($notes_title);

    // link to post within title.
    $notes_title_dom->setAttribute('href', $notes_url);

    // fill in post content.
    $notes_content_dom = $main_dom->getElementById('latest-note-content');
    // this will render HTML entities as their corresponding tags (e.g, > as &gt;), if any markup is present.
    $p_inner = $main_dom->createDocumentFragment();
    $p_inner->appendXML($notes_content);
    $notes_content_dom->appendChild($p_inner);

    echo $main_dom->saveHTML();
?>