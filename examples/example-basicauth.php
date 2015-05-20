<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Asana\Client;

$ASANA_API_KEY = getenv('ASANA_API_KEY');

// API Key Instructions:

// 1. set your ASANA_API_KEY environment variable to the API key found in Asana Account Settings

if ($ASANA_API_KEY === false) {
    echo "Please set the ASANA_API_KEY environment variable.\n";
    exit;
}

echo "== Example using Basic Auth API Key:\n";

// create a $client->with your Asana API key
$client = Asana\Client::basicAuth($ASANA_API_KEY);
$me = $client->users->me();
echo "me="; var_dump($client->users->me());
