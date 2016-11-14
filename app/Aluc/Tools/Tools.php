<?php
namespace Aluc\Tools;


/**
 * Herramientas de uso general para todo el sistema.
 */
class Tools {
    public  static function check_session($type) {
        // TODO: sacar el true, sólo para pruebas
        return true || isset($_SESSION['id']) && !empty($_SESSION['id']) &&
        isset($_SESSION['type']) && $_SESSION['type'] === $type;
    }

    public  static function check_method($method) {
        return $_SERVER['REQUEST_METHOD'] === strtoupper($method);
    }

    public static function clean_string($string) {
        // No queremos inyecciones de jeiquers!
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        $string = filter_var($string, FILTER_SANITIZE_STRING);
        return $string;
    }
}
