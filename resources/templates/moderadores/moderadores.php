<?php
use Aluc\Common\TemplateGenerator;
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        TemplateGenerator::generate([], 'common/header.php');
    ?>
    <title>
        Administrar moderadores
    </title>
</head>
<body>
    <!-- Aquí iría el el navbar... si tuviera uno -->

    <!-- contenedor principal -->
    <div class="container">
        <div class="row">
            <!-- sidebar -->
            <div class="col-sm-3">
                Sidebar
            </div>
            <!-- END sidebar -->

            <!-- main content -->
            <div class="col-sm-9">
                <div class="page-header clearfix">
                    <h1>
                        <span>Moderadores</span>
                        <button id="btn-add-moderador" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-moderador">
                            Nuevo
                        </button>
                    </h1>
                </div>

                <!-- Tabla editable de moderadores -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID </th>
                            <th>Nombre</th>
                            <th>Laboratorio</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    TemplateGenerator::generate([
                            'moderadores' => $get('moderadores')
                        ],
                        'moderadores/moderadores_list.php'
                    );
                    ?>
                    </tbody>
                </table>
                <!-- END Tabla editable de moderadores -->

                <?php
                if (empty($get('moderadores'))) {
                    TemplateGenerator::generate([
                            'title' => 'Nada por aquí.',
                            'tip' => 'Agrega nuevos moderadores con el botón <code>Nuevo</code> ó presionando <kbd>n</kbd>.'
                        ],
                        'common/tip_container.php'
                    );
                }
                ?>

            </div>
            <!-- END main content -->

        </div>
    </div>

    <!-- Modal add-moderador -->
    <div class="modal fade in" tabindex="-1" role="dialog" id="modal-add-moderador">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                    <h4 class="modal-title">
                        Agregar Moderador
                    </h4>
                </div>

                <form id="form-add-moderador">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id">Id del Usuario</label>
                            <input required="required" id="id" type="text" name="id" placeholder="Ingrese el id del usuario" class="form-control">
                            <small class="form-text text-muted">
                                El id puede ser el número de cédula.
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
                        <button type="submit" id="submit-add-moderador" class="btn btn-primary">
                            Agregar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END modal add-moderador -->

    <!-- Modal edit-moderador -->
    <div class="modal fade in" tabindex="-1" role="dialog" id="modal-edit-moderador">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                    <h4 class="modal-title">
                        Editar Moderador
                    </h4>
                </div>

                <form id="form-edit-moderador">
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
                        <button type="submit" id="submit-actualizar-moderador" class="btn btn-primary">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END modal add-moderador -->

    <!-- Modal confirm-delete-moderador -->
    <div class="modal fade in" tabindex="-1" role="dialog" id="modal-confirm-delete-moderador">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                    <h4 class="modal-title">
                        ¿Eliminar Moderador <span id="id-moderador" class="text-danger"></span>?
                    </h4>
                </div>

                <form id="form-delete-moderador">
                    <input value="" type="hidden" id="id" name="id">
                    <div class="modal-body bg-warning">
                        Al eliminar un moderador este podrá seguir usando el sistema,
                        pero no tendrá acceso a la zona administrativa. Esta acción
                        es <strong>irreversible</strong>.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            No, conservar moderador
                        </button>
                        <button type="submit" id="submit-delete-moderador" class="btn btn-danger">
                            Si, eliminar moderador
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END modal-confirm-delete-moderador -->


    <!-- Contenedor de alertas -->
    <div id='container-alert' class="alert-fixed"></div>

    <!-- Loader -->
    <div class="loader-container modal" hidden="hidden">
        <div class="loader"></div>
    </div>

<!-- Recursos adicionales -->
<?php
    TemplateGenerator::generate([], 'common/resources.php');
?>
<script src="/js/moderadores/modals.js"></script>
<script src="/js/moderadores/shortcuts.js"></script>
<script src="/js/moderadores/ajax.js"></script>

</body>
</html>
