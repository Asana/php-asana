<?php

namespace Asana;

require dirname(__FILE__) . '/../vendor/autoload.php';

use Asana\Client;

$ASANA_CLIENT_ID = getenv("ASANA_CLIENT_ID");
$ASANA_CLIENT_SECRET = getenv("ASANA_CLIENT_SECRET");
$REDIRECT_URI = 'urn:ietf:wg:oauth:2.0:oob';

$client = Client::oauth(array(
    'client_id' => $ASANA_CLIENT_ID,
    'client_secret' => $ASANA_CLIENT_SECRET,
    'redirect_uri' => $REDIRECT_URI
));

$authUrl = $client->dispatcher->authorizationUrl();
echo "Open the following URL in a browser to authorize:\n";
echo $authUrl . "\n";

exec("open " . escapeshellarg($authUrl));

echo "Copy and paste the returned code from the browser and press enter:\n";
$code = trim(fgets(fopen("php://stdin","r")));
echo "code=[$code]\n";

$token = $client->dispatcher->fetchToken($code);
var_dump($token);
var_dump($client->users->me());

$client = Client::oauth(array(
    'client_id' => $ASANA_CLIENT_ID,
    'redirect_uri' => $REDIRECT_URI,
    'token' => $token
));

var_dump($client->users->me());
