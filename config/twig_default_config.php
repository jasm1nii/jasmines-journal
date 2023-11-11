<?php
    require_once dirname(__DIR__,1) . "/vendor/autoload.php";
    
    use Twig\Extra\Markdown\DefaultMarkdown;
    use Twig\Extra\Markdown\MarkdownExtension;
    use Twig\Extra\Markdown\MarkdownRuntime;
    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__,1),getcwd());
    $twig = new \Twig\Environment($loader,[
        'cache'=>dirname(__DIR__,1).'/tmp/twig',
        'auto_reload'=>true
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

    $twig->addGlobal("head",file_get_contents(dirname(__DIR__,1).'/src/includes/head.shtml'));
    $twig->addGlobal("headernav", file_get_contents(dirname(__DIR__,1).'/src/includes/headernav.shtml'));
    $twig->addGlobal("footer", file_get_contents(dirname(__DIR__,1).'/src/includes/footer.shtml'));
?>