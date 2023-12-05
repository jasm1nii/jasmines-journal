<?php

    namespace JasminesJournal\Site\Views\Generator;

    use JasminesJournal\Core\Views\Render\Extension;

    class XMLFeeds {

        private const ENTRY_LAYOUT  = DIR['layouts'] . "blog/xml/feed_entry.xml.twig";
        private const FEED_LAYOUT   = DIR['layouts'] . "blog/xml/feed.xml.twig";
        protected const TEMP_DIR    = "/tmp/feed_generator";

        protected string|int $max_entries;

        protected string $type;
        protected string $src_dir;
        
        protected string $temp_file;
        protected string $output_file;

        private static function setDebug(): bool {

            $ini = parse_ini_file(ENV_CONF, true);

            return $ini['debug']['xml_generator'];

        }

        private function globCount(): ?array {

            $year = date("Y");

            return glob($this->src_dir . "/$year/{12,11,10,9,8,7,6,5,4,3,2,1}/{3,2,1,0}{9,8,7,6,5,4,3,2,1,0}/entry.html.twig", GLOB_BRACE);

        }

        private function getEntryFiles(): ?array {

            $glob = $this->globCount();

            if ($this->max_entries == 'total_entries') {

                $count = count($glob);

            } else {

                $count = $this->max_entries;

            }

            $i = 0;

            while ($i < $count) {
                
                $files[] = $glob[$i];
                $i++;

            }

            rsort($files, SORT_NATURAL);

            return $files;

        }

        private function parseEntries(): void {

            $files  = $this->getEntryFiles();

            $twig   = new Extension\Twig();
            $loader = $twig->loadBaseLoader();

            if (!is_dir(SITE_ROOT . self::TEMP_DIR)) {

                mkdir(SITE_ROOT . self::TEMP_DIR, 0775, true);

            }

            ob_start();

            foreach ($files as $article) {
                
                $split_path = preg_split('/(src)/', $article);
                $path       = '/src/'. $split_path[1];

                $slug       = ltrim(rtrim($path, '.html.twig'), $this->src_dir);

                $img_dir    = "https://jasm1nii.xyz/_assets/media/blog/{$this->type}/" . rtrim($slug,'/entry') . '/';

                $vars = [
                    'type'      => $this->type,
                    'layout'    => self::ENTRY_LAYOUT,
                    'slug'      => $slug,
                    'src'       => $img_dir
                ];

                $twig->createEnvAndMake($loader, $path, $vars);

            }

            $xml_entries = ob_get_contents();

            file_put_contents(SITE_ROOT . $this->temp_file, $xml_entries);

            ob_end_clean();

        }

        private function setOuputPath(): void {

            if (self::setDebug() == true) {

                $this->output_file = SITE_ROOT . "/tests/{$this->type}.xml";

            } else {

                $this->output_file = SITE_ROOT . DIR['content']. "/blog/{$this->type}/{$this->type}.xml";

            }

        }

        private function createFeed(): void {

            $this->parseEntries();

            $twig = new Extension\Twig();
            $loader = $twig->loadBaseLoader();

            $vars = [
                'type'      => $this->type,
                'temp_file' => $this->temp_file
            ];

            ob_start();

            $twig->createEnvAndMake($loader, self::FEED_LAYOUT, $vars);

            $xml_final = ob_get_contents();

            file_put_contents($this->output_file, $xml_final);

            ob_end_clean();

            unlink(SITE_ROOT . $this->temp_file);

        }

        private function showXML(): void {

            $entry  = $this->getEntryFiles()[0];
            $feed   = $this->output_file;

            $latest_entry_date  = @filemtime($entry);
            $feed_date          = @filectime($feed);

            if (!file_exists($feed) || $latest_entry_date > $feed_date) {

                $this->createFeed();

            }

            $output = new \DOMDocument();
            $output->load($this->output_file);

            echo $output->saveXML();

        }

        public function __construct(string $type, string|int $max_entries) {

            $this->type         = $type;
            $this->max_entries  = $max_entries;

            $this->src_dir      = SITE_ROOT. DIR['content'] . "blog/{$this->type}";
            $this->temp_file    = self::TEMP_DIR . "/{$this->type}.tmp.xml";

            $this->setOutputPath();
            $this->showXML();

        }

    }

?>