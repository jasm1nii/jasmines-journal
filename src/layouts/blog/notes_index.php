<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?=Includes::Head();?>
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
                    <?=Blog::nav()?>
                </nav>
            </header>
        </div>
        <main>
            <div>
                <section>
                    <?php
                        require RenderConfig::Twig;

                        $source = SITE_ROOT . Template::Content . 'blog/notes';

                        $layout = Template::Includes . "_notes_index.html.twig";

                        $files = glob($source."/*/*/*/entry.html.twig");
                        asort($files, SORT_NATURAL);

                        foreach (array_reverse($files) as $article) {
                            $content_path = Template::Content . ltrim($article, SITE_ROOT);

                            $slug_1 = rtrim($content_path,'.html.twig');
                            $slug_2 = ltrim($slug_1, Template::Content . 'blog/notes');

                            echo $twig->render($content_path, ['layout'=>$layout,'slug'=>$slug_2]);
                        }
                    ?>
                </section>
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
        <?=Includes::Footer()?>
    </footer>
    <script src="/_assets/scripts/theme-switcher-v2.js"></script>
  </body>
</html>