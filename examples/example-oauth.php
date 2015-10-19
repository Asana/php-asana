<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

$ASANA_CLIENT_ID = getenv('ASANA_CLIENT_ID');
$ASANA_CLIENT_SECRET = getenv('ASANA_CLIENT_SECRET');

// OAuth Instructions:

// 1. create a new application in your Asana Account Settings ("App" panel)
// 2. set the redirect URL to "urn:ietf:wg:oauth:2.0:oob"
// 3. set your ASANA_CLIENT_ID and ASANA_CLIENT_SECRET environment variables

if ($ASANA_CLIENT_ID === false || $ASANA_CLIENT_SECRET === false) {
    echo "Please set the ASANA_CLIENT_ID and ASANA_CLIENT_SECRET environment variables.\n";
    exit;
}

echo "== Example using OAuth Client ID and Client Secret:\n";

// create a $client->with the OAuth credentials:
$client = Asana\Client::oauth(array(
    'client_id' => getenv('ASANA_CLIENT_ID'),
    'client_secret' => getenv('ASANA_CLIENT_SECRET'),
    // this special redirect URI will prompt the user to copy/paste the code.
    // useful for command line scripts and other non-web apps
    'redirect_uri' => Asana\Dispatcher\OAuthDispatcher::NATIVE_REDIRECT_URI
));
echo "authorized=" . $client->dispatcher->authorized . "\n";

# get an authorization URL:
$state = null;
$url = $client->dispatcher->authorizationUrl($state);
try {
    // in a web app you'd redirect the user to this URL when they take action to
    // login with Asana or connect their account to Asana
    exec("open " . escapeshellarg($url));
} catch (Exception $e) {
    echo "Open the following URL in a browser to authorize:\n";
    echo "$url\n";
}

echo "Copy and paste the returned code from the browser and press enter:\n";

$code = trim(fgets(fopen("php://stdin", "r")));
// exchange the code for a bearer token
$token = $client->dispatcher->fetchToken($code);
if ($client->dispatcher->authorized) {
    echo "Authorization successful\n";
} else {
    echo "Authorization failed, exiting...";
    exit(1);
}

echo "Hello " . $client->users->me()->name . "\n";
echo "Your access token is: " . json_encode($token) . "\n";
echo "Exchanging your refresh token for a new access token because access tokens expire\n";

// access tokens will expire, use a refresh token to get a fresh access token
$token = $client->dispatcher->refreshAccessToken();

echo "Your new access token is: " . json_encode($token) . "\n";
echo "You are a member of the following workspaces:\n";
$workspaces = $client->workspaces->findAll();
foreach ($workspaces as $workspace) {
    echo $workspace->name . "\n";
}

// normally you'd persist this token somewhere
$token = json_encode($token); // (see below)

// demonstrate creating a client using a previously obtained bearer token
echo "== Example using OAuth Access Token:\n";
$client = Asana\Client::oauth(array(
    'client_id' => $ASANA_CLIENT_ID,
    'token' => json_decode($token)
));

echo "Your registered email address is: " . $client->users->me()->email;