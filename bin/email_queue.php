<?php

    require __DIR__ . '/../vendor/autoload.php';

    use JasminesJournal\Core\Model\EmailQueue;

    $q = new EmailQueue;
    $q->send(clear: true);