<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Site\Models\GuestbookConn;

    class GuestbookComments extends GuestbookConn {

        public static function getRows(int|null $row_limit) {

            $database = parent::connect();
            $table    = parent::getTable();
            $rows     = $row_limit * 10;

            if ($database !== null) {

                $sql_show = $database->prepare(
                    "   SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`, `Comment`, `User Privilege`
                        FROM `$table`
                        WHERE `Moderation Status`='Approved'
                        ORDER BY `ID` DESC
                        LIMIT $rows, 10
                    ");

                $sql_show->execute();
                $sql_show->setFetchMode(\PDO::FETCH_ASSOC);

                return $sql_show->fetchAll();

            } else {
                
                return null;
                
            }

        }

    }

    class GuestbookThread extends GuestbookConn {

        public static function getThread() {

            $database = parent::connect();
            $table    = parent::getTable();

            $comment_url = preg_split('/guestbook\/comment/', REQUEST);
            $comment_id = trim($comment_url[1], "/");

            $sql_comment = $database->prepare(
                "   SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`, `Comment`, `User Privilege`
                    FROM `$table`
                    WHERE `Moderation Status`='Approved' AND `ID`=$comment_id
                ");
            $sql_comment->execute();
            $sql_comment->setFetchMode(\PDO::FETCH_ASSOC);

            return $sql_comment->fetchAll()[0];

        }

    }

    class GuestbookThreadReply extends GuestbookConn {

        public static function getThreadReplies() {

            $database = parent::connect();
            $table    = parent::getTable();

            $comment_url    = preg_split('/guestbook\/comment/', REQUEST);
            $comment_id     = trim($comment_url[1], "/");

            $sql_reply = $database->prepare(
                "   SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`, `Comment`, `User Privilege`
                    FROM `$table`
                    WHERE `Moderation Status`='Approved' AND `Parent ID`=$comment_id
                    ORDER BY `ID` ASC
                ");

            $sql_reply->execute();
            $sql_reply->setFetchMode(\PDO::FETCH_ASSOC);

            return $sql_reply->fetchAll();

        }
    }

    class GuestbookRowCount extends GuestbookConn {

        public static function getTotal() {

            $database = parent::connect();
            $table    = parent::getTable();

            if ($database !== null) {

                $sql_count = $database->prepare(
                    "   SELECT COUNT(*) as total
                        FROM `$table`
                        WHERE `Moderation Status`='Approved'
                    ");

                $sql_count->execute();
                $sql_count->setFetchMode(\PDO::FETCH_ASSOC);

                return $sql_count->fetchAll()[0]['total'];

            } else {

                return null;

            }

        }

    }

?>