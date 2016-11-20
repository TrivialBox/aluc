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
<div>
    <!-- Lista de todos los moderadores -->
    <div class="container">
        <h2>Moderadores</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModerador">
            Nuevo
        </button>

        <table class="table table-striped">
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
                        <button type="button" class="btn btn-warning">
                            Editar
                        </button>
                        
                        <button type="button" class="btn btn-danger">
                            Eliminar
                        </button>
                    </td>
                    </tr>
TAG;
            }
            ?>
            </tbody>
        </table>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModerador">
            Nuevo
        </button>
    </div>
    <!-- Fin lista de moderadores -->


    <!-- Modal para agregar moderador -->
    <div class="modal fade" id="addModerador" tabindex="-1" role="dialog" aria-labelledby="modalAddModerador" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="modalAddModerador">
                Agregar Moderador
            </h4>
          </div>
          <div class="modal-body">
              <form>
                  <div class="form-group">
                      <label for="id">ID del Usuario</label>
                      <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese el id del usuario">
                      <small id="emailHelp" class="form-text text-muted">
                          El id puede ser un número de cedula.
                      </small>
                  </div>
                  <div class="form-group">
                      <label for="laboratorio_id">ID del Laboratorio</label>
                      <input type="text" class="form-control" id="laboratorio_id" placeholder="Ingrese el id del laboratorio">
                  </div>
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancelar
            </button>
            <button id="add_moderador" class="btn btn-primary">
                Agregar
            </button>

          </div>
        </div>
      </div>
    </div>
    <!-- Fin de modal para agregar moderador -->

</div>

<!-- Recursos adicionales -->
<script src="/js/moderadores.js"></script>
<?php
include 'resources.php';
?>

</body>

</html>

