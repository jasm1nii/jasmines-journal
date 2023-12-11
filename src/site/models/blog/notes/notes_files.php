<?php

    namespace JasminesJournal\Site\Models\Blog;

    class NotesDirectory {

        public object $date;
        public string $newest_file;

        final public function getNewestFile(?bool $match_partial = true): string {

            $this->date = new \DateTime("now");

            file_exists($this->dateToFile())
                ? $this->newest_file = $this->dateToFile()
                : $this->newest_file = $this->iterateToNewest();

            if ($match_partial) {

                $dir = preg_quote(SITE_ROOT, '/');
                return preg_split('/(' . $dir . ')/', $this->newest_file)[1];
            
            } else {

                return $this->newest_file;

            }

        }

        private function dateToFile(): string {

            $file_date = date_format($this->date, 'Y/n/d');

            return SITE_ROOT . DIR['content'] . "blog/notes/{$file_date}/entry.html.twig";

        }

        private function iterateToNewest(): string {

            while (!file_exists($this->dateToFile())) {
            
                $this->date->modify('-1 day');
        
                if (file_exists($this->dateToFile())) {

                    return $this->dateToFile();

                    break;

                }
        
            }

        }

    }
    
?>