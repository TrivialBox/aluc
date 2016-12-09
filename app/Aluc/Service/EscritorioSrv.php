<?php
namespace Aluc\Service;

use Aluc\Common\Tools;
use Aluc\Models\Moderador;
use Aluc\Models\Reserva;
use Aluc\Views\GeneralView;
use Aluc\Views\ReporteView;
use Aluc\Views\ReservaView;

/**
 * Clase que maneja todas las solicitudes a /escritorio
 */
class EscritorioSrv {
    private static $view_general;
    private static $view_reportes;
    private static $view_reserva;

    public static function init() {
        static::$view_general = GeneralView::getInstance();
        static::$view_reportes = ReporteView::getInstance();
        static::$view_reserva = ReservaView::getInstance();
    }

    private static function user_do($func, $error) {
        try {
            if (Tools::check_session('admin', 'moderador')) {
                $func();
            } else {
                ErrorSrv::redirect404();
            }
        } catch (\Exception $e) {
            $error($e);
        }
    }

    /**
     * /escritorio
     *
     * Muestra la página principal del moderación
     * donde se dispone de varias herramientas
     * que le permiten ver al moderador
     * el estado actual de las reservas del
     * laboratorio que está a cargo, en caso
     * de ser un administrador, tiene acceso
     * a todos los laboratorios.
     * @param $data
     */
    public static function escritorio($data) {
        self::user_do(
            function () use ($data){
                $id = $_SESSION['id'];
                if (!empty($data) and Tools::check_method('get')) {
                    if (Tools::check_session('moderador')) {
                        $id_laboratorio = Moderador::getInstance($id)->id_laboratorio;
                    } else {
                        // Es administrador
                        $id_laboratorio = $data['id_laboratorio'];
                    }
                    self::$view_reserva
                        ->listReservasLaboratorioCompact($id_laboratorio)
                        ->render();
                } else {
                    self::$view_reserva
                        ->homeModerador($id)
                        ->render();
                }
            },
            function ($e) {
                self::$view_general
                    ->error404()
                    ->render();
            }
        );
    }

    /**
     * /escritorio/reportes
     *
     * Muestra una serie de reportes
     * en formato de tablas donde
     * se puede visualizar a la información
     * de la actividad en los laboratorios
     * y exportar esta información.
     */
    public static function reportes($data) {
        self::user_do(
            function () use ($data) {
                if (Tools::check_method('get')) {
                    $fecha = 'today';
                    $id_laboratorio = null;
                    $id_usuario = null;
                    if (array_key_exists('fecha', $data)) {
                        $fecha = $data['fecha'];
                    }
                    if (array_key_exists('id_laboratorio', $data) && $data['id_laboratorio'] != "-1") {
                        $id_laboratorio = $data['id_laboratorio'];
                    }
                    if (array_key_exists('id_usuario', $data) && !empty($data['id_usuario'])) {
                        $id_usuario = $data['id_usuario'];
                    }
                    if ($fecha == 'other') {
                        $fecha_inicio = Tools::getCanonicalFecha($data['fecha_inicio']);
                        $fecha_fin = Tools::getCanonicalFecha($data['fecha_fin']);
                        static::$view_reportes
                            ->listByType($fecha, $id_usuario, $id_laboratorio, $fecha_inicio, $fecha_fin)
                            ->render();
                    } else {
                        static::$view_reportes
                            ->listByType($fecha, $id_usuario, $id_laboratorio)
                            ->render();
                    }
                } else if (Tools::check_method('post')) {
                    self::$view_general
                        ->error404()
                        ->render();
                }
            },
            function ($e) {
                self::$view_general
                    ->error404()
                    ->render();
            }
        );
    }

    /**
     * /escritorio/exportar
     *
     * Permite exportar un reporte en formato
     * pdf y csv. Se realiza una solicitud vía get.
     * Sólo un moderador o administrador
     * puede realzar esta acción.
     * @param $data
     */
    public static function reportes_exportar($data) {
        self::user_do(
            function () use ($data) {
                if (!empty($data) and Tools::check_method('get')) {
                    $file_type = $data['type'];
                    $fecha = 'today';
                    $id_laboratorio = null;
                    $id_usuario = null;
                    $fecha_inicio = null;
                    $fecha_fin = null;
                    if (array_key_exists('fecha', $data)) {
                        $fecha = $data['fecha'];
                    }
                    if (array_key_exists('id_laboratorio', $data) && $data['id_laboratorio'] != "-1") {
                        $id_laboratorio = $data['id_laboratorio'];
                    }
                    if (array_key_exists('id_usuario', $data) && !empty($data['id_usuario'])) {
                        $id_usuario = $data['id_usuario'];
                    }
                    if ($fecha == 'other') {
                        $fecha_inicio = Tools::getCanonicalFecha($data['fecha_inicio']);
                        $fecha_fin = Tools::getCanonicalFecha($data['fecha_fin']);
                    }
                    if ($file_type == 'pdf') {
                        self::$view_reportes
                            ->pdf($fecha, $id_usuario, $id_laboratorio, $fecha_inicio, $fecha_fin)
                            ->render();
                    } else if ($file_type == 'csv') {
                        self::$view_reportes
                            ->csv()
                            ->render();
                    }
                } else {
                    self::$view_general
                        ->error404()
                        ->render();
                }
            },
            function ($e) {
                self::$view_general
                    ->error404()
                    ->render();
            }
        );
    }


    /**
     * URLS para el direccionamiento (url routing).
     * @return array
     */
    public static function urls() {
        $class_name =  __CLASS__;
        return [
            '/^$/i' => "{$class_name}::escritorio",
            '/^reportes\//i' => [
                '/^$/' => "{$class_name}::reportes",
                '/^exportar\/$/i' => "{$class_name}::reportes_exportar"
            ]
        ];
    }
}

EscritorioSrv::init();
