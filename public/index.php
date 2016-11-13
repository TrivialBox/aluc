<?php
include_once '../app/init.php';

use Aluc\Tools\Urls;


function funcion_saludar() {
    if (isset($_GET['user']))
    echo "Hola {$_GET['user']}";
    else
        echo "no :(";
}

function home() {
    echo 'Página de inicio';
}

Urls::serve_request(
    array(
        '/^\/$/' => 'home',
        '/^\/admin\/moderadores$/i' => 'funcion_saludar'
    )
);
