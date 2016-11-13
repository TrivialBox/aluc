<?php
include_once '../app/init.php';

/**
 * The following function will strip the script name from URL.
 * (copy/paste, no tocar!)
*/
function getCurrentUri() {
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) {
        $uri = substr($uri, 0, strpos($uri, '?'));
    }
    $uri = '/' . trim($uri, '/');
    return $uri;
}

$base_url = getCurrentUri();
$routes = array();
$routes = explode('/', $base_url);

/*
Now, $routes will contain all the routes. $routes[0] will correspond to first route (/).
*/

if($routes[1] == 'admin') {
    if ($routes[2] == 'moderadores') {
        echo 'Administrar Moreadores :)';
    }
} else {
    echo "Página de Inicio";
}
