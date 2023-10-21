<?php
    // GENERAL SETTINGS ---------------------------------------- //

    # the timezone referenced by the system for automatic timestamping.
    # suported timezones: https://www.php.net/manual/en/timezones.php
    $timezone = 'Asia/Jakarta';
    $max_entries = 10;
    // NAME OF FEED FILE
    $file = 'articles.xml';

    // FEED METADATA
    # &, <, >, ', and " must be escaped as &amp;, &lt;, &gt;, &apos;, and &quot; (reference: https://en.wikipedia.org/wiki/List_of_XML_and_HTML_character_entity_references)
    
    $feed_title = 'jasmine&apos;s b(rain)log | jasm1nii.xyz';
    $feed_subtitle = 'blog articles by jasmine';

    ## location of the blog index page (or if unavailable, your main page).
    $blog_url = 'https://jasm1nii.xyz/blog/articles';

    ## permalink to the XML feed on your site.
    $feed_url = 'https://jasm1nii.xyz/blog/articles/articles.xml';

    ## information about the feed author.
    $author_name = 'jasmine';
    $author_email = 'contact@jasm1nii.xyz';
    $author_homepage = 'https://jasm1nii.xyz/';

    $feed_icon = 'https://jasm1nii.xyz/assets/media/itchio-textless-white.svg';
    $feed_logo = 'https://jasm1nii.xyz/assets/media/main/07042023-me_compressed.webp';
    $rights = '© 2023 - jasmine amalia';

    /* -------------------- */

    // PATH TO FETCH PAGES FROM
    ## __DIR__ is the directory where *this script* is located.
    $site_root = dirname(__DIR__, 2).'/public_html';

    ## once i'm there, i specify the parent directory where i keep all of my blog pages.
    ## because the values of $blog_root and $blog_entries will be used for generating entry links, forward slashes are a *must*.
    $blog_root = $site_root.'/blog/articles';

    ## then, specify a pattern that matches the path of each individual page. for example, this will match /YYYY/MM/DD/entry (any file extension).
    $blog_entries = $blog_root.'/*/*/*/[entry]*';

    /* -------------------- */

    // ENTRY METADATA
    ## depending on your site setup, this might not be the same as $blog_url.
    ## the generator will appended $blog_root to the URL specified below.
    $blog_directory_url = 'https://jasm1nii.xyz/blog/articles';

    // END OF CONFIG ---------------------------------------- //

    require __DIR__.'/feed_generator_functions.php';
?>