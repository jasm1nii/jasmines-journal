<?php

    namespace JasminesJournal\Core\View\Extension;

    use Twig\Extra\Markdown\DefaultMarkdown;
    use Twig\Extra\Markdown\MarkdownExtension;
    use Twig\Extra\Markdown\MarkdownRuntime;
    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    // use Twig\Extension\StringLoaderExtension;

    class Twig {

        public object $loader;

        public function loadBaseLoader(string $add_path = null): void {

            $this->loader = new \Twig\Loader\FilesystemLoader(SITE_ROOT, getcwd());
            
            $this->loader->addPath(SITE_ROOT . '/src/site/views/includes/', 'includes');

            if ($add_path !== null) {

                $this->loader->addPath(SITE_ROOT . $add_path);

            }

        }

        public function createEnvAndMake(
            string $template,
            array $args
        ): void {

            $twig = new \Twig\Environment(
                $this->loader,
                [
                    'cache'         => SITE_ROOT . '/tmp/twig',
                    'auto_reload'   => true,
                    'debug'         => false
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

            // $twig->addExtension(new \Twig\Extension\DebugExtension());
            // $twig->addExtension(new StringLoaderExtension());
            $twig->addExtension(new IntlExtension());

            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);
            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Jakarta');

            echo $twig->render($template, $args ??= []);

        }

    }