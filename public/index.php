<?php
include_once '../app/init.php';

function get_url() {
    $base_url = get_current_uri();
    return $base_url;
    // $routes = array();
    // $routes = explode('/', $base_url);
}

function get_current_uri() {
    // Copy % paste, no tocar!
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) {
        $uri = substr($uri, 0, strpos($uri, '?'));
    }
    $uri = '/' . trim($uri, '/');
    return $uri;
}

function serve_request($urls) {
    $base_url = get_url();
    foreach ($urls as $url => $func) {
        if (preg_match($url, $base_url)) {
            $func();
        }
    }
}

serve_request(
    array(
        '/^\/admin\/moderadores/i' => 'funcion_saludar'
    )
);

function funcion_saludar() {
    echo 'Hola mundo';
}

