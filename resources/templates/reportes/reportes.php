<?php
use Aluc\Common\TemplateGenerator;

?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            TemplateGenerator::generate([], 'common/header.php');
        ?>
        <!-- Timepicker -->
        <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

        <title>Reportes</title>
    </head>
    <body>
        <!-- Navbar -->
        <?php
            TemplateGenerator::generate([], 'common/navbar.php');
        ?>
        <div class="container">
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
                                <span>Reportes</span>
                                <div class="pull-right">
                                    <div class="dropdown">
                                        <button id="btn-export-table-as" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Exportar <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a class="dropdown-item" target="_blank" href="#" id="export-pdf">
                                                    PDF
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" target="_blank" href="#" id="export-csv">
                                                    CSV
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </h1>
                        </div>

                        <div class="header">
                            <h4>
                                Filtrar por:
                            </h4>
                        </div>
                        <div class="navbar navbar-default">
                            <form id="filter-form" class="navbar-form">
                                <div class="form-group">
                                  <label for="fecha">Fecha</label>
                                  <select class="form-control" id="fecha" name="fecha">
                                    <option value="today">Hoy</option>
                                    <option value="this-week">Esta semana</option>
                                    <option value="this-month">Este mes</option>
                                    <option value="this-year">Este año</option>
                                    <option value="other">Otra</option>
                                  </select>
                                </div>
                              <div id="custom-date" class="collapse" style="padding: 2%">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="fecha-inicio">Fecha de Inicio</label>
                                        <div class="input-group date" id="fecha-inicio">
                                            <input id="fecha-inicio" name="fecha_inicio" type='text' class="form-control" placeholder="Fecha de inicio"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha-fin">Fecha de Fin</label>
                                        <div class="input-group date" id="fecha-fin">
                                            <input id="fecha-fin" name="fecha_fin" type='text' class="form-control" placeholder="Fecha de fin"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                              </div>
                                <div class="form-group">
                                    <label for="id_laboratorio">Laboratorio</label>
                                    <select  class="form-control" id="id_laboratorio" name="id_laboratorio">
                                        <option value="-1">Todos</option>
                                        <?php
                                        foreach ($get('laboratorios') as $laboratorio) {
                                            echo <<<TAG
                                <option value="{$laboratorio->id}">{$laboratorio->nombre} ({$laboratorio->id})</option>
TAG;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label for="id_usuario">Usuario</label>
                                  <input type="text" class="form-control" id="id_usuario" name="id_usuario" placeholder="Todos">
                                </div>
                                <button type="submit" class="btn btn-default pull-right">Aplicar</button>
                            </form>
                        </div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <!-- Botón de exportar -->
                            <li class="nav-item pull-right">
                            </li>
                        </ul>
                        <!-- END nav-tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="report-content" role="tabpanel">
                                <!-- Tabla editable -->
                                <div class="table-responsive">
                                    <?php
                                    if (empty($get('rows'))) {
                                        TemplateGenerator::generate([], 'reportes/tip-container.php');
                                    } else {
                                        TemplateGenerator::generate([
                                            'headers' => $get('headers'),
                                            'rows' => $get('rows'),
                                        ],
                                            'reportes/report-table.php'
                                        );
                                    }
                                    ?>
                                </div>
                                <!-- END Tabla -->
                            </div>
                        </div>
                        <!-- END panes -->

                    </div>
                    <!-- END main content -->
                </div>
            </div>
            <!-- END contenedor principal -->

        </div>

<!-- Recursos adicionales -->
<?php
    TemplateGenerator::generate([], 'common/html-resources.php');
    TemplateGenerator::generate([], 'common/js-resources.php');
?>

<!-- Timepicker -->
<script src="/bower_components/moment/min/moment.min.js"></script>
<script src="/bower_components/moment/locale/es.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/js/reportes/time.js"></script>
<script src="/js/common/forms.js"></script>
<script src="/js/reportes/modals.js"></script>

</body>
</html>
