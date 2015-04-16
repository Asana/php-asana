<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Asana\Client;

$ASANA_CLIENT_ID = getenv('ASANA_CLIENT_ID');
$ASANA_CLIENT_SECRET = getenv('ASANA_CLIENT_SECRET');
$ASANA_TOKEN = getenv('ASANA_TOKEN');
$ASANA_API_KEY = getenv('ASANA_API_KEY');

// API Key Instructions:

// 1. set your ASANA_API_KEY environment variable to the API key found in Asana Account Settings

// OAuth Instructions:

// 1. create a new application in your Asana Account Settings ("App" panel)
// 2. set the redirect URL to "urn:ietf:wg:oauth:2.0:oob"
// 3. set your ASANA_CLIENT_ID and ASANA_CLIENT_SECRET environment variables

if ($ASANA_CLIENT_ID !== false) {
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

    $code = trim(fgets(fopen("php://stdin","r")));
    // exchange the code for a bearer token
    $token = $client->dispatcher->fetchToken($code);
    echo "authorized=" . $client->dispatcher->authorized . "\n";

    echo "token=" . json_encode($token) . "\n";
    echo "me="; var_dump($client->users->me());

    // normally you'd persist this token somewhere
    $ASANA_TOKEN = json_encode($token); // (see below)
}

if ($ASANA_TOKEN !== false) {
    // create a $client->with your OAuth $client->ID and a previously obtained bearer token
    $client = Asana\Client::oauth(array(
        'client_id' => $ASANA_CLIENT_ID,
        'token' => json_decode($ASANA_TOKEN)
    ));
    echo "authorized=" . $client->dispatcher->authorized . "\n";
    echo "me="; var_dump($client->users->me());
}

if ($ASANA_API_KEY !== false) {
    // create a $client->with your Asana API key
    $client = Asana\Client::basicAuth($ASANA_API_KEY);
    $me = $client->users->me();
    echo "me="; var_dump($client->users->me());

    // find your "Personal Projects" project
    $personalProjectsArray = array_filter($me->workspaces, function($item) { return $item->name === 'Personal Projects'; });
    $personalProjects = array_pop($personalProjectsArray);
    var_dump($personalProjects);
    $projects = $client->projects->findByWorkspace($personalProjects->id, null, array('iterator_type' => false, 'page_size' => null))->data;
    echo "personal projects="; var_dump($projects);

    // create a "demo project" if it doesn't exist
    $projectArray = array_filter($projects, function($project) { return $project->name === 'demo project1'; });
    $project = array_pop($projectArray);
    if ($project === null) {
        echo "creating 'demo project'\n";
        $project = $client->projects->createInWorkspace($personalProjects->id, array('name' => 'demo project1'));
    }
    echo "project="; var_dump($project);

    // start streaming modifications to the demo project.
    // make some changes in Asana to see this working
    echo "starting streaming events for " . $project->name . "\n";
    $eventsIterator = $client->events->getIterator(array('resource' => $project->id));
    foreach ($eventsIterator as $event) {
        var_dump($event);
    }
}
