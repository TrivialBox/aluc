<?php
namespace Aluc\Service;

use Aluc\Common\Tools;
use Aluc\Views\GeneralView;
use Aluc\Views\ReporteView;

/**
 * Clase que maneja todas las solicitudes a /escritorio
 */
class EscritorioSrv {
    private static $view_general;
    private static $view_reportes;

    public static function init() {
        static::$view_general = GeneralView::getInstance();
        static::$view_reportes = ReporteView::getInstance();
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
                echo "escritorio";
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
                static::$view_reportes
                    ->listAll()
                    ->render();
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
            '/^reportes\/$/i' => "{$class_name}::reportes",
        ];
    }
}

EscritorioSrv::init();
