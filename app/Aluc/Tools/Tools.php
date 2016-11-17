<?php
namespace Aluc\Tools;


/**
 * Herramientas de uso general para todo el sistema.
 */
class Tools {
    public  static function check_session(...$type) {
        return isset($_SESSION['id']) && !empty($_SESSION['id']) &&
        isset($_SESSION['type']) && in_array($_SESSION['type'], $type);
    }

    public  static function check_method($method) {
        return $_SERVER['REQUEST_METHOD'] === strtoupper($method);
    }

    public static function clean_element($element) {
         if (is_array($element)) {
             $arr = [];
            foreach ($element as $key => $value) {
                $arr[$key] = static::clean_string($value);
            }
            return $arr;
        } else if (is_string($element)) {
            return static::clean_string($element);
        }
        return $element;
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
