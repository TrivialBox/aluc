<?php
use Aluc\Common\TemplateGenerator;
?>
<div class="tab-pane fade in active"id="reservas-nuevas-content">
<?php
TemplateGenerator::generate([
        'reservas' => $get('reservas_nuevas')
    ],
    'escritorio/reservas-list.php'
);
?>
</div>
<div class="tab-pane fade in" id="reservas-pasadas-content">
<?php
TemplateGenerator::generate([
        'reservas' => $get('reservas_pasadas')
    ],
    'escritorio/reservas-list.php'
);
?>
</div>
