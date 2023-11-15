<?php

    namespace Core\Views\Render\Extension;

    use Twig\Extra\Markdown\DefaultMarkdown;
    use Twig\Extra\Markdown\MarkdownExtension;
    use Twig\Extra\Markdown\MarkdownRuntime;
    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    class Twig {

        public function loadBaseLoader($add_path = null) {

            $loader = new \Twig\Loader\FilesystemLoader(SITE_ROOT, getcwd());

            $loader->addPath(SITE_ROOT . '/src/site/views/includes/', 'includes');

            if ($add_path !== null) {

                $loader->addPath(SITE_ROOT . $add_path);

            }

            return $loader;

        }

        public function createEnvAndMake($loader, $template, $args) {

            $twig = new \Twig\Environment(
                $loader,
                [
                    'cache' => SITE_ROOT . '/tmp/twig',
                    'auto_reload' => true
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

            $twig->addExtension(new IntlExtension());

            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);

            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Jakarta');

            echo $twig->render($template, $args);

        }

    }

?>
