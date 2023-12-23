<?php

    // checking the practicality of implementing a stricter content security with hashes:

    require __DIR__ . '/../vendor/autoload.php';

    $hash_1 = hash_file('sha256', SITE_ROOT . DIR['includes'] . 'footer.shtml');
    $hash_2 = hash_file('sha256', __DIR__ . '/footer_compress.html');

    echo "Hash for original source:\n $hash_1\n";
    echo "Hash for compressed result:\n $hash_2\n";

    // conclusion: currently more trouble than it's worth, because the HTML output from mod_pagespeed creates an entirely different hash.