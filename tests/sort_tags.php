<?php

    require __DIR__ . '/../vendor/autoload.php';

    use JasminesJournal\Site\Models\NotesDatabase;

    $db = new NotesDatabase;
    
    // var_dump(get_class_methods($db));

    $db->getTags();
    var_dump(get_object_vars($db));
    
    // var_dump($db);