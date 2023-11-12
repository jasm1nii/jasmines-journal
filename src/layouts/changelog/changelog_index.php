<?php
    use League\CommonMark\CommonMarkConverter;
    $converter = new CommonMarkConverter();
    define("MARKDOWN_SOURCE", SITE_ROOT . Template::Content . 'changelog/index.md');
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?=Includes::Head()?>
    <title>change log | jasmine's journal</title>
    <meta name="description" content="updates to the website"/>
    <link href="/_assets/stylesheets/changelog.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
    <div class="layout">
        <div>
            <header>
                <hgroup>
                    <h1>change log</h1>
                    <p class="subtitle">jasmine's journal</p>
                    <p class="site-update">
                        last updated <time datetime="<?= date(DATE_ATOM,filemtime(MARKDOWN_SOURCE)) ?>"><?= strtolower(date("j F Y",filemtime(MARKDOWN_SOURCE))) ?></time>
                    </p>
                </hgroup>
                <nav>
                    <?php
                        include Includes::IncludesRoot . '_changelog_nav.php';
                        echo $nav->saveHTML();
                    ?>
                </nav>
            </header>
        </div>
        <div>
            <main>
                <article>
                    <section>
                        <h2 id="changelog">archive</h2>
                        <nav id="archiveNav">
                            <ul>
                                <?php
                                    include Includes::IncludesRoot . '_changelog_archive.php';
                                ?>
                            </ul>
                        </nav>
                    </section>
                    <?= $converter->convert(file_get_contents(MARKDOWN_SOURCE)); ?>
                </article>
            </main>
            <footer>
                <?=Includes::Footer()?>
            </footer>
        </div>
    </div>
    <script src="/_assets/scripts/theme-switcher-v2.js"></script>
</body>
</html>