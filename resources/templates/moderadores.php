<html>
<head>
    <?php
    include 'header.php';
    ?>
    <title>
        Administrar moderadores
    </title>
</head>
<body>

<div class="alert-fixed">
    <div id="wrongAlert" class="alert alert-danger fade in" role="alert" hidden>
        <button type="button" class="close">
            <span>&times;</span>
        </button>
        <span id="wrongAlertMessage"></span>
    </div>
    <div id="successAlert" class="alert alert-success fade in" role="alert" hidden>
        <button type="button" class="close">
            <span>&times;</span>
        </button>
        <span id="successAlertMessage"></span>
    </div>
</div>

<div>
    <!-- Lista de todos los moderadores -->
    <div class="container">
        <div >
        <h2>Moderadores</h2>
        <button id="btn-add-moderador" type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModerador">
            Nuevo
        </button>
        </div>
        <table id="table-moderadores" class="table table-hover table-">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Laboratorio</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($get('moderadores') as $moderador) {
                $laboratorio = $moderador->getLaboratorio();
                echo <<<TAG
                <tr>
                <td>{$moderador->id}</td>
                <td>{$moderador->nombre}</td>
                <td>{$laboratorio->nombre} ({$laboratorio->id})</td>
                <td>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-warning" data-toggle="modal" target="#edit-moderador">
                            Editar
                        </button>
                        
                        <button value="{$moderador->id}" type="button" class="btn btn-danger btn-delete-mod">
                            Eliminar
                        </button>
                    </div>
                </td>
                </tr>
TAG;
            }
            ?>
            </tbody>
        </table>
        <?php
        if (empty($get('moderadores'))) {
            echo <<<TAG
            <h3 class="text-center">
            <span class="glyphicon glyphicon-info-sign"></span>
            </br>
            Nada por aquí
            </h3>
            <p class="text-center">
            Agrega nuevos moderadores presionando el botón <code>Nuevo</code> ó presionando <kbd>n</kbd>
            </p>
TAG;

        }
        ?>
    </div>
    <!-- Fin lista de moderadores -->

    <!-- Modal para agregar moderador -->
    <div class="modal fade" id="addModerador" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modalAddModerador">
                Agregar Moderador
            </h4>
          </div>
            <form id="form-add-moderador" method="post">
          <div class="modal-body">
                  <div class="form-group">
                      <label for="id">ID del Usuario</label>
                      <input required type="text" class="form-control" name="id" id="id" placeholder="Ingrese el id del usuario">
                      <small class="form-text text-muted">
                          El id puede ser un número de cedula.
                      </small>
                  </div>
                  <div class="form-group">
                      <label for="id_laboratorio">ID del Laboratorio</label>
                      <input required type="text" class="form-control" name="id_laboratorio" id="id_laboratorio" placeholder="Ingrese el id del laboratorio">
                  </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancelar
            </button>
            <button type="submit" id="add_moderador" class="btn btn-primary">
                Agregar
            </button>
            </form>
          </div>
        </div>
      </div>
</div>
<!-- Fin de modal para agregar moderador -->

<!-- Recursos adicionales -->
<script src="/js/moderadores.js"></script>
<?php
include 'resources.php';
?>

</body>

</html>

