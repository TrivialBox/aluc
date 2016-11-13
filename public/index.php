<?php
include_once '../app/init.php';

use Aluc\Tools\Urls;
use Aluc\Views\ModeradoresView;


function moderadores() {
    ModeradoresView::getInstance()->listAll()->render();
}

function home() {
    echo 'Página de inicio';
}

function not_found() {
    include '404.html';
}

Urls::serve_request(
    array(
        '/^\/$/' => 'home',
        '/^\/admin\/moderadores$/i' => 'moderadores',
        '/.*/' => 'not_found'
    )
);
