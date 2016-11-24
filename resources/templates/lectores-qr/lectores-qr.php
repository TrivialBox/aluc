<?php
use Aluc\Common\TemplateGenerator;
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Data table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.css"/>

    <!-- Commont -->
    <?php
        TemplateGenerator::generate([], 'common/header.php');
    ?>
    <title>
        Administrar lectores QR
    </title>
</head>
<body>

    <!-- Navbar -->
    <?php
        TemplateGenerator::generate([
            'user' => $_SESSION['id']
        ],
            'common/navbar.php'
        );
    ?>

    <!-- contenedor principal -->
    <div class="container">
        <div class="row">
            <!-- sidebar -->
            <div class="col-sm-3">
                <?php
                TemplateGenerator::generate([
                ],
                    'common/sidebar.php'
                );
                ?>
            </div>
            <!-- END sidebar -->

            <!-- main content -->
            <div class="col-sm-9">
                <div class="page-header clearfix">
                    <h1>
                        <span>Lectores QR</span>
                        <button id="btn-add-lector-qr" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-lector-qr">
                            Nuevo
                        </button>
                    </h1>
                </div>

                <!-- Tabla editable de lectores -->
                <table id="table-lectores-qr" class="table table-hover table-condensed table-responsive">
                    <thead>
                        <tr>
                            <th>MAC</th>
                            <th>IP</th>
                            <th>Laboratorio</th>
                            <th>Token</th>
                            <th><span class="pull-right">Acción</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    TemplateGenerator::generate([
                            'lectores_qr' => $get('lectores_qr')
                        ],
                        'lectores-qr/lectores-qr-list.php'
                    );
                    ?>
                    </tbody>
                </table>
                <!-- END Tabla editable de lectores -->

                <?php
                if (empty($get('lectores_qr'))) {
                    TemplateGenerator::generate([], 'lectores-qr/tip-container.php');
                }
                ?>

            </div>
            <!-- END main content -->

        </div>
    </div>

    <!-- Modal add-lector-qr -->
    <div class="modal fade in" tabindex="-1" role="dialog" id="modal-add-lector-qr">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                    <h4 class="modal-title">
                        Agregar Lector
                    </h4>
                </div>

            <form id="form-add-lector-qr">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="mac">MAC</label>
                            <input required="required" id="mac" type="text" name="mac" placeholder="Ingrese la MAC del dispositivo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ip">IP</label>
                            <input required="required" id="ip" type="text" name="ip" placeholder="Ingrese la IP asociada al dispositivo" class="form-control">
                            <small class="form-text text-muted">
                                Esta IP se comprobará cada vez que el lector QR interactúe con el sistema.
                            </small>
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
                        <button type="submit" id="submit-add-lector-qr" class="btn btn-primary">
                            Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END modal add-lector-qr -->

    <!-- Modal edit-lector-qr -->
    <div class="modal fade in" tabindex="-1" role="dialog" id="modal-edit-lector-qr">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                    <h4 class="modal-title">
                        Editar Lector
                    </h4>
                </div>

                <form id="form-edit-lector-qr">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id">MAC</label>
                            <input required="required" id="mac" type="text" name="mac" class="form-control" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="ip">IP</label>
                            <input required="required" id="ip" type="text" name="ip" placeholder="Ingrese la IP asociada al dispositivo" class="form-control">
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
                        <button type="submit" id="submit-actualizar-lector-qr" class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END modal add-lector-qr -->

    <!-- Modal confirm-delete-lector-qr -->
    <div class="modal fade in" tabindex="-1" role="dialog" id="modal-confirm-delete-lector-qr">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                    <h4 class="modal-title">
                        ¿Eliminar lector QR <span id="mac-lector-qr" class="text-danger"></span>?
                    </h4>
                </div>

                <form id="form-delete-lector-qr">
                    <input value="" type="hidden" id="mac" name="mac">
                    <div class="modal-body bg-warning">
                        Al eliminar un lector QR este ya no podrá enviar
                        solicitudes de validación de entradas al servidor.
                        Esta acción es <strong>irreversible</strong>.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            No, conservar lector QR
                        </button>
                        <button type="submit" id="submit-delete-lector-qr" class="btn btn-danger">
                            Si, eliminar lector QR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END modal-confirm-delete-lector-qr -->

    <!-- Modal confirm-update-token-lector-qr -->
    <div class="modal fade in" tabindex="-1" role="dialog" id="modal-confirm-update-token-lector-qr">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                    <h4 class="modal-title">
                        ¿Renovar token del lector QR <span id="mac-lector-qr" class="text-danger"></span>?
                    </h4>
                </div>

                <form id="form-update-token-lector-qr">
                    <input value="" type="hidden" id="mac" name="mac">
                    <div class="modal-body bg-warning">
                        Al renovar el token de un lector QR este ya no podrá
                        enviar solicitudes de validación de entradas al servidor,
                        deberá actualizar el nuevo token manualmente en el dispositivo.
                        Esta acción es <strong>irreversible</strong>.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            No, conservar token actual
                        </button>
                        <button type="submit" id="submit-update-token-lector-qr" class="btn btn-danger">
                            Si, renovar token
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END modal-confirm-delete-lector-qr -->

<!-- Recursos adicionales -->
<?php
    TemplateGenerator::generate([], 'common/html-resources.php');
    TemplateGenerator::generate([], 'common/js-resources.php');
?>
<script src="/js/lectores-qr/modals.js"></script>
<script src="/js/lectores-qr/shortcuts.js"></script>
<script src="/js/lectores-qr/ajax.js"></script>

<!-- Data tables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script>
<script src="/js/lectores-qr/tables.js"></script>

</body>
</html>
