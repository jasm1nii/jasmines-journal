<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include dirname(__DIR__,3).'/resources/includes/head.shtml';?>
    <title>jasmine's b(rain)log</title>
    <meta name="description" content="my online diary"/>
    <link href="/_assets/stylesheets/blog_index.css" rel="stylesheet" type="text/css" media="all"/>
  </head>
  <body>
    <div id="layout">
        <div class="sidebar">
            <header>
                <hgroup>
                    <h1>
                        jasmine's b(rain)log
                    </h1>
                </hgroup>
                <nav aria-label="primary">
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
                        $notes_a_href->value = '/blog/notes';
                        $notes_a->appendChild($notes_a_href);
                        $notes_index->appendChild($notes_a);

                        echo $nav->saveHTML();
                    ?>
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
                            require_once dirname(__DIR__,3).'/config/twig_default_config.php';

                            $source = dirname(__DIR__,3).'/resources/content/blog/articles';

                            $layout = "/resources/templates/_articles_index.html.twig";

                            $files = glob($source."/*/*/*/entry.html.twig");
                            asort($files, SORT_NATURAL);

                            foreach (array_reverse($files) as $article) {
                                $content_path = ltrim($article,dirname(__DIR__,3));

                                $slug_1 = rtrim($content_path,'.html.twig');
                                $slug_2 = ltrim($slug_1,'/resources/content/blog/articles');

                                echo $twig->render($content_path, ['layout'=>$layout,'slug'=>$slug_2]);
                            }
                        ?>
                    </ol>
                </section>
            </article>
        </main>
    </div>
    <footer>
        <?php include dirname(__DIR__,3).'/resources/includes/footer.shtml'?>
    </footer>
    <style>
        #headernav #blog li:first-child > a {
            text-decoration: wavy underline;
            text-underline-offset: .25em;
        }
    </style>
    <script src="/_assets/scripts/theme-switcher-v2.js"></script>
  </body>
</html>