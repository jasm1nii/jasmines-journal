<?php

    phpinfo();

    /*require __DIR__ . '/../vendor/autoload.php';

    use JasminesJournal\Site\Models\NotesDatabase;
    use JasminesJournal\Site\Models\ArticlesDatabase;

    function checkArticlesDB(): void {

        $database = new ArticlesDatabase;
        $database->validateTable();

    }

    function checkNotesDB(): void {

        $database = new NotesDatabase;
        $database->validateTable();

    }

    if (getenv('ENV') !== 'dev') {

        http_response_code(403);
        return;

    } else {

        checkNotesDB();
        checkArticlesDB();

    }*/