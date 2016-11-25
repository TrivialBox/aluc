<?php
session_start();
include_once '../app/init.php';

use Aluc\Service\AdministradorSrv;
use Aluc\Service\ErrorSrv;
use Aluc\Common\Urls;
use Aluc\Service\EscritorioSrv;
use Aluc\Service\ReservasSrv;

$_SESSION['id'] = '0105070353';
$_SESSION['type'] = 'admin';

function home() {
    echo 'Página de inicio';
}

Urls::serveRequest([
    '/^$/' => 'home',
    '/^reservas\//i' => ReservasSrv::urls(),
    '/^admin\//i' => AdministradorSrv::urls(),
    '/^escritorio\//i' => EscritorioSrv::urls(),
    '/^error\//i' => ErrorSrv::urls(),
    '/.*/' => ErrorSrv::url404()
]);
