<?php
use League\Csv\Writer;
use Aluc\Common\TemplateGenerator;

TemplateGenerator::generate([], 'common/no-cache.php');

header("Content-type: text/csv");

$writer = Writer::createFromFileObject(new SplTempFileObject());
$writer->setDelimiter(',');
$writer->setNewline("\r\n");
$writer->setOutputBOM(Writer::BOM_UTF8);
$writer->insertOne($get('headers'));
$writer->insertAll($get('rows'));

$writer->output($get('name'));

