<?php
    switch(REQUEST) {
        
        case "/resources/":
        case "/resources/index/":

            $layout = DIR['layouts'] . "resources/resources_index.html.twig";
            $updated = filemtime(SITE_ROOT . DIR['content'] . "resources/resources_index.md");
            $vars = [
                'updated' => $updated
            ];

            View::Twig($layout, $vars, null);
            break;

        case str_starts_with(REQUEST, "/resources/"):

            $path = preg_split(('/\/(resources)/'), REQUEST);
            $file_base = rtrim($path[1], "/");
            $category = SITE_ROOT . DIR['content'] . "resources/categories";

            function renderResourcesPage($markdown_file, $twig_file) {

                require_once RenderConfig::Twig;

                if (file_exists($markdown_file)) {
                    require_once RenderConfig::MarkdownWithTOC;
                    $content = $commonmark->convert(file_get_contents($markdown_file));
                    $updated = filemtime($markdown_file);

                } else {
                    $content = null;
                    $updated = filemtime($twig_file);
                }

                $url = preg_split('/\//',REQUEST);

                if (!empty($url[3])) {
                    $parent = '/'.$url[1].'/'.$url[2];

                } else {
                    $parent = null;
                }

                $twig_path = preg_split('/resources/', $twig_file);

                echo $twig->render(DIR['content'] . "resources" . $twig_path[1],
                    [
                        'layout' => DIR['layouts'] . "resources/resources_subpage.html.twig",
                        'updated' => $updated,
                        'legend' => file_get_contents(SITE_ROOT.DIR['content'] . "resources/_legend.md"),
                        'content'=> $content,
                        'parent' => $parent
                    ]);
            }

            $page = $category . $file_base . ".html.twig";
            
            if (file_exists($page)) {

                renderResourcesPage($category . $file_base . ".md", $page);

            } elseif (preg_match('/\/(resources)\/.+/', REQUEST, $matches)) {
                
                $path = preg_split('/\/(resources)/', $matches[0]);
                $file_base = $category . $path[1];
                
                $page = $file_base . "index.html.twig";

                if (file_exists($page)) {
                    renderResourcesPage($file_base . "index.md", $page);

                } else {
                    Route::NotFound();
                }
                
            } else {
                Route::NotFound();
            }

            break;
    }
?>