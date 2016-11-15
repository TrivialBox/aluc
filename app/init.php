<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Tratar todos los errores como excepciones.
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new Exception($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler("exception_error_handler");
