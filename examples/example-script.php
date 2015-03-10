<?php

namespace Asana;

require dirname(__FILE__) . '/../vendor/autoload.php';

use Asana\Client;

const ASANA_API_KEY = '5KuX5z.wySa0u7i9ag7tCVwLJktAbHvX';

$client = Client::basicAuth(ASANA_API_KEY);

var_dump($client->users->me()->workspaces);
