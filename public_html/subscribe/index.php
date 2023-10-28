<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php include dirname(__DIR__,2).'/resources/includes/head.shtml'?>
        <title>subscribe | jasmine's journal</title>
        <meta name="description" content="subscription feeds for my little webbed site"/>
        <link rel="canonical" href="https://jasm1nii.xyz/subscribe"/>
        <link rel="stylesheet" href="/_assets/stylesheets/subscribe.css" type="text/css" media="all"/>
    </head>
    <body>
        <div class="layout">
            <header>
                <div id="header-controls">
                    <hgroup>
                        <h1>subscription feeds</h1>
                    </hgroup>
                </div>
                <nav aria-label="primary">
                    <?php include dirname(__DIR__,2).'/resources/includes/headernav.shtml'?>
                </nav>
            </header>
            <main>
                <article aria-label="subscription options">
                    <section aria-labelledby="social-media">
                        <h2 id="social-media">social media</h2>
                        <p>
                            dedicated feeds for select site-wide updates.
                        </p>
                        <ul class="like-buttons">
                            <li><a href="https://fed.brid.gy/web/jasm1nii.xyz" rel="external me">mastodon</a></li>
                            <li><a href="https://neocities.org/site/jasm1nii" rel="external me">neocities</a></li>
                        </ul>
                    </section>
                    <section aria-labelledby="rss">
                        <h2 id="rss">syndication feeds</h2>
                        <p>
                            add to your RSS reader of choice!
                        </p>
                        <ul class="like-buttons">
                            <li><a href="https://jasm1nii.xyz/blog/articles/articles.xml">blog articles</a></li>
                            <li><a href="https://jasm1nii.xyz/blog/notes/notes.xml">microblog notes</a></li>
                        </ul>
                    </section>
                    <section aria-labelledby="newsletter">
                        <h2 id="newsletter">email newsletter</h2>
                        <p>
                            very infrequent - updates once a month, at most. <noscript>form submission needs javascript to work.</noscript>
                        </p>
                        <form action="https://app.audienceful.com/api/subscribe/2Lfpks5aWo73j8cjWF3Gwa/" method="post" name="newsletter signup" aria-label="newsletter signup">
                            <label for="name">name</label>
                            <div class="label-group" aria-label="name">
                                <span>
                                    not required, but would be nice to know!
                                </span>
                                <input id="name" name="name" type="text" placeholder="Gudetama" autocomplete="name"/>
                            </div>
                            <label for="email">email address</label>
                            <div class="label-group" aria-label="email">
                                <input id="email" name="email" type="email" placeholder="gude@tama.egg" autocomplete="on" required/>
                            </div>
                            <button type="submit">submit</button>
                            <footer>
                                powered by <a href="https://audienceful.com/?utm_source=form" rel="external">audienceful</a>
                            </footer>
                        </form>
                    </section>
                </article>
            </main>
            <footer>
                <?php include dirname(__DIR__,2).'/resources/includes/footer.shtml'?>
            </footer>
        </div>
        <script src="/_assets/scripts/theme-switcher-v2.js"></script>
    </body>
</html>