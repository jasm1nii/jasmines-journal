<?php

    namespace JasminesJournal\Site\Models;

    use JasminesJournal\Core\Setup;
    use JasminesJournal\Core\Routine;
    use JasminesJournal\Core\Database;
    use JasminesJournal\Site\Models\BlogDirectory;

    abstract class BlogDatabase extends Database {

        protected string $type;
        public string $source_site = "https://jasm1nii.xyz";
        public ?array $tags;
        public ?array $unique_tags;
        public ?array $unique_tag_count;

        #[Setup]
        final public function useLocalhostAsSource(): void {

            $this->source_site = "http://localhost";
            
        }

        #[Setup]
        final public function validateTable(): void {

            try {

                $sql = $this->database->prepare(
                    "SELECT count(*) FROM {$this->table}"
                );

                $sql->execute();

                if (empty($sql->fetchColumn())) {

                    $this->buildTable();
                    $this->validateTable();

                    echo "({$this->type}) Successfully added new rows. \n";
                    
                } else {

                    echo "({$this->type}) Existing rows were found - no data was inserted. \n";

                }
            
            } catch (\Exception $e) {

                echo $e->getMessage();

            }

        }

        #[Setup]
        final protected function buildTable(): void {

            $files = glob(SITE_ROOT . DIR['content']
            ."blog/{$this->type}/*/*/*/entry.html.twig");

            foreach ($files as $file) {

                $this->updateTable($file, use_root: true);

            }

            $this->resortByDate();
            $this->addPrimaryKey();

        }

        final protected function updateTable(
            string $file,
            bool $use_root
        ): void {

            if ($use_root) {

                $dir = preg_quote(SITE_ROOT, '/');
                $path = preg_split('/(' . $dir . ')/', $file)[1];

            } else {

                $path = $file;

            }

            $base   = preg_split('/(.html.twig)/', $path)[0];
            $url    = preg_split('/(content)/', $base)[1];

            preg_match_all('/[0-9]+/', $path, $date_values);
            $date_obj = date_create(
                "{$date_values[0][0]}-{$date_values[0][1]}-{$date_values[0][2]}"
            );
            // format with leading zeros:
            $date = date_format($date_obj, 'Y-m-d');

            $tags = get_meta_tags($this->source_site . $url)['keywords'];

            $sql = $this->database->prepare(
                "INSERT INTO `{$this->table}`
                (`Date`, `File Path`, `Relative URL`, `Tags`)
                VALUES (:date, :path, :url, :tags)"
            );

            $sql->bindValue('date', $date);
            $sql->bindValue('path', $path);
            $sql->bindValue('url', $url);
            $sql->bindValue('tags', $tags);

            $sql->execute();

        }

        #[Setup]
        private function resortByDate(): void {

            $sql = $this->database->prepare(
                "ALTER TABLE `{$this->table}`
                ORDER BY `Date` ASC"
            );

            $sql->execute();

        }

        #[Setup]
        private function addPrimaryKey(): void {
                
            $sql = $this->database->prepare(
                "ALTER TABLE `{$this->table}`
                ADD `ID` INT(6) NOT NULL AUTO_INCREMENT FIRST,
                ADD PRIMARY KEY (`ID`)"
            );

            $sql->execute();

        }

        final public function getNewestEntry(): string {

            $sql = $this->database->prepare(
                "SELECT `File Path`
                FROM `{$this->table}`
                ORDER BY `ID` DESC
                LIMIT 1"
            );

            $sql->execute();
            
            return $sql->fetchColumn();

        }

        #[Routine]
        final public function validateNewestEntry(): void {

            try {

                $dir = new BlogDirectory($this->type);
                $file = $dir->getNewestFile();

                $sql = $this->database->prepare(
                    "SELECT `File Path`
                    FROM `{$this->table}`
                    WHERE `File Path` = :file"
                );

                $sql->bindValue('file', $file);
                $sql->execute();

                if (!$sql->fetchColumn()) {

                    $this->updateTable($file, use_root: false);

                }

                echo "({$this->type}) Successfully validated!";

            } catch (\Exception $e) {

                echo $e->getMessage();

            }

        }

        final public function getEntries(
            ?int $row_limit = 1,
            ?int $row_total = 10,
            ?string $sort_tag = null
        ): ?array {

            try {

                $offset = ($row_limit - 1) * 10;

                if ($sort_tag !== null) {

                    $sql = $this->database->prepare(
                        "SELECT `ID`, `File Path`, `Relative URL`
                        FROM `{$this->table}`
                        WHERE `Tags` LIKE :tag
                        ORDER BY `ID` DESC
                        LIMIT :offset, :total"
                    );

                    $sql->bindValue('tag', "%" . $sort_tag . "%");
                
                } else {

                    $sql = $this->database->prepare(
                        "SELECT `ID`, `File Path`, `Relative URL`
                        FROM `{$this->table}`
                        ORDER BY `ID` DESC
                        LIMIT :offset, :total"
                    );

                }

                $sql->bindValue('offset', $offset, \PDO::PARAM_INT);
                $sql->bindValue('total', $row_total, \PDO::PARAM_INT);

                $sql->execute();
                $sql->setFetchMode(\PDO::FETCH_ASSOC);

                return $sql->fetchAll();

            } catch (\Exception $e) {

                return null;

            }
    
        }

        final public function getTotal(?string $sort_tag = null): ?int {

            if ($this->database !== null) {

                if ($sort_tag !== null) {

                    $sql = $this->database->prepare(
                        "SELECT COUNT(*)
                        FROM `{$this->table}`
                        WHERE `Tags` LIKE :tag"
                    );

                    $sql->bindValue('tag', "%" . $sort_tag . "%");
                
                } else {

                    $sql = $this->database->prepare(
                        "SELECT COUNT(*)
                        FROM `{$this->table}`"
                    );

                }

                $sql->execute();

                return $sql->fetchColumn();

            } else {

                return null;

            }

        }

        final public function removeMissing(string $path): void {

            $sql = $this->database->prepare(
                "DELETE FROM `{$this->table}`
                WHERE `File Path` = :path"
            );

            $sql->bindValue('path', $path);
            $sql->execute();

            $this->resetTable();

        }

        private function resetTable(): void {

            $sql = $this->database->prepare(
                "ALTER TABLE `{$this->table}`
                AUTO_INCREMENT = 0"
            );

            $sql->execute();

        }

        final public function getTags(): void {

            $sql = $this->database->prepare(
                "SELECT `Tags`
                FROM `{$this->table}`"
            );

            $sql->execute();
            $sql->setFetchMode(\PDO::FETCH_ASSOC);

            $sql_array = $sql->fetchAll();

            for ($i = 0; $i < count($sql_array); $i++) {

                $tags[$i] = $sql_array[$i]['Tags'];
                $tags_resorted[$i] = explode(", ", $tags[$i]);
               
            }

            $this->tags = array_merge(...$tags_resorted);

            // remove redundant tags if they exist:

            foreach (array_keys($this->tags, 'microblog') as $notes_key) {

                unset($this->tags[$notes_key]);
        
            }

            foreach (array_keys($this->tags, 'blog') as $articles_key) {

                unset($this->tags[$articles_key]);
        
            }

            $this->unique_tags = array_unique($this->tags, SORT_STRING);

            $this->unique_tag_count = array_count_values($this->tags);
            arsort($this->unique_tag_count, SORT_DESC);

        }

    }

    class NotesDatabase extends BlogDatabase {

        protected static string $db_name = 'blog_notes';
        protected string $type = 'notes';

    }

    class ArticlesDatabase extends BlogDatabase {

        protected static string $db_name = 'blog_articles';
        protected string $type = 'articles';

    }