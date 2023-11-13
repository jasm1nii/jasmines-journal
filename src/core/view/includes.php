<?php

    class Includes {

        const IncludesRoot = SITE_ROOT . DIR['includes'];

        public static function Head() {

            include self::IncludesRoot . "head.shtml";

        }

        public static function HeaderNav() {

            include self::IncludesRoot . "headernav.shtml";

        }

        public static function Footer() {

            include self::IncludesRoot . "footer.shtml";
            
        }

    }
    
?>