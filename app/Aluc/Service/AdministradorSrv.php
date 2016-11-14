<?php
namespace Aluc\Service;

use Aluc\Views\ModeradorView;
use Aluc\Views\GeneralView;


/**
 *
 */
class AdministradorSrv {
    private static $view_moderador;
    private static $view_general;

    public static function init() {
        static::$view_moderador = ModeradorView::getInstance();
        static::$view_general = GeneralView::getInstance();
    }

    private static function chekSession($type) {
        return isset($_SESSION['id']) && !empty($_SESSION['id']) &&
               isset($_SESSION['type']) && $_SESSION['type'] !== $type;
    }

    public static function home() {
        // página principal del administrador
    }

    /**
     * Muestra una lista de todos los moderadores.
     * Sólo el administrador
     */
    public static function moderadores() {
        $view = null;
        try {
            if (!self::chekSession('admin')) {
                $view = self::$view_moderador->listAll();
            } else {
                $view = self::$view_general->error404();
            }
        } catch (\Exception $e) {
            $view  = self::$view_general->error404();
        } finally {
            $view->render();
        }
    }
}

AdministradorSrv::init();
