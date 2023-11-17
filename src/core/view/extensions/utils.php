<?php

    namespace Core\Views\Render\Extension;

    class Utils {

        public static function formatTimeDifference($time) {

            // source: https://www.w3schools.in/php/examples/time-ago-function

            $time_diff = time() - $time;

            if ($time_diff < 1) {

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
    }

?>