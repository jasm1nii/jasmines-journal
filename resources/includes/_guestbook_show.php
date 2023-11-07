<?php
    if (!isset($page) || $page == 1) {
        $page = 0;
    }
    $rows = $page * 10;

    $servername = "localhost";
    $db = parse_ini_file(dirname(__DIR__,2)."/config/db.ini", true);

    $dbname = $db['guestbook']['name'];
    $table = $db['guestbook']['table'];
    $user_show = $db['guestbook']['user'];
    $pass_show = $db['guestbook']['password'];

    $guestbook_show = new PDO("mysql:host=$servername;dbname=$dbname", $user_show, $pass_show);

    $sql_show = $guestbook_show->prepare(
        "   SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`, `Comment`
            FROM `$table`
            WHERE `Moderation Status`='Approved'
            ORDER BY `ID` DESC
            LIMIT $rows, 10
        ");

    $sql_show->execute();
    $sql_show->setFetchMode(PDO::FETCH_ASSOC);
    $msg_arr = $sql_show->fetchAll();

    for ($i=0; $i < count($msg_arr); $i++) {
        $v = $msg_arr[$i];
        include RenderConfig::MarkdownComments;

        echo "<section class='message'><hgroup><h2 id='{$v['ID']}'>#{$v['ID']} &#x2022; " . htmlspecialchars($v['Name'], ENT_QUOTES, "UTF-8", false) . "&nbsp;";

        if ($v['Parent ID'] !== null) {
            echo "(in reply to <a href='#{$v['Parent ID']}'>#{$v['Parent ID']}</a>)";
        }  

        $md_comment = $commonmark->convert($v['Comment']);

        echo "</h2></hgroup><section class='message-content'>" . $md_comment . "</section><footer><time>{$v['Date']}</time></footer></section>";
    }

    $sql_count = $guestbook_show->prepare(
        "   SELECT COUNT(*) as total
            FROM `$table`
            WHERE `Moderation Status`='Approved'
        ");
    $sql_count->execute();
    $sql_count->setFetchMode(PDO::FETCH_ASSOC);
    $total = $sql_count->fetchAll();

    $max_pages = $total[0]['total'];

    $nav_total = intdiv($max_pages, 10);
    $nav_entries = range(1, $nav_total);

    echo "<nav><span>page</span>";

    for ($i=0; $i < (count($nav_entries)); $i++) {

        $page_num = $nav_entries[$i];

        if ($page_num == $page || (($page + 1) == 1 && 1 == $page_num)) {
            echo "<span class='current'><a href='/guestbook/page/{$page_num}'>{$page_num}</a></span>";
            continue;
        }

        echo "<span class='page'><a href='/guestbook/page/{$page_num}'>{$page_num}</a></span>";
    }

    echo "</nav>";

    unset($user_show, $pass_show);
    $guestbook_show = null;
?> 