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
        $row_h = $get('row_h');
        if (empty($row_h)) {
            $row_h = '3';
        }
    echo <<<TAG
    <div class="col-sm-{$row_h} text-center">
        <div class="panel {$panel_status}">
            <div class="panel-heading">
                {$laboratorio->nombre} ({$laboratorio->id})
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="Descripción">
                        <p>
                            {$reserva->descripcion}
                        </p>
                    </li>
                    <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="Usuario">
                        {$reserva->getUsuarioId()}
                        <span class="glyphicon glyphicon-user pull-right"></span>
                    </li>
                    <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="Número de usuarios">
                        {$reserva->numero_usuarios}
                        <span class="glyphicon glyphicon-user pull-right"></span>
                    </li>
                    <li class="list-group-item data-toggle="tooltip" data-placement="top" title="Fecha de reserva"">
                        {$fecha->fecha}
                        <span class="glyphicon glyphicon-calendar pull-right"></span>
                    </li>
                    <li class="list-group-item data-toggle="tooltip" data-placement="top" title="Hora de inicio/fin">
                        {$fecha->hora_inicio} - {$fecha->hora_fin}
                        <span class="glyphicon glyphicon-time pull-right" ></span>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <div data-id="{$reserva->getId()}" class="btn-group btn-group-sm">
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
            </div>
        </div>
    </div>
TAG;
    }
    ?>
</div>
