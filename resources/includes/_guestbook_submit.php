<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $db = parse_ini_file(RenderConfig::Ini, true);

    $servername = "localhost";
    $dbname = $db['guestbook']['name'];
    $table = $db['guestbook']['table'];

    $time_offset = $_SERVER['REQUEST_TIME'] - $_POST['timestamp'];
    
    if (isset($_POST) && $time_offset > 3) {
        if ($_POST['message'] == strip_tags($_POST['message']) && $_POST['name'] == strip_tags($_POST['name'])) {
            $user_post = $db['guestbook']['user'];
            $pass_post = $db['guestbook']['password'];
            $guestbook_post = new PDO("mysql:host=$servername;dbname=$dbname", $user_post, $pass_post, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4']);

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
                $sender_name = htmlspecialchars($_POST['message'], ENT_QUOTES | ENT_HTML401, 'UTF-8', true);
            }
            
            $sender_email = $_POST['email'];
            $sender_url = $_POST['website'];
            $sender_message = htmlspecialchars($_POST['message'], ENT_QUOTES | ENT_HTML401, 'UTF-8', true);
            $sender_ip = $_SERVER['REMOTE_ADDR'];

            $sql_post->execute();

            unset($user_post, $pass_post);
            $guestbook_post = null;

            require_once RenderConfig::Composer;
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

                $mail->Host = 'mail.jasm1nii.xyz';
                $mail->Port = 465;
                $mail->Username = $db['email']['user'];
                $mail->Password = $db['email']['password'];

                $mail->CharSet = "UTF-8";

                $mail->setFrom('system@jasm1nii.xyz', "jasmine's journal [system mailer]");
                $mail->addAddress('contact@jasm1nii.xyz', 'Jasmine');
                $mail->isHTML(true);
                $mail->Subject = "guestbook message received!";
                $mail->Body =
                    "<ul>
                        <li>Name: {$sender_name}</li>
                        <li>Email: {$sender_email}</li>
                        <li>URL: {$sender_url}</li>
                        <li>Message: {$sender_message}</li>
                    </ul>";
                $mail->AltBody = "Name:{$sender_name} - Email: {$sender_email} - URL: {$sender_url} - Message: {$sender_message}";
                $mail->send();
                
            } catch (Exception $e) {
                header('Location: /guestbook/success/exception');
            }

            header('Location: /guestbook/success');

        } else {
            unset($user_post, $pass_post);
            $guestbook_post = null;
            header('Location: /guestbook/error/has_html');

        }
    } else {
        unset($user_post, $pass_post);
        $guestbook_post = null;
        header('Location: /guestbook/error/time_too_short');

    }
?>