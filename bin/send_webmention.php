<?php

    require __DIR__ . '/../vendor/autoload.php';

    $my_page = readline("enter URL: ");

    readline_add_history($my_page);

    $check_endpoint = readline("check for endpoints first?: ");

    readline_add_history($check_endpoint);

    function sendWebmention(): void {

        $client = new IndieWeb\MentionClient();
        $sent = $client->sendMentions($my_page);

        echo "Sent $sent mentions\n";

    }

    if ($check_endpoint == 'yes') {

        $client = new IndieWeb\MentionClient();
        $endpoint = $client->discoverWebmentionEndpoint($my_page);
        var_dump($endpoint);

        $send_mention = readline("would you like to continue sending?: ");

        readline_add_history($send_mention);

        if ($send_mention == 'yes') {

            sendWebmention();

        }
        
    } else {

        sendWebmention();

    }

    