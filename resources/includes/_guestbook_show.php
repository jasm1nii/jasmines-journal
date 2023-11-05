<?php
    $servername = "localhost";
    $db = parse_ini_file(dirname(__DIR__,2)."/config/db.ini", true);

    $dbname = $db['guestbook']['name'];
    $table = 'public_test';
    $user_show = $db['guestbook']['user'];
    $pass_show = $db['guestbook']['password'];

    $guestbook_show = new PDO("mysql:host=$servername;dbname=$dbname", $user_show, $pass_show);

    $sql_show = $guestbook_show->prepare("SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`, `Comment` FROM `$table` WHERE `Moderation Status`='Approved' ORDER BY `ID` DESC");

    $sql_show->execute();
    $sql_show->setFetchMode(PDO::FETCH_ASSOC);
    $msg_arr = $sql_show->fetchAll();

    for ($i=0; $i < count($msg_arr); $i++) {
        $v = $msg_arr[$i];
        echo "<section class='message'><hgroup><h2 id='{$v['ID']}'>#{$v['ID']} &#x2022; " . htmlspecialchars($v['Name'], ENT_QUOTES, "UTF-8", false) . "&nbsp;";
        if ($v['Parent ID'] !== null) {
            echo "(in reply to <a href='#{$v['Parent ID']}'>#{$v['Parent ID']}</a>)";
        }
        echo "</h2></hgroup><p class='message-content'>" . htmlspecialchars($v['Comment'], ENT_QUOTES, "UTF-8", false) . "</p><footer><time>{$v['Date']}</time></footer></section>";
    }

    unset($user_show, $pass_show);
    $guestbook_show = null;
?> 