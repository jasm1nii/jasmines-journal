<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?=Includes::Head()?>
    <title>jasmine's b(rain)log</title>
    <meta name="description" content="my web of thoughts" />
    <meta name="author" content="jasm1nii" />
    <meta name="keywords" content="blog" />
    <link href="/_assets/stylesheets/blog_index.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
    <div id="layout">
        <div class="sidebar">
            <header>
                <hgroup>
                    <h1>jasmine's b(rain)log</h1>
                </hgroup>
                <nav>
                    <?=Blog::nav()?>
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
                        <?php
                            $notes_xml = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/notes.xml');
                            $notes_doc = new DOMDocument();
                            $notes_doc->loadXML($notes_xml);
                        ?>
                            <div>
                                <img src="/_assets/media/main/oingo-boingo.png" alt="profile picture" class="u-photo" />
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
                        <a href="/blog/notes">view archive</a> / subscribe via <a href="/blog/notes/notes.xml">atom</a>
                    </p>
                </section>
            </article>
            <article>
                <section>
                    <hgroup>
                        <h2>articles</h2>
                    </hgroup>
                    <div id="articlesArchive">
                        <?php
                            require RenderConfig::Twig;

                            $source = SITE_ROOT . DIR['content'] . 'blog/articles';

                            $layout = DIR['includes'] . "_blog_articles_preview.html.twig";

                            $files = glob($source."/*/*/*/entry.html.twig");
                            asort($files, SORT_NATURAL);

                            $i = 0;
                            foreach (array_reverse($files) as $article) {
                                $content_path = DIR['content'] . ltrim($article, SITE_ROOT);

                                $slug_1 = rtrim($content_path,'.html.twig');
                                $slug_2 = ltrim($slug_1, DIR['content'] . 'blog/articles');

                                echo $twig->render($content_path, ['layout'=>$layout,'slug'=>$slug_2]);
                                if(++$i > 4) break;
                            }
                        ?>
                    </div>
                </section>
                <section class="subscribe">
                    <p>
                        <a href="/blog/articles">view archive</a> / subscribe via <a href="/blog/articles/articles.xml">atom</a>
                    </p>
                </section>
            </article>
        </main>
    </div>
    <footer>
        <?=Includes::Footer()?>
    </footer>
    <style>
        #headernav #blog > a {
            text-decoration: wavy underline;
            text-underline-offset: .25em;
        }
    </style>
    <script src="/_assets/scripts/theme-switcher-v2.js"></script>
</body>
</html>