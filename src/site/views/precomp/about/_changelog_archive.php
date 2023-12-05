<?php

    namespace JasminesJournal\Site\Views\Partials;

    final class ChangelogArchive {

        private const SRC_DIR = SITE_ROOT . DIR['content'] . 'changelog';

        private static function getYearsFromDirectory(): ?array {

            $folders_by_year = glob(self::SRC_DIR . "/2*");
            rsort($folders_by_year, SORT_NATURAL);

            return $folders_by_year;

        }

        private static function getYears(): ?array {

            $year_folders = self::getYearsFromDirectory();

            for ($y = 0; $y < count($year_folders); $y++) {

                $year_label[] = ltrim($year_folders[$y], self::SRC_DIR);

            }

            return $year_label;

        }

        private static function getGlob(): ?array {

            $glob = glob(self::SRC_DIR . "/*/*.html.twig");
            rsort($glob, SORT_NATURAL);

            foreach ($glob as $file_string) {

                $preg_1[] = preg_split('/\/(changelog)\//', $file_string)[1];

            }

            foreach ($preg_1 as $preg_2) {

                $preg_3[] = preg_split('/(.html.twig)/', $preg_2)[0];
            }

            $y = 0;

            foreach (self::getYears() as $year) {

                $pattern = "/" . "{$year}" . "/";
                $match[$y] = preg_grep($pattern, $preg_3);
                ++$y;

            }

            return $match;

        }

        final public static function createChangelogArray(): ?array {

            $years = self::getYears();
            $month_files = self::getGlob();

            return array_combine($years, $month_files);

        }

    }

?>