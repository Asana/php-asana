<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Asana\Client;

$ASANA_ACCESS_TOKEN = getenv('ASANA_ACCESS_TOKEN');

// API Key Instructions:

// 1. set your ASANA_ACCESS_TOKEN environment variable to a Personal Access Token found in Asana Account Settings

if ($ASANA_ACCESS_TOKEN === false) {
    echo "Please set the ASANA_ACCESS_TOKEN environment variable.\n";
    exit;
}

echo "== Example using Personal Access Token:\n";

// create a $client->with a Personal Access Token
$client = Asana\Client::accessToken($ASANA_ACCESS_TOKEN);

$me = $client->users->me();
echo "me="; var_dump($client->users->me());
