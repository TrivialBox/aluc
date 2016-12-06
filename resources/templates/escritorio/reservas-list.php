<?php
use Aluc\Common\TemplateGenerator;

if (empty($get('reservas'))) {
    TemplateGenerator::generate([], 'reservas/tip-container.php');
} else {
    echo <<<'TAG'
<div class="table-responsive">
<table class="table table-condensed table-hover">
    <thead>
    <tr>
    <th>Usuario</th>
    <th>Uso</th>
    <th>Num. Usuarios</th>
    <th>Fecha</th>
    <th>Hora Inicio</th>
    <th>Hora Fin</th>
    <th><span class="pull-right">Acción</span></th>
    </tr>
    </thead>
    <tbody>
TAG;
    $i = 0;
    foreach ($get('reservas') as $reserva) {
        $i++;
        $laboratorio = $reserva->getLaboratorio();
        $fecha = $reserva->getFecha();
        $disable = '';
        if ($reserva->estado !== 'reservado') {
            $disable = 'disabled';
        }
        echo <<<TAG
    <tr class="">
        <td>{$reserva->getUsuarioId()}</td>
        <td>{$reserva->tipo_uso}</td>
        <td>{$reserva->numero_usuarios}</td>
        <td>{$fecha->fecha}</td>
        <td>{$fecha->hora_inicio}</td>
        <td>{$fecha->hora_fin}</td>
        <td>
            <div data-id="{$reserva->getId()}" class="btn-group btn-group-sm pull-right">
                <button class="btn btn-secondary" data-toggle="collapse" data-target="#collapse-{$i}">
                    Ver más
                </button>
                <button type="button" class="btn btn-secondary {$disable}" {$disable} data-placement="top" title="Mostrar código QR" data-toggle="modal" data-target="#modal-show-qr">
                    Ver QR
                </button>
                <!--
                <button type="button" class="btn btn-warning {$disable}" {$disable}>
                    Editar
                </button>
                -->
                <button type="button" class="btn btn-danger {$disable}" {$disable} data-toggle="modal" data-target="#modal-confirm-cancel-reserva">
                    Cancelar
                </button>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="7">
            <div id="collapse-{$i}" class="collapse">
                <dl>
                    <dt>ID Reserva</dt>
                    <dd>{$reserva->getId()}</dd>

                    <dt>Descripción</dt>
                    <dd>{$reserva->descripcion}</dd>

                    <dt>Estado</dt>
                    <dd>{$reserva->estado}</dd>

                    <dt>Laboratorio</dt>
                    <dd>{$laboratorio->nombre} ({$laboratorio->id})</dd>
                </dl>
            </div>
        </td>
    </tr>
TAG;
    }
    echo <<<'TAG'
    </tbody>
</table>
</div>
TAG;
}
?>

