<?php
    require_once dirname(__DIR__,1).'/src/vendor/autoload.php';

    use Symfony\Component\Cache\Adapter\FilesystemAdapter;
    use Symfony\Component\Cache\Adapter\TagAwareAdapter;

    use Twig\Extra\Cache\CacheRuntime;
    use Twig\Extra\Markdown\MarkdownExtension;
    use Twig\Extra\Intl\IntlExtension;
    use Twig\Extra\Markdown\DefaultMarkdown;
    use Twig\Extra\Markdown\MarkdownRuntime;
    use Twig\Extra\Cache\CacheExtension;

    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__,1),getcwd());
    $twig = new \Twig\Environment($loader,[
        'cache'=>dirname(__DIR__,1).'/resources/cache',
        'auto_reload'=>true
    ]);

    $twig->addExtension(new CacheExtension());
    $twig->addExtension(new MarkdownExtension());
    $twig->addExtension(new IntlExtension());

    $twig->addRuntimeLoader(new class implements RuntimeLoaderInterface {
        public function load($class) {
            if (MarkdownRuntime::class === $class) {
                return new MarkdownRuntime(new DefaultMarkdown());
            }
            if (CacheRuntime::class === $class) {
                return new CacheRuntime(new TagAwareAdapter(new FilesystemAdapter()));
            }
        }
    });

    $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);
    $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Jakarta');

    $twig->addGlobal("head",file_get_contents(dirname(__DIR__,1).'/resources/includes/head.shtml'));
    $twig->addGlobal("headernav", file_get_contents(dirname(__DIR__,1).'/resources/includes/headernav.shtml'));
    $twig->addGlobal("footer", file_get_contents(dirname(__DIR__,1).'/resources/includes/footer.shtml'));
?>