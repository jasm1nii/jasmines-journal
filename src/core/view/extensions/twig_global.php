<?php

    namespace JasminesJournal\Core\Views\Render\Extension;

    use Twig\Extra\Markdown\DefaultMarkdown;
    use Twig\Extra\Markdown\MarkdownExtension;
    use Twig\Extra\Markdown\MarkdownRuntime;
    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    # use Twig\Extension\StringLoaderExtension;

    class Twig {

        public function loadBaseLoader(string $add_path = null): object {

            $loader = new \Twig\Loader\FilesystemLoader(SITE_ROOT, getcwd());
            
            $loader->addPath(SITE_ROOT . '/src/site/views/includes/', 'includes');

            if ($add_path !== null) {

                $loader->addPath(SITE_ROOT . $add_path);

            }

            return $loader;

        }

        public function createEnvAndMake(object $loader, string $template, array $args): void {

            $twig = new \Twig\Environment(
                $loader,
                [
                    'cache'         => SITE_ROOT . '/tmp/twig',
                    'auto_reload'   => true,
                    'debug'         => true
                ]
            );

            $twig->addExtension(new MarkdownExtension());

            $twig->addRuntimeLoader(
                new class () implements RuntimeLoaderInterface {
                    public function load($class)
                    {
                        if (MarkdownRuntime::class === $class) {
                            return new MarkdownRuntime(new DefaultMarkdown());
                        }
                    }
                }
            );

            $twig->addExtension(new \Twig\Extension\DebugExtension());
            # $twig->addExtension(new StringLoaderExtension());
            $twig->addExtension(new IntlExtension());

            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);
            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Jakarta');

            echo $twig->render($template, $args);

        }

    }

?>
