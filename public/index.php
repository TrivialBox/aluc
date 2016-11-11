<?php
include_once '../app/init.php';

use Aluc\Service\TemplateGenerator;

$valores = array(
    'title' => 'Test - Template',
    'body' => 'Hola mundo!'
);

TemplateGenerator::generate($valores, 'template_ejemplo.php');

