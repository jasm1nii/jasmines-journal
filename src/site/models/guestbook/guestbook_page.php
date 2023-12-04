<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Site\Models\GuestbookConn;

    trait Guestbook {

        public static function templateQuery(string $table): ?string {

            return 
                "   SELECT `ID`, `Parent ID`, `Date`, `Name`, `Website`,`Comment`, `User Privilege`
                    FROM `$table`
                    WHERE `Moderation Status`='Approved'
                ";

        }

        public static function commentID(): int {

            return preg_split('/guestbook\/comment\//', REQUEST)[1];

        }

    }

    class GuestbookComments extends GuestbookConn {

        use Guestbook;

        public static function getRows(int $row_limit): ?array {

            $database = parent::connect();
            $base_query = self::templateQuery(parent::getTable());
            $rows     = ($row_limit - 1) * 10;

            if ($database !== null) {

                $sql_show = $database->prepare(
                    $base_query
                    . " ORDER BY `ID`
                        DESC LIMIT $rows, 10"
                );

                $sql_show->execute();
                $sql_show->setFetchMode(\PDO::FETCH_ASSOC);

                return $sql_show->fetchAll();

            } else {
                
                return null;
                
            }

        }

    }

    class GuestbookThread extends GuestbookConn {

        use Guestbook;

        public static function getThread(): ?array {

            $database   = parent::connect();
            $base_query = self::templateQuery(parent::getTable());
            $comment_id = self::commentID();

            $sql_comment = $database->prepare(
                    $base_query . "AND `ID`=$comment_id"
                );

            $sql_comment->execute();
            $sql_comment->setFetchMode(\PDO::FETCH_ASSOC);

            return $sql_comment->fetchAll()[0];

        }

    }

    class GuestbookThreadReply extends GuestbookConn {

        use Guestbook;

        public static function getThreadReplies(): ?array {

            $database = parent::connect();
            $base_query = self::templateQuery(parent::getTable());
            $comment_id = self::commentID();

            $sql_reply = $database->prepare(
                $base_query . "AND `Parent ID`=$comment_id ORDER BY `ID` ASC"
            );

            $sql_reply->execute();
            $sql_reply->setFetchMode(\PDO::FETCH_ASSOC);

            return $sql_reply->fetchAll();

        }
    }

    class GuestbookRowCount extends GuestbookConn {

        public static function getTotal(): ?int {

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