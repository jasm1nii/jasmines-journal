<?php

    namespace JasminesJournal\Site\Models;

    class GuestbookLatest extends GuestbookConn {

        public static function get() {

            $guestbook_show = parent::connect();

            if ($guestbook_show !== null) {

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

                return $sql_comment->fetchAll()[0];

            } else {

                return;

            }

        }

    }

?>