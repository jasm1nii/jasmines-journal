<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <?php Includes::Head(); ?>
        <title>guestbook | jasmine's journal</title>
        <meta name="description" content="a list of cool websites on the indie web"/>
        <link rel="canonical" href="https://jasm1nii.xyz/link-gallery"/>
        <link href="/_assets/stylesheets/guestbook.css" rel="stylesheet" type="text/css" media="all"/>
    </head>
    <body>
        <header>
            <hgroup>
                <h1>guestbook</h1>
                <p>jasmine's journal</p>
            </hgroup>
            <nav>
                <?php Includes::HeaderNav(); ?>
            </nav>
        </header>
        <main>
            <section class="form">
                <?php
                    if (isset($_SERVER['HTTP_REFERER'])) {
                        if ($_SERVER['REQUEST_URI'] == '/guestbook/success/') {
                            echo "<p class='dialog success'>message sent - pending approval</p>";
                        } elseif (str_contains($_SERVER['REQUEST_URI'], "has_html")) {
                            echo "<p class='dialog error'>the message should not contain any HTML tags!</p>";
                        } elseif (str_contains($_SERVER['REQUEST_URI'], "time_too_short")) {
                            echo "<p class='dialog error'>request interval is too short - please wait a bit longer.</p>";
                        }
                    }
                ?>
                <h2>leave a message!</h2>
                <p>
                    submissions will be reviewed manually.
                </p>
                <form name="post_message" method="post" action="/guestbook/post/" enctype="multipart/form-data">
                    <label for="name">name</label>
                    <input id="name" type="text" name="name" autocomplete="name" maxlength="300" placeholder="optional"/>

                    <label for="email">email</label>
                    <input id="email" type="email" name="email" autocomplete="email" maxlength="300" placeholder="optional - will not be displayed"/>

                    <label for="website">website</label>
                    <input id="website" type="url" name="website" autocomplete="url" maxlength="300" placeholder="optional"/>

                    <label for="message">message</label>
                    <span>supports text formatting with <a href="https://www.markdownguide.org/cheat-sheet/" rel="external">markdown!</a></span>
                    <textarea id="message" name="message" maxlength="3000" required></textarea>

                    <input type="hidden" name="timestamp" value="<?= $_SERVER['REQUEST_TIME'] ?>"/>
                    <input type="submit" value="submit"/>
                </form>
            </section>
            <section class="messages">
                <?php
                    include dirname(__DIR__,1).'/includes/_guestbook_show.php';
                ?>
            </section>
        </main>
        <footer>
            <?php Includes::Footer(); ?>
        </footer>
        <script src="/_assets/scripts/theme-switcher-v2.js"></script>
    </body>
</html>