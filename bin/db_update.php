<?php

    // cron script

    require __DIR__ . '/../vendor/autoload.php';

    use JasminesJournal\Site\Models\NotesDatabase;
    use JasminesJournal\Site\Models\ArticlesDatabase;

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