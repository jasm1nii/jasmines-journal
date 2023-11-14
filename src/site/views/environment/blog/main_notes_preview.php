<?php

    $notes_xml = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/notes.xml');
    $notes_doc = new DOMDocument();
    $notes_doc->loadXML($notes_xml);

    $notes_pub = $notes_doc->getElementsByTagName('published')->item(0)->textContent;

    $notes_link = $notes_doc->getElementsByTagName('id')->item(1)->textContent;

    $notes_title = $notes_doc->getElementsByTagName('title')->item(1)->textContent;

    $notes_title_html = str_replace(" | jasmine's notes", "", $notes_title);

    $notes_content = $notes_doc->getElementsByTagName('content')->item(0)->textContent;
    
    //

    $notes_preview = "<article>";

    $notes_preview .= "<div><img src='/_assets/media/main/oingo-boingo.png' alt='profile picture' class='u-photo'/></div>";

    $notes_preview .= "<div>";
    
    $notes_preview .= "<h3 class='p-name'><time datetime='{$notes_pub}'><a href='{$notes_link}'>{$notes_title_html}</a></time></h3>";

    $notes_preview .= "<p id='latest-note-content' class='e-content'>{$notes_content}</p>";
    
    $notes_preview .= "</div></article>";

?>
