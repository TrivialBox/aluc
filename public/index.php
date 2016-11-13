<?php
session_start();
include_once '../app/init.php';

use Aluc\Tools\Urls;
use Aluc\Views\ModeradoresView;


function moderadores() {
    if (
        isset($_SESSION['id']) && !empty($_SESSION['id']) &&
        isset($_SESSION['type']) && $_SESSION['type'] === 'admin'
    ) {
        echo "welcome!";
    } else {
        die("NO");
    }
    ModeradoresView::getInstance()->listAll()->render();
}

function home() {
    echo 'Página de inicio';
}

function not_found() {
    include '404.html';
}

function login() {
    include 'login.php';
}

Urls::serve_request(
    array(
        '/^\/$/' => 'home',
        '/^\/login$/i' => 'login',
        '/^\/admin\/moderadores$/i' => 'moderadores',
        '/.*/' => 'not_found'
    )
);
