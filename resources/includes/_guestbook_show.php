<?php
    if (!isset($page) || $page == 1) {
        $page = 0;
    }
    $rows = $page * 10;
    
    $db = parse_ini_file(RenderConfig::Ini, true);
    $servername = "localhost";
    $dbname = $db['guestbook']['name'];
    $table = $db['guestbook']['table'];
    $user_show = $db['guestbook']['user'];
    $pass_show = $db['guestbook']['password'];

    $guestbook_show = new PDO("mysql:host=$servername;dbname=$dbname", $user_show, $pass_show);

    $sql_show = $guestbook_show->prepare(
        "   SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`, `Comment`, `User Privilege`
            FROM `$table`
            WHERE `Moderation Status`='Approved'
            ORDER BY `ID` DESC
            LIMIT $rows, 10
        ");

    $sql_show->execute();
    $sql_show->setFetchMode(PDO::FETCH_ASSOC);
    $msg_arr = $sql_show->fetchAll();

    include RenderConfig::MarkdownComments;

    for ($i=0; $i < count($msg_arr); $i++) {
        $v = $msg_arr[$i];
        
        $msg = "<section class='message'><hgroup><h2 id='{$v['ID']}'>#{$v['ID']} &#x2022; ";
        $name = htmlspecialchars($v['Name'], ENT_QUOTES, "UTF-8", false);

        if ($v['User Privilege'] == 'Admin') {
            $name .= "&nbsp;👑";
        }
        
        if ($v['Website'] !== null) {
            $msg .= "<a href='{$v['Website']}'>{$name}</a>";
        } else {
            $msg .= $name;
        }

        $msg .= "&nbsp;";

        if ($v['Parent ID'] !== null) {
            $msg .= "<span class='reply-context'>(in reply to <a href='#{$v['Parent ID']}'>#{$v['Parent ID']}</a>)</span>";
        }

        $md_comment = $commonmark->convert($v['Comment']);

        $msg .= "</h2></hgroup><section class='content'>" . $md_comment . "</section><footer><time>{$v['Date']}</time></footer></section>";

        echo $msg;
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

    $nav = "<nav><span>page</span>";

    for ($i=0; $i < (count($nav_entries)); $i++) {

        $page_num = $nav_entries[$i];

        if ($page_num == $page || (($page + 1) == 1 && 1 == $page_num)) {
            $nav .= "<span class='current'><a href='/guestbook/page/{$page_num}'>{$page_num}</a></span>";
            continue;
        }

        $nav .= "<span class='page'><a href='/guestbook/page/{$page_num}'>{$page_num}</a></span>";
    }

    $nav .= "</nav>";

    echo $nav;

    unset($user_show, $pass_show);
    $guestbook_show = null;
?> 