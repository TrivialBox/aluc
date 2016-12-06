<?php
use Aluc\Common\TemplateGenerator;
use Aluc\Models\Reserva;
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Common -->
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
        Escritorio
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
        <!-- sidebar -->
        <div class="col-sm-3">
            <?php
            TemplateGenerator::generate([], 'common/sidebar.php');
            ?>
        </div>
        <!-- END sidebar -->

        <!-- main content -->
        <div class="col-sm-9">
            <div class="page-header clearfix">
                <h1>
                    <span>Reservas</span>
                </h1>
                <select class="form-control" id="laboratorios">
<?php
foreach ($get('laboratorios') as $laboratorio) {
    echo <<<TAG
                                <option value="{$laboratorio->id}">{$laboratorio->nombre} ({$laboratorio->id})</option>
TAG;
}
?>
                </select>
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

            <!-- Contenido -->
            <div class="tab-content" id="reservas-content">
            </div>
            <!-- END panes -->

        </div>
        <!-- END main content -->

    </div>
</div>

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
<script src="/js/escritorio/ajax.js"></script>

<!-- Timepicker -->
<script src="/bower_components/moment/min/moment.min.js"></script>
<script src="/bower_components/moment/locale/es.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/js/reservas/time.js"></script>

</body>
</html>
