<?php
session_start();
include_once '../app/init.php';

use Aluc\Tools\Urls;
use Aluc\Service\AdministradorSrv;
use Aluc\Service\ErrorSrv;


function home() {
    echo 'Página de inicio';
    echo '</br>';
    echo 'No hay plata para un diseñador';
}


Urls::serve_request(
    array(
        '/^\/$/' => function() {
            return home();
        },
        '/^\/error\/404$/i' => function() {
            return ErrorSrv::error404();
        },
        '/^\/admin\/moderadores$/i' => function() {
            return AdministradorSrv::moderadores();
        },
        '/^\/admin\/moderadores\/nuevo$/i' => function() {
            return AdministradorSrv::moderadores_nuevo();
        },
        '/.*/' => function() {
            return ErrorSrv::error404();
        }
    )
);
