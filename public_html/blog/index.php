<?php
    $notes_xml = file_get_contents(__DIR__.'/notes/notes.xml');
    $notes_doc = new DOMDocument();
    $notes_doc->loadXML($notes_xml);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php include  __DIR__.'/../assets/includes/head.shtml'?>
    <title>jasmine's b(rain)log</title>
    <meta name="description" content="my web of thoughts" />
    <meta name="author" content="jasm1nii" />
    <meta name="keywords" content="blog" />
    <link href="/assets/stylesheets/style-10.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
    <div id="layout">
        <div class="sidebar">
            <header>
                <hgroup>
                    <h1>jasmine's b(rain)log</h1>
                </hgroup>
                <nav>
                    <?php
                        $nav = new DOMDocument;
                        $nav->loadHTMLFile(__DIR__.'/../assets/includes/headernav.shtml');
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
            <article class="microblog">
                <section>
                    <hgroup>
                        <h2>notes</h2>
                    </hgroup>
                    <div id="notes">
                        <article>
                            <div>
                                <img src="/assets/media/main/oingo-boingo.png" alt="profile picture" class="u-photo" />
                            </div>
                            <div>
                                <h3 class="p-name">
                                    <time datetime="
                                    <?php
                                        $notes_pub = $notes_doc->getElementsByTagName('published')->item(0)->textContent;
                                        echo $notes_pub;
                                    ?>
                                    "><a href="
                                    <?php
                                        $notes_link = $notes_doc->getElementsByTagName('id')->item(1)->textContent;
                                        echo $notes_link;
                                    ?>">
                                        <?php
                                            $notes_title = $notes_doc->getElementsByTagName('title')->item(1)->textContent;
                                            echo str_replace(" | jasmine's notes","",$notes_title);
                                        ?>
                                    </a></time>
                                </h3>
                                <p id="latest-note-content" class="e-content">
                                    <?php
                                        $notes_content = $notes_doc->getElementsByTagName('content')->item(0)->textContent;
                                        echo $notes_content;
                                    ?>
                                </p>
                            </div>
                        </article>
                    </div>
                </section>
                <section class="subscribe">
                    <p>
                        <a href="/blog/notes/">view archive</a> / subscribe via <a href="/blog/notes/notes.xml">atom</a>
                    </p>
                </section>
            </article>
            <article>
                <section>
                    <hgroup>
                        <h2>articles</h2>
                    </hgroup>
                    <div id="articlesArchive"></div>
                </section>
                <section class="subscribe">
                    <p>
                        <a href="/blog/articles/">view archive</a> / subscribe via <a
                            href="/blog/articles/articles.xml">atom</a>
                    </p>
                </section>
            </article>
        </main>
    </div>
    <footer>
        <?php include  __DIR__.'/../assets/includes/footer.shtml'?>
    </footer>
    <script src="/assets/scripts/articles-archive.js"></script>
    <script src="/assets/scripts/theme-switcher-v2.js"></script>
</body>
</html>