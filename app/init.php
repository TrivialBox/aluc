<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/spipu/html2pdf/html2pdf.class.php';

error_reporting(E_ALL | E_STRICT);

// Tratar todos los errores como excepciones.
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new Exception($errstr, $errno);
}
set_error_handler("exception_error_handler");

ini_set('display_errors', 0);
ini_set('log_errors', 1);

