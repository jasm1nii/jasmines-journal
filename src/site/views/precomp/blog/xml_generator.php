<?php

    namespace JasminesJournal\Site\Views\Generator;

    use JasminesJournal\Core\View\Extension;
    use JasminesJournal\Site\Models\ArticlesDatabase;
    use JasminesJournal\Site\Models\NotesDatabase;

    class XMLFeeds {

        private const ENTRY_LAYOUT  = DIR['layouts'] . "blog/xml/feed_entry.xml.twig";
        private const FEED_LAYOUT   = DIR['layouts'] . "blog/xml/feed.xml.twig";

        private bool $debug_settings;
        protected object $database;
        protected object $twig;
        protected string $output_file;

        private function parseEntries(): ?string {

            $files  = $this->database->getEntries(
                row_total: $this->max_entries
            );

            $content = [];

            foreach ($files as $article) {

                if (file_exists(SITE_ROOT . $article['File Path'])) {

                    $slug = $article['Relative URL'];

                    $img_dir = "https://jasm1nii.xyz/_assets/media/blog/{$this->type}/" . rtrim($slug,'/entry') . '/';

                    $vars = [
                        'type'      => $this->type,
                        'layout'    => self::ENTRY_LAYOUT,
                        'slug'      => $slug,
                        'src'       => $img_dir
                    ];

                    $content[] = $this->twig->render($article['File Path'], $vars);
                
                } 

            }

            return implode($content);

        }

        private function createFeed(): ?string {

            $this->twig = Extension\PartialTwig::buildTwigEnv();

            $vars = [
                'type'      => $this->type,
                'temp_file' => $this->parseEntries()
            ];

            return $this->twig->render(self::FEED_LAYOUT, $vars);

        }

        private function validateXML(): void {

            $entry  = $this->database->getNewestEntry();

            $latest_entry_date = $this->database->getDateOfNewest();

            $feed = $this->output_file;

            $feed_date = @filemtime($feed);

            if (!file_exists($feed) || $latest_entry_date > $feed_date) {

                $start = microtime(true);

                $output = new \DOMDocument();
                $output->loadXML($this->createFeed(), LIBXML_PARSEHUGE);
                $output->save($this->output_file);

                $time = round(microtime(true) - $start, 3);

                echo "New feed generated in {$time} seconds.\n";

            } else {

                echo "No changes detected.\n";

            }

        }

        final public function __construct(
            protected string $type,
            protected int $max_entries
        ) {

            $this->debug_settings = INI['debug']['xml_generator'];

            $this->database = match($this->type) {
                'articles'  => new ArticlesDatabase,
                'notes'     => new NotesDatabase
            };

            $this->output_file = $this->debug_settings
                ? SITE_ROOT . "/tests/{$this->type}.xml"
                : SITE_ROOT . "/public_html/{$this->type}.xml";

            $this->validateXML();

        }

    }