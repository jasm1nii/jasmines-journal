<?php
    $source = SITE_ROOT . Template::Content . 'changelog';

    require_once RenderConfig::Twig;
    $layout = Template::Includes . '_changelog_archive.html.twig';

    $years = glob($source."/2*");
    asort($years, SORT_NATURAL);
    $y = 0;
    foreach(array_reverse($years) as $year) {
        $year_label[$y] = ltrim($year, $source);
        
        $months = glob($year."/*.html.twig");
        asort($months, SORT_NATURAL);

        $month_label = null;

        $m = 0;
        foreach($months as $month) {
            $base = rtrim(ltrim($month,$source),".html.twig");
            $month_val = preg_split('/\//',$base);
            $month_int = rtrim($month_val[1],'.html.twig');

            $month_name = strtolower(date("F", mktime(0, 0, 0, $month_int))); 
            $month_label[$m] = $month_name;
            ++$m;
        }

        $archive[$y] = [$year_label[$y] => $month_label];
        +$y;

        echo $twig->render($layout,["years"=>$year_label, "months"=>$month_label]);
    }
?>