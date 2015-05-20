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
$projectArray = array_filter($projects, function($project) { return $project->name === 'demo project'; });
$project = array_pop($projectArray);
if ($project === null) {
    echo "creating 'demo project'\n";
    $project = $client->projects->createInWorkspace($personalProjects->id, array('name' => 'demo project'));
}
echo "project="; var_dump($project);

// start streaming modifications to the demo project.
// make some changes in Asana to see this working
echo "starting streaming events for " . $project->name . "\n";
$eventsIterator = $client->events->getIterator(array('resource' => $project->id));
foreach ($eventsIterator as $event) {
    var_dump($event);
}
