<?php

    namespace Site\Models\Guestbook;

    class NewestMessage {

        public static function get() {

            include __DIR__ . "/guestbook_conn.php";

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