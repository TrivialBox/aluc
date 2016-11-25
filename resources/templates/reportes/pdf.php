<?php
use Aluc\Common\TemplateGenerator;

ob_start();
TemplateGenerator::generate([
        'headers' => $get('headers'),
        'rows' =>$get('rows'),
        'name' =>$get('name'),
        'name_admin' => $get('name_admin')
    ],
    'reportes/html-to-pdf.php'
);

$content = ob_get_clean();

$html2pdf = new Html2Pdf('P', 'A4', 'es');
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->setDefaultFont('Arial');
$html2pdf->writeHTML($content);

TemplateGenerator::generate([], 'common/no-cache.php');
header("Content-type:application/pdf");

$html2pdf->Output($get('name'));

