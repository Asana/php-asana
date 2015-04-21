<?php

require dirname(__FILE__) . '/../vendor/autoload.php';

use Asana\Client;

function client($token=null)
{
    return Asana\Client::oauth(array(
        'client_id' => getenv('ASANA_CLIENT_ID'),
        'client_secret' => getenv('ASANA_CLIENT_SECRET'),
        'redirect_uri' => 'http://localhost:5000/auth/asana/callback',
        'token' => $token
    ));
}

session_start();

try {
    if ('/' == $_SERVER['SCRIPT_NAME']) {
        if (isset($_SESSION['token'])) {
            $me = client($_SESSION['token'])->users->me();
            echo '<p>Hello ' . $me->name . '</p><p><a href="/logout">Logout</a></p>';
        } else {
            $state = null;
            $url = client()->dispatcher->authorizationUrl($state);
            $_SESSION['state'] = $state;
            echo '<p><a href="' . $url . '">';
            echo '<img src="https://github.com/Asana/oauth-examples/raw/master/public/asana-oauth-button-blue.png?raw=true">';
            echo '</a></p>';
        }
    }
    else if ('/logout' == $_SERVER['SCRIPT_NAME']) {
        unset($_SESSION['token']);
        header('Location: /');
    }
    else if ('/auth/asana/callback' == $_SERVER['SCRIPT_NAME']) {
        if ($_SESSION['state'] == $_GET['state']) {
            $_SESSION['token'] = client()->dispatcher->fetchToken($_GET['code']);
            header('Location: /');
        } else {
            echo "State doesn't match";
        }
    }
    else {
        http_response_code(404);
        echo 'Not found';
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "Internal Error\n" . $e;
}
