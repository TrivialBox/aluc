<?php
$laboratorio = $get('laboratorio');
$horario = $laboratorio->horario;
$jornada1 = $horario->jornada1;
$jornada2 = $horario->jornada2;
?>
<div>
<ul class="list-group">
    <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="Laboratorio.">
        <a target="_blank" href="img/computer-lab.jpg"><img class="img-thumbnail" src="img/computer-lab.jpg" alt="Laboratorio"></a>
    </li>
    <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="Número máximo de personas.">
        <?php echo $laboratorio->capacidad ?>
        <span class="glyphicon pull-right">#</span>
    </li>
    <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="Horario de la primera jornada.">
        <?php echo $jornada1->hora_inicio ?>
        -
        <?php echo $jornada1->hora_fin ?>
        <span class="glyphicon glyphicon-time pull-right" ></span>
    </li>
    <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="Horario de la segunda jornada.">
        <?php echo $jornada2->hora_inicio ?>
        -
        <?php echo $jornada2->hora_fin ?>
        <span class="glyphicon glyphicon-time pull-right" ></span>
    </li>
    <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="Descripción.">
        <?php echo $laboratorio->descripcion ?>
    </li>
</ul>
</div>

