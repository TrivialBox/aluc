<?php
session_start();
include_once '../app/init.php';

use Aluc\Tools\Urls;
use Aluc\Service\AdministradorSrv;
use Aluc\Service\ErrorSrv;

$_SESSION['id'] = '1234';
$_SESSION['type'] = 'admin';

function home() {
    echo 'Página de inicio';
    echo '</br>';
    echo 'No hay plata para un diseñador';
}


Urls::serve_request([
    // / (root)
    '/^\/$/' => function() {
        return home();
    },
    // /error
    '/^\/error\/404$/i' => function() {
        return ErrorSrv::error404();
    },
    '/^\/admin$/i' => function() {
        return AdministradorSrv::home();
    },
    '/^\/admin\/moderadores$/i' => function() {
        return AdministradorSrv::moderadores();
    },
    '/^\/admin\/moderadores\/nuevo$/i' => function() {
        return AdministradorSrv::moderadores_nuevo();
    },
    '/^\/admin\/moderadores\/actualizar$/i' => function() {
        return AdministradorSrv::moderadores_actualizar();
    },
    '/^\/admin\/moderadores\/eliminar$/i' => function() {
        return AdministradorSrv::moderadores_eliminar();
    },
    // /admin/lectores
    '/^\/admin\/lectores$/i' => function() {
        return AdministradorSrv::lectores();
    },
    '/^\/admin\/lectores\/nuevo$/i' => function() {
        return AdministradorSrv::lectores_nuevo();
    },
    '/^\/admin\/lectores\/actualizar$/i' => function() {
        return AdministradorSrv::lectores_actualizar();
    },
    '/^\/admin\/lectores\/eliminar$/i' => function() {
        return AdministradorSrv::lectores_eliminar();
    },
    // URL NO VÁLIDA 404
    '/.*/' => function() {
        return ErrorSrv::error404();
    }
]);
