<?php
include_once '../app/init.php';

use Aluc\Tools\Urls;


function funcion_saludar() {
    echo 'Hola mundo';
}

Urls::serve_request(
    array(
        '/^\/admin\/moderadores/i' => 'funcion_saludar'
    )
);
