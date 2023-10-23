<?php
    require_once dirname(__DIR__,1).'/src/vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__,1));

    use Twig\Extra\Markdown\MarkdownExtension;
    use Twig\Extra\Intl\IntlExtension;

    $twig = new \Twig\Environment($loader);
    
    $twig->addExtension(new MarkdownExtension());
    $twig->addExtension(new IntlExtension());

    use Twig\Extra\Markdown\DefaultMarkdown;
    use Twig\Extra\Markdown\MarkdownRuntime;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    $twig->addRuntimeLoader(new class implements RuntimeLoaderInterface {
        public function load($class) {
            if (MarkdownRuntime::class === $class) {
                return new MarkdownRuntime(new DefaultMarkdown());
            }
        }
    });

    $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);
    $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Jakarta');
?>