<?php

    namespace JasminesJournal\Site\Models\Blog;

    use JasminesJournal\Core\Database;

    class NotesDatabase extends Database {

        protected static string $db_name = 'blog_notes';

        final public function validateTable(): void {

            try {

                $sql = $this->database->prepare(
                    "SELECT count(*) FROM `{$this->table}`"
                );

                $sql->execute();

                if (!empty($sql->fetchColumn())) {

                    getenv('ENV') == 'dev'
                        ? print('YIPPEEEE')
                        : http_response_code(403);

                } else {

                    $this->buildTable();
                    $this->validateTable();
                    
                }
            
            } catch (\Exception $e) {

                getenv('ENV') == 'dev'
                    ? print("ruh roh: {$e->getMessage()}")
                    : http_response_code(403);

            }

        }

        private function buildTable(): void {

            $files = glob(SITE_ROOT . DIR['content'] ."blog/notes/*/*/*/entry.html.twig");

            foreach ($files as $file) {

                $dir = preg_quote(SITE_ROOT, '/');
                $path = preg_split('/(' . $dir . ')/', $file)[1];

                preg_match_all('/[0-9]+/', $path, $date_values);
                $date_obj = date_create("{$date_values[0][0]}-{$date_values[0][1]}-{$date_values[0][2]}");
                // format with leading zeros:
                $date = date_format($date_obj, 'Y-m-d');

                $sql = $this->database->prepare(
                    "INSERT INTO `{$this->table}` (`File Path`, `Date`)
                    VALUES ('{$path}', '{$date}')"
                );

                $sql->execute();
            }

        }

        public function getNewestDBEntry(): string {

            $sql = $this->database->prepare(
                "SELECT `File Path`
                FROM `{$this->table}`
                ORDER BY `Date` DESC
                LIMIT 1"
            );

            $sql->execute();

            return $sql->fetchColumn();

        }

    }

?>