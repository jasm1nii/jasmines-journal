<?php
    $servername = "localhost";
    $db = parse_ini_file(dirname(__DIR__,2)."/config/db.ini", true);
    $dbname = $db['guestbook']['name'];
    $table = 'public_test';

    $time_offset = $_SERVER['REQUEST_TIME'] - $_POST['timestamp'];
    
    if (isset($_POST) && $time_offset > 3) {
        if ($_POST['message'] == strip_tags($_POST['message']) && $_POST['name'] == strip_tags($_POST['name'])) {
            $user_post = $db['guestbook']['user'];
            $pass_post = $db['guestbook']['password'];
            $guestbook_post = new PDO("mysql:host=$servername;dbname=$dbname", $user_post, $pass_post);

            $sql_incr = $guestbook_post->prepare("ALTER TABLE `$table` AUTO_INCREMENT=0");
            $sql_incr->execute();

            $sql_post = $guestbook_post->prepare(
                "INSERT INTO `$table` (`ID`, `Date`, `Name`, `Email`, `Website`, `Comment`, `IP Address`, `Moderation Status`, `User Privilege`)
                VALUES (NULL, current_timestamp(), :name, :email, :url, :message, INET6_ATON(:ip), 'Pending', 'Guest')"
            );

            $sql_post->bindParam(':name', $sender_name);
            $sql_post->bindParam(':email', $sender_email);
            $sql_post->bindParam(':url', $sender_url);
            $sql_post->bindParam(':message', $sender_message);
            $sql_post->bindParam(':ip', $sender_ip);

            if ($_POST['name'] == null) {
                $sender_name = 'Anonymous';
            } else {
                $sender_name = htmlspecialchars($_POST['name'], ENT_SUBSTITUTE, "UTF-8", true);
            }
            
            $sender_email = $_POST['email'];
            $sender_url = $_POST['website'];
            $sender_message = htmlspecialchars($_POST['message'], ENT_SUBSTITUTE, "UTF-8", true);
            $sender_ip = $_SERVER['REMOTE_ADDR'];

            $sql_post->execute();

            unset($user_post, $pass_post);
            $guestbook_post = null;

            /*$to = 'contact@jasm1nii.xyz';
            $subject = 'new guestbook message!';
            $message = "{$sender_name} - {$sender_email} - {$sender_url} - {$sender_message}";
            $headers = 'From: system@jasm1nii.xyz';
            mail($to, $subject, $message, $headers);*/

            unset($_POST);
            header('Location: /guestbook/success');

        } else {
            unset($user_post, $pass_post);
            $guestbook_post = null;
            header('Location: /guestbook/error?=has_html');

        }
    } else {
        unset($user_post, $pass_post);
        $guestbook_post = null;
        header('Location: /guestbook/error?=time_too_short');

    }
?>