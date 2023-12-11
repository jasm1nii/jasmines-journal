<?php

    class BlogNotesFileIndex {

        public object $date;
        public string $newest_file;

        public function validateNewestFile(): void {

            $this->date = new DateTime("now");

            file_exists($this->dateToFile($date))
                ? $this->newest_file = $this->dateToFile($date)
                : $this->newest_file = $this->iterateToNewest();

        }

        public function dateToFile($date): string {

            $file_date = date_format($date, 'Y/n/d');

            return dirname(__DIR__, 1) . "/src/site/content/blog/notes/{$file_date}/entry.html.twig";

        }

        public function iterateToNewest(): string {

            while (!file_exists($this->dateToFile($this->date))) {
            
                $this->date->modify('-1 day');
        
                if (file_exists($this->dateToFile($this->date))) {

                    return $this->dateToFile($this->date);

                    break;

                }
        
            }

        }

    }
    
?>