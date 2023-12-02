<?php

    namespace JasminesJournal\Core\Views\Render\Extension;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;
    use Twig\Extra\Markdown\DefaultMarkdown;
    use Twig\Extra\Markdown\MarkdownExtension;
    use Twig\Extra\Markdown\MarkdownRuntime;

    class PartialTwig {

        public static function buildTwigEnv() {

            $loader = new \Twig\Loader\FilesystemLoader(SITE_ROOT, getcwd());

            $twig = new \Twig\Environment(
                $loader,
                [
                    'cache'         => SITE_ROOT . '/tmp/twig',
                    'auto_reload'   => true
                ]
            );

            $twig->addExtension(new IntlExtension());
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

            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);
            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Jakarta');

            return $twig;

        }
        
    }

?>