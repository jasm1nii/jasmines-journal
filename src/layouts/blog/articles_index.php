<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?=Includes::Head();?>
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
                    <?=Blog::nav()?>
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
                            require RenderConfig::Twig;

                            $source = SITE_ROOT . Template::Content . 'blog/articles';

                            $layout = Template::Includes . "_articles_index.html.twig";

                            $files = glob($source."/*/*/*/entry.html.twig");
                            asort($files, SORT_NATURAL);

                            foreach (array_reverse($files) as $article) {
                                $content_path = Template::Content . ltrim($article, SITE_ROOT);

                                $slug_1 = rtrim($content_path, '.html.twig');
                                $slug_2 = ltrim($slug_1, Template::Content . 'blog/articles');

                                echo $twig->render($content_path, ['layout'=>$layout,'slug'=>$slug_2]);
                            }
                        ?>
                    </ol>
                </section>
            </article>
        </main>
    </div>
    <footer>
        <?=Includes::Footer()?>
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