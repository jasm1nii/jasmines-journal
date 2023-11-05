<?php
    $servername = "localhost";
    $db = parse_ini_file(dirname(__DIR__,2)."/config/db.ini", true);
    $dbname = $db['guestbook']['name'];
    $table = 'public_test';
    if (isset($_POST)) {
        if ($_POST['message'] == strip_tags($_POST['message']) && $_POST['name'] == strip_tags($_POST['name'])) {
            $user_post = $db['guestbook']['user'];
            $pass_post = $db['guestbook']['password'];
            $guestbook_post = new PDO("mysql:host=$servername;dbname=$dbname", $user_post, $pass_post);

            $sql_incr = $guestbook_post->prepare("ALTER TABLE `$table` AUTO_INCREMENT=0");
            $sql_incr->execute();

            $sql_post = $guestbook_post->prepare(
                "INSERT INTO `$table` (`ID`, `Date`, `Name`, `Email`, `Website`, `Comment`, `Moderation Status`, `User Privilege`)
                VALUES (NULL, current_timestamp(), :name, :email, :url, :message, 'Pending', 'Guest')"
            );

            $sql_post->bindParam(':name', $sender_name);
            $sql_post->bindParam(':email', $sender_email);
            $sql_post->bindParam(':url', $sender_url);
            $sql_post->bindParam(':message', $sender_message);

            $sender_name = htmlspecialchars($_POST['name'], ENT_SUBSTITUTE, "UTF-8", true);
            $sender_email = $_POST['email'];
            $sender_url = $_POST['website'];
            $sender_message = htmlspecialchars($_POST['message'], ENT_SUBSTITUTE, "UTF-8", true);

            $sql_post->execute();

            unset($user_post, $pass_post);
            $guestbook_post = null;
                    
            echo "<p>form submission sucessful - awaiting approval!</p><br/><span><a href='/guestbook'>send another message</a></span>";

            header('Location: /guestbook/success');
            die();
        } else {
            unset($user_post, $pass_post);
            $guestbook_post = null;
            header('Location: /guestbook/error');
            die();
        }
    }
?>