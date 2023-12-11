<?php

    namespace JasminesJournal\Site\Models\Blog;

    class NotesDirectory {

        public object $date;
        public string $newest_file;

        final public function getNewestFile(?bool $match_partial = true): string {

            $this->date = new \DateTime("now");

            file_exists($this->dateToFile($this->date))
                ? $this->newest_file = $this->dateToFile($this->date)
                : $this->newest_file = $this->iterateToNewest();

            if ($match_partial == true) {

                $dir = preg_quote(SITE_ROOT, '/');
                return preg_split('/(' . $dir . ')/', $this->newest_file)[1];
            
            } else {

                return $this->newest_file;

            }

        }

        private function dateToFile(object $date): string {

            $file_date = date_format($date, 'Y/n/d');

            return SITE_ROOT . DIR['content'] . "blog/notes/{$file_date}/entry.html.twig";

        }

        private function iterateToNewest(): string {

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