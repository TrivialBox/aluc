<div class="row">
    <?php
    foreach ($get('reservas') as $reserva) {
        $laboratorio = $reserva->getLaboratorio();
        $fecha = $reserva->getFecha();
    echo <<<TAG
    <div class="col-sm-3 text-center">
        <div class="panel panel-default">
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
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-secondary">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                    <!--
                    <button type="button" class="btn btn-warning">
                        Editar
                    </button>
                    -->
                    <button type="button" class="btn btn-danger">
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
