<?php
use Aluc\Common\TemplateGenerator;
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Commont -->
    <?php
        TemplateGenerator::generate([], 'common/header.php');
    ?>
    <!-- Timepicker -->
    <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

    <!-- Custom -->
    <style>
        .tab-content {
            margin-top: 20px;
        }
    </style>

    <title>
        Reservas
    </title>
</head>
<body>
    <!-- Navbar -->
    <?php
        TemplateGenerator::generate([], 'common/navbar.php');
    ?>

<!-- contenedor principal -->
<div class="container">
    <div class="row">
        <!-- sidebar, debería ir un sidebar aquí? -->
<!--        <div class="col-sm-3">
            Sidebar
        </div>-->
        <!-- END sidebar -->

        <!-- main content -->
        <div class="col-sm-12">
            <div class="page-header clearfix">
                <h1>
                    <span>Reservas</span>
                    <button id="btn-add-reserva" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-reserva">
                        Nueva
                    </button>
                </h1>
            </div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item active">
                    <a class="nav-link" data-toggle="tab" href="#reservas-nuevas-content" id="reservas-nuevas-tab">
                        Nuevas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#reservas-pasadas-content" id="reservas-pasadas-tab">
                        Pasadas
                    </a>
                </li>

            </ul>
            <!-- END nav-tabs -->

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="reservas-nuevas-content" role="tabpanel">
                    <div class="container">
                        <?php
                        TemplateGenerator::generate([
                            'reservas' => $get('reservas'),
                        ],
                            'reservas/reservas-list.php'
                        );
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade in" id="reservas-pasadas-content" role="tabpanel">
                    <!-- Reservas pasadas del pasado presente -->
                </div>
                <?php
                if (empty($get('reservas'))) {
                    TemplateGenerator::generate([], 'reservas/tip-container.php');
                }
                ?>
            </div>
            <!-- END panes -->

        </div>
        <!-- END main content -->

    </div>
</div>

<!-- Modal add-reserva -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-add-reserva">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">
                    Nueva Reserva
                </h4>
            </div>

            <form id="form-add-reserva">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_laboratorio">Id del Laboratorio</label>
                        <select  class="form-control" id="id_laboratorio" name="id_laboratorio">
                            <?php
                            foreach ($get('laboratorios') as $laboratorio) {
                                echo <<<TAG
                                <option value="{$laboratorio->id}">{$laboratorio->nombre} ({$laboratorio->id})</option>
TAG;
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                        if (\Aluc\Common\Tools::check_session('profesor')) {
                            ?>
                            <div class="form-group">
                                <label for="tipo_uso">Tipo de Uso</label>
                                <select class="form-control" id="tipo_uso" name="tipo_uso">
                                    <option value="práctica">Práctica</option>
                                    <option value="clases">Clases</option>
                                </select>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <label for="numero_usuarios">Número de Usuarios</label>
                        <input required="required" name="numero_usuarios" class="form-control" type="number" max="100" min="1" value="1" id="numero_usuarios" placeholder="Ingrese el número de usuarios">
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha de la Reserva</label>
                        <div class='input-group date' id='date-picker-reserva'>
                            <input required="required" type="text" id="fecha" name="fecha" placeholder="Ingrese la fecha de la reserva" class="form-control"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="container row">
                            <div class='col-sm-2 col-sm-offset-1'>
                                <div class="form-group">
                                    <label for="hora-inicio">Hora de Inicio</label>
                                    <div class='input-group date' id='hora-inicio-reserva'>
                                        <input required="required" id="hora-inicio" name="hora_inicio" type='text' class="form-control" placeholder="Hora de inicio"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class='col-sm-2'>
                                <div class="form-group">
                                    <label for="hora-fin">Hora de Fin</label>
                                    <div class='input-group date' id='hora-fin-reserva'>
                                        <input required="required" id="hora-fin" name="hora_fin" type='text' class="form-control" placeholder="Hora de fin"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="descripcion">Descripción</label>
                      <textarea required="required" type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Provea una breve descripción de cómo va  a usar el laboratorio."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" id="submit-add-reserva" class="btn btn-primary">
                        Reservar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END modal add-reserva -->

<!-- Modal edit-reserva -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-edit-reserva">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">
                    Editar Reserva
                </h4>
            </div>

            <form id="form-edit-reserva">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id">Id del Usuario</label>
                        <input required="required" id="id" type="text" name="id" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="id_laboratorio">Id del Laboratorio</label>
                        <input required="required" pattern="\d*" type="text" id="id_laboratorio" name="id_laboratorio" placeholder="Ingrese el id del laboratorio" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" id="submit-actualizar-reserva" class="btn btn-primary">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END modal add-reserva -->

<!-- Modal confirm-cancel-reserva -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-confirm-cancel-reserva">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">
                    ¿Cancelar reserva?
                </h4>
            </div>

            <form id="form-cancel-reserva">
                <input value="" type="hidden" id="id" name="id">
                <div class="modal-body bg-warning">
                    Al cancelar una reserva esta ya no podrá ser usada,
                    si desea tener nuevamente esta reserva, deberá
                    crear una nueva. Esta acción es <strong>irreversible</strong>.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        No, conservar reserva
                    </button>
                    <button type="submit" id="submit-cancel-reserva" class="btn btn-danger">
                        Si, cancelar reserva
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END modal-confirm-cancel-reserva -->


<!-- Modal show-qr -->
<div class="modal fade in" tabindex="-1" role="dialog" id="modal-show-qr">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">
                    Código QR de Acceso
                </h4>
            </div>
            <div class="modal-body text-center">
                <div id="qr-code-img">
                </div>
                <small class="text-muted">
                    Presente éste código desde su teléfono o impreso antes de acceder al laboratorio.
                </small>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="btn-download-qr" download="codigo_qr.png">
                    Descargar
                </a>
            </div>
        </div>
    </div>
</div>
<!-- END modal-show-qr -->

<!-- Recursos adicionales -->
<?php
TemplateGenerator::generate([], 'common/html-resources.php');
TemplateGenerator::generate([], 'common/js-resources.php');
?>
<script src="/js/reservas/modals.js"></script>
<script src="/js/reservas/shortcuts.js"></script>
<script src="/js/reservas/ajax.js"></script>
<script src="/js/reservas/tabs.js"></script>

<!-- Timepicker -->
<script src="/bower_components/moment/min/moment.min.js"></script>
<script src="/bower_components/moment/locale/es.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/js/reservas/time.js"></script>

</body>
</html>
