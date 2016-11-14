<?php
namespace Aluc\Service;

use Aluc\Views\GeneralView;


/**
 * Clase que contiene todas las funcionalidades de /.
 */
class ErrorSrv {
    private static $view_general;

    public static function init() {
        static::$view_general = GeneralView::getInstance();
    }

    public static function error404() {
        $view = self::$view_general->error404();
        $view->render();
    }
}

ErrorSrv::init();