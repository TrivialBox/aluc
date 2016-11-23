<?php
use Aluc\Common\TemplateGenerator;
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            TemplateGenerator::generate([], 'common/header.php');
        ?>
        <title>Reportes</title>
    </head>
    <body>

        <div class="container">

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
                                <span>Reportes</span>
                            </h1>
                        </div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link" data-toggle="tab" href="#report-content">
                                    Uno
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#report-content">
                                    Dos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#report-content">
                                    Tres
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#report-content">
                                    Cuatro
                                </a>
                            </li>

                            <!-- Botón de exportar -->
                            <li class="nav-item pull-right">
                                <div class="dropdown">
                                    <button id="btn-export-table-as" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Exportar <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="exportar?file_type=pdf">
                                                PDF
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="exportar?file_type=csv">
                                                CSV
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <!-- END nav-tabs -->

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="report-content" role="tabpanel">
                                <!-- Tabla editable -->
                                <?php
                                    TemplateGenerator::generate([
                                            'headers' => $get('headers'),
                                            'rows' => $get('rows')
                                        ],
                                        'reportes/report-table.php'
                                    );
                                ?>
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
    </body>
</html>
