<?php

    require __DIR__ . '/../vendor/autoload.php';

    use JasminesJournal\Site\Views\Generator;

    new Generator\XMLFeeds(
        type: 'articles',
        max_entries: 5
    );

    new Generator\XMLFeeds(
        type: 'notes',
        max_entries: 5
    );