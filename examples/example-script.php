<?php

namespace Asana;

require dirname(__FILE__) . '/../vendor/autoload.php';

use Asana\Client;

$ASANA_API_KEY = getenv("ASANA_API_KEY");

$client = Client::basicAuth($ASANA_API_KEY);

var_dump($client->workspaces->findAll(null, array('iterator_type' => false)));;

$iter = $client->workspaces->findAll(null, array('iterator_type' => 'items', 'page_size' => 2));
foreach ($iter as $key => $value) {
    echo $key . ': ' . $value->name . "\n";
}
