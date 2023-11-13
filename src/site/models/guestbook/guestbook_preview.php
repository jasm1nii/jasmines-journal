<?php

    include __DIR__ . "/guestbook_conn.php";

    $sql_comment = $guestbook_show->prepare(
        "   SELECT `ID`, `Date`, `Name`, `Comment`
                        FROM `$table`
                        WHERE `Moderation Status`='Approved' AND `User Privilege`='Guest'
                        ORDER BY `ID` DESC
                        LIMIT 1
                    "
    );

    $sql_comment->execute();
    $sql_comment->setFetchMode(PDO::FETCH_ASSOC);

    $comment_arr = $sql_comment->fetchAll();
    $msg = $comment_arr[0];

    // source: https://www.w3schools.in/php/examples/time-ago-function

    function getTimeDiff($time)
    {
        $time_diff = time() - $time;

        if($time_diff < 1) {
            return 'less than 1 second ago';
        }

        $condition = [
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        ];

        foreach ($condition as $secs => $str) {
            $d = $time_diff / $secs;

            if ($d >= 1) {
                $t = round($d);
                return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
            }
        }
    }

    $date = getTimeDiff(strtotime($msg['Date']));

?>