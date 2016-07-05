<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Asana\Client;

$ASANA_ACCESS_TOKEN = getenv('ASANA_ACCESS_TOKEN');

// Access Token Instructions:

// 1. set your ASANA_ACCESS_TOKEN environment variable to a Personal Access Token found in Asana Account Settings

if ($ASANA_ACCESS_TOKEN === false) {
    echo "Please set the ASANA_ACCESS_TOKEN environment variable.\n";
    exit;
}

// create a $client->with a Personal Access Token
$client = Asana\Client::accessToken($ASANA_ACCESS_TOKEN);
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

// create a task in the project
$demoTask = $client->tasks->createInWorkspace($personalProjects->id, array(
    "name" => "demo task created at " . date('m/d/Y h:i:s a'),
    "projects" => array($project->id)
));
echo "Task " . $demoTask->id . " created.\n";

// add an attachment to the task
$demoAttachment = $client->attachments->createOnTask(
    $demoTask->id,
    "hello world",
    "upload.txt",
    "text/plain"
);
echo "Attachment " . $demoAttachment->id . " created.\n";
