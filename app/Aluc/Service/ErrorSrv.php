<?php
namespace Aluc\Service;

use Aluc\Common\Urls;
use Aluc\Views\GeneralView;


/**
 * Clase que maneja todas las solicitudes a /error
 */
class ErrorSrv {
    private static $view_general;

    public static function init() {
        static::$view_general = GeneralView::getInstance();
    }

    public static function error404($data) {
        self::$view_general
            ->error404()
            ->render();
    }

    public static function redirect404($data = null) {
        echo "Redireccionando...";
        Urls::redirect('/error/404');
    }

    public static function urls() {
        $class_name =  __CLASS__;
        return [
            '/^404\/$/i' => "{$class_name}::error404",
        ];
    }

    public static function url404() {
        $class_name =  __CLASS__;
        return "{$class_name}::redirect404";
    }
}

ErrorSrv::init();