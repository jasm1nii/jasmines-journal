<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include_once dirname(__DIR__,3).'/resources/includes/head.shtml'; ?>
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
                        page contents updated <time datetime="2023-10-13">13 october 2023</time>
                    </p>
                </hgroup>
                <nav>
                    <?php
                        include dirname(__DIR__,3).'/resources/includes/_changelog_nav.php';
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
                                <li>2023
                                    <ul>
                                        <li><a href="/about/changelog/2023/7">july</a></li>
                                        <li><a href="/about/changelog/2023/8">august</a></li>
                                        <li><a href="/about/changelog/2023/9">september</a></li>
                                        <li><a href="/about/changelog/2023/10">october</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </section>
                    <section>
                        <h2 id="todo">to-do list</h2>
                        <p>
                            nowadays, i prefer to manage the complete list on my private github repository - therefore, this page isn't the most up-to-date, but here are some planned additions that are of moderate to high priority.
                        </p>
                        <ul>
                            <li>add illustrations to the <a href="/about/">"about" page</a></li>
                            <li>launch art page</li>
                            <li>add some shrines</li>
                        </ul>
                    </section>
                    <section>
                        <h2 id="knownIssues">known issues</h2>
                        <section>
                            <p>nothing too disruptive at the moment!</p>
                        </section>
                    </section>
                </article>
            </main>
            <footer>
                <?php include dirname(__DIR__,3).'/resources/includes/footer.shtml';?>
            </footer>
        </div>
    </div>
    <script src="/_assets/scripts/theme-switcher-v2.js"></script>
</body>
</html>