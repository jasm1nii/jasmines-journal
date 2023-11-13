<?php
    switch (REQUEST) {

        case "/about/changelog/":
        case "/about/changelog/index/":

            new ChangelogIndex();

            break;

        default:
            
            new ChangelogSubpage();

    }
?>