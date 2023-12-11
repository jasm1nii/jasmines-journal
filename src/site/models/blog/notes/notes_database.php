<?php

    namespace JasminesJournal\Site\Models\Blog;

    use JasminesJournal\Core\Database;

    class NotesDatabase extends Database {

        protected static string $db_name = 'blog_notes';

        public string $file_path;
        public string $date;
        // which will be parsed from the file path itself, as it's already formatted as yyyy/mm/dd.

        public function scanFiles() {

        }

        public function getNewestFile() {

        }

        /*
        public function getNewestDBEntry(): void {

            $sql = $this->database->prepare(
                "SELECT `File Path`
                FROM `{$this->table}`
                ORDER BY `Date` DESC
                LIMIT 1"
            );

            $sql->execute();
            $sql->bindColumn('File Path', $file_path);
            $sql->fetch(\PDO::FETCH_BOUND);

            $this->file_path = $file_path;

        }
        */
        
        public function addToDatabase() {

        }

    }

?>