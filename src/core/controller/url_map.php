<?php

    class URLMapper {

        public function addPath($name, $url_pattern = null, $path = null) {

            $this->map[] =
                [
                    'name' => $name,
                    'urls' => $url_pattern,
                    'render_path' => $path
                ];/*, 
                    [
                        'url' => $url_pattern,
                        'render_path' => $path
                    ]
                    );*/

                    //$this->map[]['name'] = [$url_pattern];

            

        }

        public function saveMap() {

            $name = array_values($this->name);
            $url_pattern = array_values($this->url_pattern);
            $this->paths = array_combine($name, $url_pattern);

            return $this->paths;

        }

        public static function getArray($src) {

            return end($src);

        }

    }

    class Router extends URLMapper {

        public static function execute() {

            

        }


    }

    $map = new URLMapper();
    $map->addPath("home", ["/home/test.php", "/index.php"]);
    $map->addPath("blog", "/another/test2.php");
    //$map->saveMap();

    //echo "<pre>" . print_r($map, true) . "</pre>";

    //

    class Poo {

        public static function PEE($PISS) {

            echo "<pre>" . print_r($PISS, true) . "</pre>";
        }
    }

    $routes[] =
        [
            'name' => 'home',
            'url_exact' =>
                [
                    '/index',
                    '/home',
                ],
            'url_pattern' =>
                [
                    '/{year}/{month}'
                ],
            'render_path' => '/model.php'
        ];

    $routes[] = ['name' => 'blog'];


    Poo::PEE($routes);
?>