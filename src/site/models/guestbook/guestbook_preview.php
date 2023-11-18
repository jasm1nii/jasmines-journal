<?php

    namespace JasminesJournal\Site\Models;
    
    require_once __DIR__ . "/guestbook_conn.php";

    class GuestbookLatest extends GuestbookConn {

        public static function get() {

            $guestbook_show = parent::connect();

            $table = parent::getTable();

            $sql_comment = $guestbook_show->prepare(
                "SELECT `ID`, `Date`, `Name`, `Comment`
                FROM `$table`
                WHERE `Moderation Status`='Approved' AND `User Privilege`='Guest'
                ORDER BY `ID` DESC
                LIMIT 1"
            );

            $sql_comment->execute();
            $sql_comment->setFetchMode(\PDO::FETCH_ASSOC);

            $comment_arr = $sql_comment->fetchAll();
            return $comment_arr[0];

        }

    }

?>