<?php

    require __DIR__ . '/../vendor/autoload.php';

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

    checkNotesDB();
    checkArticlesDB();
