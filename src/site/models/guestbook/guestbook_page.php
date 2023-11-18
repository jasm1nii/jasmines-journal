<?php

    namespace JasminesJournal\Site\Models;

    require_once __DIR__ . "/guestbook_conn.php";
    use JasminesJournal\Site\Models\GuestbookConn as GuestbookConn;

    class GuestbookComments extends GuestbookConn {

        public static function getRows($row_limit) {

            $guestbook_show = parent::connect();

            $table = parent::getTable();

            $rows = $row_limit * 10;

            $sql_show = $guestbook_show->prepare(
                "   SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`, `Comment`, `User Privilege`
                    FROM `$table`
                    WHERE `Moderation Status`='Approved'
                    ORDER BY `ID` DESC
                    LIMIT $rows, 10
                ");

            $sql_show->execute();
            $sql_show->setFetchMode(\PDO::FETCH_ASSOC);
            $msg_arr = $sql_show->fetchAll();

            return $msg_arr;

        }

    }

    class GuestbookThread extends GuestbookConn {

        public static function getThread() {

            $guestbook_show = parent::connect();
            $table = parent::getTable();

            $comment_url = preg_split('/guestbook\/comment/', REQUEST);
            $comment_id = trim($comment_url[1], "/");

            $sql_comment = $guestbook_show->prepare(
                "   SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`, `Comment`, `User Privilege`
                    FROM `$table`
                    WHERE `Moderation Status`='Approved' AND `ID`=$comment_id
                ");
            $sql_comment->execute();
            $sql_comment->setFetchMode(\PDO::FETCH_ASSOC);

            $comment_arr = $sql_comment->fetchAll();

            return $comment_arr;

        }

    }

    class GuestbookThreadReply extends GuestbookConn {

        public static function getThreadReplies() {

            $guestbook_show = parent::connect();
            $table = parent::getTable();

            $comment_url = preg_split('/guestbook\/comment/', REQUEST);
            $comment_id = trim($comment_url[1], "/");

            $sql_reply = $guestbook_show->prepare(
                "   SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`, `Comment`, `User Privilege`
                    FROM `$table`
                    WHERE `Moderation Status`='Approved' AND `Parent ID`=$comment_id
                    ORDER BY `ID` ASC
                ");

            $sql_reply->execute();
            $sql_reply->setFetchMode(\PDO::FETCH_ASSOC);

            $reply_arr = $sql_reply->fetchAll();

            return $reply_arr;

        }
    }

    class GuestbookPageNav extends GuestbookConn {

        public static function getTotal() {

            $guestbook_show = parent::connect();

            $table = parent::getTable();

            $sql_count = $guestbook_show->prepare(
                "   SELECT COUNT(*) as total
                    FROM `$table`
                    WHERE `Moderation Status`='Approved'
                ");

            $sql_count->execute();
            $sql_count->setFetchMode(\PDO::FETCH_ASSOC);
            $total = $sql_count->fetchAll();

            return $total;

        }

    }

?>