<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include dirname(__DIR__,3).'/resources/includes/head.shtml';?>
    <title>jasmine's notes</title>
    <meta name="description" content="microblog entries"/>
    <link href="/_assets/stylesheets/blog_index.css" rel="stylesheet" type="text/css" media="all"/>
  </head>
  <body>
    <div id="layout">
        <div class="sidebar">
            <header>
                <hgroup>
                    <h1>jasmine's notes</h1>
                </hgroup>
                <nav>
                    <?php
                        $nav = new DOMDocument;
                        $nav->loadHTMLFile(dirname(__DIR__,3).'/resources/includes/headernav.shtml');
                        $blog_index = $nav->getElementById('blog');
                        $blog_subindex = $nav->createElement('ul');
                        $blog_index->appendChild($blog_subindex);

                        $articles_index = $nav->createElement('li');
                        $blog_subindex->appendChild($articles_index);
                        $articles_a = $nav->createElement('a','articles');
                        $articles_a_href = $nav->createAttribute('href');
                        $articles_a_href->value = '/blog/articles';
                        $articles_a->appendChild($articles_a_href);
                        $articles_index->appendChild($articles_a);

                        $notes_index = $nav->createElement('li');
                        $blog_subindex->appendChild($notes_index);
                        $notes_a = $nav->createElement('a','notes');
                        $notes_a_href = $nav->createAttribute('href');
                        $notes_a_href->value = '/blog/articles';
                        $notes_a->appendChild($notes_a_href);
                        $notes_index->appendChild($notes_a);

                        echo $nav->saveHTML();
                    ?>
                </nav>
            </header>
        </div>
        <main>
            <div>
                <noscript>
                    <section>
                        <p>
                            sorry, this archive uses javascript to render the feed from an XML file - <a href="/blog/notes/notes.xml">read its contents here</a>.
                        </p>
                    </section>
                </noscript>
                <section>
                    <p>
                        subscribe via <a href="/blog/notes/notes.xml">atom</a> / follow via <a href="https://fed.brid.gy/web/jasm1nii.xyz" rel="external me">fediverse</a>
                    </p>
                    <div id="notesArchive"></div>
                </section>
            </div>
        </main>
    </div>
    <footer>
        <?php include dirname(__DIR__,3).'/resources/includes/footer.shtml'?>
    </footer>
    <script src="index.js"></script>
    <script src="/_assets/scripts/notes-archive.js"></script>
    <script src="/_assets/scripts/theme-switcher-v2.js"></script>
  </body>
</html>