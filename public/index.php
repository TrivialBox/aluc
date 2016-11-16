<?php
session_start();
include_once '../app/init.php';

use Aluc\Tools\Urls;

$_SESSION['id'] = '1234';
$_SESSION['type'] = 'admin';

function home() {
    echo 'Página de inicio';
    echo '</br>';
    echo 'No hay plata para un diseñador';
}

// Namespaces
$error = 'Aluc\Service\ErrorSrv';
$admin = 'Aluc\Service\AdministradorSrv';


Urls::serve_request([
    // home
    '/^\/$/' => 'home',

    // admin
    '/^\/admin$/i' => "{$admin}::home",

    // admin/moderadores
    '/^\/admin\/moderadores$/i' => "{$admin}::moderadores",
    '/^\/admin\/moderadores\/nuevo$/i' => "{$admin}::moderadores_nuevo",
    '/^\/admin\/moderadores\/actualizar$/i' => "{$admin}::moderadores_actualizar",
    '/^\/admin\/moderadores\/eliminar$/i' => "{$admin}::moderadores_eliminar",

    // admin/lectores
    '/^\/admin\/lectores$/i' => "{$admin}::lectores",
    '/^\/admin\/lectores\/nuevo$/i' => "{$admin}::lectores_nuevo",
    '/^\/admin\/lectores\/actualizar$/i' => "{$admin}::lectores_actualizar",
    '/^\/admin\/lectores\/eliminar$/i' => "{$admin}::lectores_eliminar",

    // error/404
    '/^\/error\/404$/i' => "{$error}::error404",

    // URL NO VÁLIDA 404
    '/.*/' => "{$error}::error404"
]);
