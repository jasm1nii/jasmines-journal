<?php

    namespace JasminesJournal\Site\Views\Generator;

    use JasminesJournal\Core\Views\Render\Extension as Extension;

    // man.... just use a database already

    class XMLFeeds {

        protected $src_dir;
        protected $max_entries;

        protected $entry_layout;
        protected $feed_layout;

        protected const TEMP_DIR = "/tmp/feed_generator";
        protected $temp_file;
        protected $output_file;

        protected function getEntryFiles() {

            $i = 0;

            while ($i < $this->max_entries) {
                
                $files[] = glob($this->src_dir . "/2*/[0-9]*/[0-9][0-9]/entry.html.twig")[$i];
                $i++;

            }

            rsort($files, SORT_NATURAL);

            return $files;

        }

        protected function parseEntries() {

            $files = $this->getEntryFiles();

            $twig = new Extension\Twig();
            $loader = $twig->loadBaseLoader();

            ob_start();

            foreach ($files as $article) {
                
                $split_path = preg_split('/(src)/', $article);
                $path = '/src/'. $split_path[1];
                $slug = ltrim(rtrim($path, '.html.twig'), $this->src_dir);

                $vars = [
                    'layout'    => $this->entry_layout,
                    'slug'      => $slug
                ];

                $twig->createEnvAndMake($loader, $path, $vars);

            }

            $xml_entries = ob_get_contents();
            file_put_contents(SITE_ROOT . $this->temp_file, $xml_entries);

            ob_end_clean();

        }

        protected function createFeed() {

            $this->parseEntries();

            $twig = new Extension\Twig();
            $loader = $twig->loadBaseLoader();

            $vars = [
                'temp_file' => $this->temp_file
            ];

            ob_start();

            $twig->createEnvAndMake($loader, $this->feed_layout, $vars);
            $xml_final = ob_get_contents();
            file_put_contents($this->output_file, $xml_final);

            ob_end_clean();

            unlink(SITE_ROOT . $this->temp_file);

        }

        public function __destruct() {

            $entry = $this->getEntryFiles()[0];
            $feed = $this->output_file;

            if (!file_exists($feed)) {

                $this->createFeed();

            }

            $feed_date = filectime($feed);
            $latest_entry_date =  filemtime($entry);

            if ($latest_entry_date > $feed_date) {

                $this->createFeed();

            }

            require $this->output_file;

        }

    }
    
    class NotesXML extends XMLFeeds {

        public function __construct() {

            $this->src_dir = SITE_ROOT. DIR['content'] . "blog/notes";
            $this->max_entries = 3;

            $this->entry_layout = DIR['layouts'] . "blog/notes/xml/notes_entry.xml.twig";
            $this->feed_layout = DIR['layouts'] . "blog/notes/xml/notes.xml.twig";

            $this->temp_file = parent::TEMP_DIR . "/notes.tmp.xml";
            $this->output_file = SITE_ROOT . "/tests/notes.xml";
            
        }

    }

    class ArticlesXML extends XMLFeeds {

        public function __construct() {

            $this->src_dir = SITE_ROOT. DIR['content'] . "blog/articles";
            $this->max_entries = 4;

            $this->entry_layout = DIR['layouts'] . "blog/articles/xml/articles_entry.xml.twig";
            $this->feed_layout = DIR['layouts'] . "blog/articles/xml/articles.xml.twig";

            $this->temp_file = parent::TEMP_DIR . "/articles.tmp.xml";
            $this->output_file = SITE_ROOT . "/tests/articles.xml";
            
        }

    }

?>