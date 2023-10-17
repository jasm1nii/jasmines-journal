<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include  __DIR__.'/../../assets/includes/head.shtml'?>
    <title>jasmine's b(rain)log</title>
    <meta name="description" content="my online diary"/>
    <link href="/assets/stylesheets/style-10.css" rel="stylesheet" type="text/css" media="all"/>
  </head>
  <body>
    <div id="layout">
        <div class="sidebar">
            <header>
                <div>
                    <button id="themeToggle">
                        switch theme
                    </button>
                    <noscript>
                        <small>unavailable</small>
                    </noscript>
                    <h1>
                        jasmine's b(rain)log
                    </h1>
                </div>
                <nav aria-label="primary">
                    <?php include __DIR__.'/../../assets/includes/headernav.shtml'?>
                </nav>
            </header>
        </div>
        <main>
            <article>
                <section>
                    <hgroup>
                        <h2>articles</h2>
                    </hgroup>
                    <ol reversed class="articles-list">
                        <?php
                            // references:
                                // directory functions:
                                // https://www.php.net/manual/en/book.dir.php
                                    // glob:
                                    // https://www.php.net/manual/en/function.glob.php
                            $dir = __DIR__.'/';

                            foreach(array_reverse(glob($dir . '*/*/*/*.html')) as $entry) {

                                $entry_content = file_get_contents($entry);
                                $entry_dom = new DOMDocument;
                                libxml_use_internal_errors(true);
                                $entry_dom->loadHTML($entry_content);

                                $title = $entry_dom->getElementsByTagName('h2');
                                $time = $entry_dom->getElementsByTagName('time');                    

                                foreach ($title as $title_text) {
                                    echo    '<li>
                                                <h3>
                                                    <a href="https://jasm1nii.xyz/blog/articles/', ltrim($entry, $dir) . '">' . $title_text->nodeValue .'</a>
                                                </h3>';
                                    foreach ($time as $time_text) {
                                        echo    '<time datetime="' . $time_text->getAttribute('datetime') .'">' . $time_text->nodeValue . '</time>';
                                    }
                                    echo    '</li>';
                                }
                            }
                        ?>
                    </ol>
                </section>
            </article>
        </main>
    </div>
    <footer>
        <?php include  __DIR__.'/../../assets/includes/footer.shtml'?>
    </footer>
    <script src="index.js"></script>
    <script src="/assets/scripts/theme-switcher.js"></script>
  </body>
</html>