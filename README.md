php-asana
=========

PHP client library for Asana.

![Build Status](https://api.travis-ci.org/Asana/php-asana.svg)

Installation
------------

### Composer

If you use [Composer](https://getcomposer.org/) you can include the "asana/asana" package as a depedency.

    "require": {
        "asana/asana": "1.0.*"
    }

Alternatively you can specify the version as "dev-master" to get the latest master branch in GitHub.

### Local

If you have downloaded this repository to the "php-asana" directory, for example, you can include the following lines at the top of a PHP file (in the same directory) to begin using it:

    <?php
    require 'php-asana/vendor/autoload.php';

Authentication
--------------

### Basic Auth

Create a client using your Asana API key:

    $client = Asana\Client::basicAuth('ASANA_API_KEY');

### OAuth 2

Asana supports OAuth 2. `asana` handles some of the details of the OAuth flow for you.

Create a client using your OAuth Client ID and secret:

    $client = Asana\Client::oauth(array(
        'client_id' => 'ASANA_CLIENT_ID',
        'client_secret' => 'ASANA_CLIENT_SECRET',
        'redirect_uri' => 'https://yourapp.com/auth/asana/callback'
    ));

Redirect the user to the authorization URL obtained from the client's `session` object:
    
    $url = $client->dispatcher->authorizationUrl();

`authorizationUrl` takes an optional state parameter, passed by reference, which will be set to a random number if null, or passed through if not null;
    
    $state = null;
    $url = $client->dispatcher->authorizationUrl($state);
    // $state will be a random number

Or:

    $state = "foo";
    $url = $client->dispatcher->authorizationUrl($state);
    // $state will still be foo

When the user is redirected back to your callback, check the `state` URL parameter matches, then pass the `code` parameter to obtain a bearer token:

    if ($_GET['state'] == $state) {
      $token = $client->dispatcher->fetchToken($_GET['code']);
      // ... 
    } else {
      // error! possible CSRF attack
    }

Note: if you're writing a non-browser-based application (e.x. a command line tool) you can use the special redirect URI `urn:ietf:wg:oauth:2.0:oob` to prompt the user to copy and paste the code into the application.

Usage
-----

The client's methods are divided into several resources: `attachments`, `events`, `projects`, `stories`, `tags`, `tasks`, `teams`, `users`, and `workspaces`.

Methods that return a single object return that object directly:

    $me = $client->users->me()
    echo "Hello " . me->name;

    $workspaceId = me->workspaces[0]->id;
    $project = $client->projects->createInWorkspace($workspace_id, array('name' => 'new project'));
    echo "Created project with id: " . $project->

Methods that return multiple items (e.x. `findAll`) return an items iterator by default. See the "Collections" section

Options
-------

Various options can be set globally on the `Client.DEFAULTS` object, per-client on `client.options`, or per-request as additional named arguments. For example:

    // global:
    Asana\Client::$DEFAULTS['page_size'] = 1000

    // per-client:
    $client->options['page_size'] = 1000

    // per-request:
    $client->tasks->findAll(array('project' => 1234), array('page_size' => 1000));

### Available options

* `base_url` (default: "https://app.asana.com/api/1.0"): API endpoint base URL to connect to
* `max_retries` (default: 5): number to times to retry if API rate limit is reached or a server error occures. Rate limit retries delay until the rate limit expires, server errors exponentially backoff starting with a 1 second delay.
* `full_payload` (default: false): return the entire JSON response instead of the 'data' propery (default for collection methods and `events.get`)
* `fields` and `expand`: array of field names to include in the response, or sub-objects to expand in the response. For example `array('fields' => array('followers', 'assignee'))`. See [API documentation](https://asana.com/developers/documentation/getting-started/input-output-options)

Collections (methods returning an array as it's 'data' property):

* `iterator_type` (default: "items"): specifies which type of iterator (or not) to return. Valid values are "items" and `null`.
* `item_limit` (default: null): limits the total number of items of a collection to return (spanning multiple requests in the case of an iterator).
* `page_size` (default: 50): limits the number of items per page to fetch at a time.
* `offset`: offset token returned by previous calls to the same method (in `response->next_page->offset`)

Events:

* `poll_interval` (default: 5): polling interval for getting new events via `events->getNext` and `events->getIterator`
* `sync`: sync token returned by previous calls to `events->get` (in `response->sync`)

Collections
-----------

### Items Iterator

By default, methods that return a collection of objects return an item iterator:

    $workspaces = $client->workspaces->findAll();
    foreach ($workspaces as $workspace) {
        var_dump($workspace);
    }

Internally the iterator may make multiple HTTP requests, with the number of requested results per page being controlled by the `page_size` option.

### Raw API

You can also use the raw API to fetch a page at a time:

    $offset = null;
    while (true) {
      $page = $client->workspaces->findAll(null, array('offset' => $offset, 'iterator_type' => null, 'page_size' => 2));
      var_dump($page);
      if (isset($page->next_page)) {
        $offset = $page->next_page->offset;
      } else {
        break;
      }
    }

