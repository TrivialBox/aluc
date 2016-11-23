<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../vendor/spipu/html2pdf/html2pdf.class.php';

// Tratar todos los errores como excepciones.
function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new Exception($errstr, $errno);
}
set_error_handler("exception_error_handler");
