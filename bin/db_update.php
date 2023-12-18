<?php

    // cron script

    require __DIR__ . '/../vendor/autoload.php';

    use JasminesJournal\Site\Models\NotesDatabase;
    use JasminesJournal\Site\Models\ArticlesDatabase;

    if (PHP_SAPI == 'cli' && getenv('ENV') == 'prod') {

        $_SERVER['HTTP_HOST'] = 'jasm1nii.xyz';

    }

    function updateArticles(): void {

        $db = new ArticlesDatabase;
        $db->validateNewestEntry();

    }

    function updateNotes(): void {

        $db = new NotesDatabase;
        $db->validateNewestEntry();

    }

    updateArticles();
    updateNotes();