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
                        $notes_a_href->value = '/blog/articles';
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
                            require_once dirname(__DIR__,3).'/src/vendor/autoload.php';
                            use Twig\Extra\Intl\IntlExtension;

                            $source = dirname(__DIR__,3).'/resources/content/blog/articles';
                            $loader_1 = new \Twig\Loader\FilesystemLoader(dirname(__DIR__,3));
                            $list = "/resources/templates/blog/articles/articles_index.html.twig";

                            foreach ((glob($source.'/*/*/*/*.twig')) as $article) {
                                $loader_2 = new \Twig\Loader\ArrayLoader([
                                    'base.html' => "{{ include('".$list."') }}",
                                    'entries.html' =>"{% extends 'base.html' %}".file_get_contents($article)
                                ]);
                                $loader = new \Twig\Loader\ChainLoader([$loader_1,$loader_2]);
                                
                                $twig = new \Twig\Environment($loader);
                                $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);

                                echo $twig->render('entries.html');
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