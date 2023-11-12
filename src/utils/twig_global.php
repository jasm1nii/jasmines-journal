<?php
    use Twig\Extra\Markdown\DefaultMarkdown;
    use Twig\Extra\Markdown\MarkdownExtension;
    use Twig\Extra\Markdown\MarkdownRuntime;
    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    $loader = new \Twig\Loader\FilesystemLoader(SITE_ROOT, getcwd());
    $loader->addPath(SITE_ROOT . '/src/includes/', 'includes');

    $twig = new \Twig\Environment($loader,[
        'cache' => SITE_ROOT . '/tmp/twig',
        'auto_reload' => true
    ]);

    $twig->addExtension(new MarkdownExtension());
    $twig->addExtension(new IntlExtension());

    $twig->addRuntimeLoader(new class implements RuntimeLoaderInterface {
        public function load($class) {
            if (MarkdownRuntime::class === $class) {
                return new MarkdownRuntime(new DefaultMarkdown());
            }
        }
    });

    $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);

    $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Jakarta');

    //

    $twig->addGlobal("head", file_get_contents(SITE_ROOT . '/src/includes/head.shtml'));

    $twig->addGlobal("headernav", file_get_contents(SITE_ROOT . '/src/includes/headernav.shtml'));

    $twig->addGlobal("footer", file_get_contents(SITE_ROOT . '/src/includes/footer.shtml'));
?>