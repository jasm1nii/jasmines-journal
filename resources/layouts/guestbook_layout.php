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
            <section id="form">
                <?php
                    if ($_SERVER['REQUEST_URI'] == '/guestbook/success/') {
                        echo "<p class='success'>message sent - pending approval</p>";
                    } elseif ($_SERVER['REQUEST_URI'] == '/guestbook/error/') {
                        echo "<p class='error'>the message should not contain any HTML tags!</p>";
                    }
                ?>
                <form name="post_message" method="post" action="/guestbook/post/" enctype="multipart/form-data">
                    <label for="name">name</label>
                    <span>leave blank to post as "anonymous"</span>
                    <input id="name" type="text" name="name" autocomplete="name" maxlength="300"/>
                    <label for="email">email</label>
                    <span>will not be displayed</span>
                    <input id="email" type="email" name="email" autocomplete="email" maxlength="300"/>
                    <label for="website">website</label>
                    <input id="website" type="url" name="website" autocomplete="url" maxlength="300"/>
                    <label for="message">message</label>
                    <textarea id="message" name="message" rows="5" maxlength="3000" placeholder="3000 characters max" required></textarea>
                    <input type="submit" value="submit"/>  
                </form>
            </section>
            <section id="comments">
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