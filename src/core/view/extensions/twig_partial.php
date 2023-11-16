<?php
    namespace Core\Views\Render\Extension;

    use Twig\Extra\Intl\IntlExtension;
    use Twig\RuntimeLoader\RuntimeLoaderInterface;

    class PartialTwig {

        public static function buildTwigEnv() {

            $loader = new \Twig\Loader\FilesystemLoader(SITE_ROOT, getcwd());

            $twig = new \Twig\Environment(
                $loader,
                [
                    'cache' => SITE_ROOT . '/tmp/twig',
                    'auto_reload' => true
                ]
            );

            $twig->addExtension(new IntlExtension());

            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setDateFormat(DATE_ATOM);

            $twig->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Jakarta');

            return $twig;

        }
        
    }

?>