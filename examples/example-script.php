<?php

namespace Asana;

require dirname(__FILE__) . '/../vendor/autoload.php';

use Asana\Client;

$ASANA_API_KEY = getenv("ASANA_API_KEY");

$client = Client::basicAuth($ASANA_API_KEY);

var_dump($client->users->me()->workspaces);
