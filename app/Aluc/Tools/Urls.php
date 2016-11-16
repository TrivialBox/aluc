<?php
namespace Aluc\Tools;


/**
 * Clase encargada de realizar URL routing
 * usando expresiones regulares.
 */
class Urls {
    private static function get_url() {
        $base_url = static::get_current_uri();
        return $base_url;
    }

    private static function get_current_uri() {
        // Copy & paste, no tocar!
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        $uri = '/' . trim($uri, '/');
        return $uri;
    }

    private static function getData() {
        $data = [];
        $method = static::getMethod();
        if ($method == 'post') {
            $data = Tools::clean_element($_POST);
        } else if ($method == 'get') {
            $data = Tools::clean_element($_GET);
        }
        return $data;
    }

    private static function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function serve_request($urls) {
        $base_url = static::get_url();
        $data = static::getData();
        foreach ($urls as $url => $func) {
            if (preg_match($url, $base_url)) {
                $func($data);
                break;
            }
        }
    }
}
