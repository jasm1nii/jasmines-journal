<?php

    $db = parse_ini_file(ENV_CONF, true);

    $servername = "localhost";
    $dbname = $db['guestbook']['name'];
    $table = $db['guestbook']['table'];
    $user_show = $db['guestbook']['user'];
    $pass_show = $db['guestbook']['password'];

    $guestbook_show = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $user_show,
        $pass_show,
        [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4']
    );
    
?>