<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Core\Setup;
    use JasminesJournal\Core\Database;
    use JasminesJournal\Site\Models\BlogDirectory;

    abstract class BlogDatabase extends Database {

        protected string $type;

        #[Setup]
        final public function validateTable(): void {

            try {

                $sql = $this->database->prepare(
                    "SELECT count(*) FROM `{$this->table}`"
                );

                $sql->execute();

                if (empty($sql->fetchColumn())) {

                    $this->buildTable();
                    $this->validateTable();

                    echo "Successfully added new rows.";
                    
                } else {

                    echo "Existing rows were found - no data was inserted.";

                }
            
            } catch (\Exception $e) {

                echo $e->getMessage();

            }

        }

        #[Setup]
        final protected function buildTable(): void {

            $files = glob(SITE_ROOT . DIR['content'] ."blog/{$this->type}/*/*/*/entry.html.twig");

            foreach ($files as $file) {

                $this->updateTable($file, use_root: true);

            }

        }

        final protected function updateTable(string $file, bool $use_root): void {

            if ($use_root) {

                $dir = preg_quote(SITE_ROOT, '/');
                $path = preg_split('/(' . $dir . ')/', $file)[1];

            } else {

                $path = $file;

            }

            $base   = preg_split('/(.html.twig)/', $path)[0];
            $url    = preg_split('/(content)/', $base)[1];

            preg_match_all('/[0-9]+/', $path, $date_values);
            $date_obj = date_create("{$date_values[0][0]}-{$date_values[0][1]}-{$date_values[0][2]}");
            // format with leading zeros:
            $date = date_format($date_obj, 'Y-m-d');

            $sql = $this->database->prepare(
                "INSERT INTO `{$this->table}`
                (`File Path`, `Relative URL`, `Date`)
                VALUES ('{$path}', '{$url}', '{$date}')"
            );

            $sql->execute();

        }

        final public function getNewestEntry(): string {

            $sql = $this->database->prepare(
                "SELECT `File Path`
                FROM `{$this->table}`
                ORDER BY `Date` DESC
                LIMIT 1"
            );

            $sql->execute();

            return $sql->fetchColumn();

        }

        final public function validateNewestEntry(): void {

            $dir = new BlogDirectory($this->type);
            $file = $dir->getNewestFile();

            $sql = $this->database->prepare(
                "SELECT `File Path`
                FROM `{$this->table}`
                WHERE `File Path`='{$file}'"
            );

            $sql->execute();

            if (!$sql->fetchColumn()) {

                $this->updateTable($file, use_root: false);

            }

        }

        final public function getEntries(int $row_limit): ?array {

            try {

                $this->validateNewestEntry();

                $rows = ($row_limit - 1) * 10;
        
                $sql = $this->database->prepare(
                    "SELECT `File Path`, `Relative URL`
                    FROM `{$this->table}`
                    ORDER BY `Date` DESC
                    LIMIT $rows, 10"
                );
        
                $sql->execute();
                $sql->setFetchMode(\PDO::FETCH_ASSOC);

                return $sql->fetchAll();

            } catch (\Exception) {

                return null;

            }
    
        }

        final public function getTotal(): ?int {

            if ($this->database !== null) {

                $sql = $this->database->prepare(
                    "SELECT COUNT(*)
                    FROM `{$this->table}`"
                );

                $sql->execute();

                return $sql->fetchColumn();

            } else {

                return null;

            }

        }

        final public function removeMissing(string $path): void {

            $sql = $this->database->prepare(
                "DELETE FROM `{$this->table}`
                WHERE `File Path`='{$path}'"
            );

            $sql->execute();

        }

    }

    class NotesDatabase extends BlogDatabase {

        protected static string $db_name = 'blog_notes';
        protected string $type = 'notes';
        

    }

    class ArticlesDatabase extends BlogDatabase {

        protected static string $db_name = 'blog_articles';
        protected string $type= 'articles';

    }