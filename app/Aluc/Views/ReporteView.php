<?php
namespace Aluc\Views;
use Aluc\Models\Laboratorio;


/**
 * Clase encargada de representar todo
 * tipo de reportes del sistema.
 */
class ReporteView extends View {
    private static $instance = null;

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function listAll($report) {
        $data['headers'] = array_shift($report);
        $data['rows'] = $report;
        $data['laboratorios'] = Laboratorio::getAll();
        $this->setTemplate(
            $data,
            'reportes/reportes.php'
        );
        return $this;
    }

    public function listByType($type, $id_user, $id_laboratorio, $fecha_inicio = null, $fecha_fin = null) {
        $class_name = 'Aluc\Models\Reporte';
        $types = [
            'today' => "{$class_name}::getReporteDia",
            'this week' => "{$class_name}::getReporteSemana",
            'this month' => "{$class_name}::getReporteMes",
            'this year' => "{$class_name}::getReporteAnio",
            'other' => "{$class_name}::getReportes"
        ];
        $func = $types['today'];
        if (array_key_exists($type, $types)) {
            $func = $types[$type];
        }
        if ($type == "other") {
            return self::listAll($func($fecha_inicio, $fecha_fin, $id_user, $id_laboratorio));
        }
        return self::listAll($func($id_user, $id_laboratorio));
    }

    public function csv($name = 'reporte.csv') {
        $data = [];
        $data['name'] = $name;
        $data['headers'] = ['ID', 'Nombre', 'Apellido'];
        $data['rows'] = [
            ['1', '4', '3'],
            ['1', '4', '3'],
            ['1', '8', '6'],
            ['5', '3', '3'],
            ['1', '4', '4'],
            ['1', '4', '9'],
            ['1', '4', '7'],
            ['4', '5', '4'],
            ['2', '5', '4'],
            ['1', '4', '4'],
            ['2', '14', '3'],
            ['1', '3', '3'],
            ['2', '3', '3'],
            ['2', '2', '3'],
            ['1', '2', '3'],
            ['2', '2', '3']
        ];
        $this->setTemplate(
            $data,
            'reportes/csv.php'
        );
        return $this;
    }

    public function pdf($name = 'reporte.pdf',$name_admin= 'administador') {
        $data = [];
        $data['name_admin'] = $name_admin;
        $data['name'] = $name;
        $data['headers'] = ['ID', 'Nombre', 'Apellido'];
        $data['rows'] = [
            ['1', '4', '3'],
            ['1', '4', '3'],
            ['1', '8', '6'],
            ['5', '3', '3'],
            ['1', '4', '4'],
            ['1', '4', '9'],
            ['1', '4', '7'],
            ['4', '5', '4'],
            ['2', '5', '4'],
            ['1', '4', '4'],
            ['2', '14', '3'],
            ['1', '3', '3'],
            ['2', '3', '3'],
            ['2', '2', '3'],
            ['1', '2', '3'],
            ['2', '2', '3']
        ];
        $this->setTemplate(
            $data,
            'reportes/pdf.php'
        );
        return $this;
    }
}

