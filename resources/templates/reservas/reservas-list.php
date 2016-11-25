<div class="row">
    <?php
    foreach ($get('reservas') as $reserva) {
        $laboratorio = $reserva->getLaboratorio();
        $fecha = $reserva->getFecha();
        $panel_status = "panel-default";
        $disable = "";
        if ($reserva->estado !== 'reservado') {
            $panel_status = "panel-danger";
            $disable = "disabled";
        }
    echo <<<TAG
    <div class="col-sm-3 text-center">
        <div class="panel {$panel_status}">
            <div class="panel-heading">
                {$laboratorio->nombre} ({$laboratorio->id})
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <p>
                            {$reserva->descripcion}
                        </p>
                    </li>
                    <li class="list-group-item">
                        {$reserva->numero_usuarios}
                        <span class="glyphicon glyphicon-user pull-right"></span>
                    </li>
                    <li class="list-group-item">
                        {$fecha->fecha}
                        <span class="glyphicon glyphicon-calendar pull-right"></span>
                    </li>
                    <li class="list-group-item">
                        {$fecha->hora_inicio}
                        <span class="glyphicon glyphicon-time pull-right"></span>
                    </li>
                    <li class="list-group-item">
                        {$fecha->hora_fin}
                        <span class="glyphicon glyphicon-time pull-right"></span>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <div data-id="{$reserva->getId()}" class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-secondary {$disable}" {$disable} data-placement="top" title="Mostrar código QR" data-toggle="modal" data-target="#modal-show-qr">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                    <button type="button" class="btn btn-warning {$disable}" {$disable}>
                        Editar
                    </button>
                    <button type="button" class="btn btn-danger {$disable}" {$disable} data-toggle="modal" data-target="#modal-confirm-cancel-reserva">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
TAG;
    }
    ?>
</div>
