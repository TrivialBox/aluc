<?php
session_start();
include_once '../app/init.php';

use Aluc\Service\AdministradorSrv;
use Aluc\Service\ErrorSrv;
use Aluc\Common\Urls;
use Aluc\Service\EscritorioSrv;
use Aluc\Service\ReservasSrv;
use Aluc\Service\LaboratorioSrv;
use Aluc\Service\Autenticacion;


function home() {
    if (isset($_SESSION['id'])) {
        $type = $_SESSION['type'];
        if ($type === 'admin') {
            Urls::redirect('/admin');
        } else if ($type === 'moderador') {
            Urls::redirect('/escritorio');
        } else {
            Urls::redirect('/reservas');
        }
    } else {
        Urls::redirect('/login');
    }
}


if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();
    session_destroy();
    Urls::redirect('/login');
} else {
    $_SESSION['last_activity'] = time(); // update last activity time stamp
}

Urls::serveRequest([
    '/^$/' => 'home',
    '/^login\//i' => 'Aluc\Service\Autenticacion::login',
    '/^logout\//i' => 'Aluc\Service\Autenticacion::logout',
    '/^reservas\//i' => ReservasSrv::urls(),
    '/^admin\//i' => AdministradorSrv::urls(),
    '/^escritorio\//i' => EscritorioSrv::urls(),
    '/^laboratorios\//i' => LaboratorioSrv::urls(),
    '/^error\//i' => ErrorSrv::urls(),
    '/.*/' => ErrorSrv::url404()
]);

