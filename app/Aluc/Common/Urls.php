<?php
namespace Aluc\Common;


/**
 * Clase encargada de realizar URL routing
 * usando expresiones regulares.
 */
class Urls {
    private static function getUri() {
        // Copy & paste, no tocar!
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }
        $uri = trim($uri, '/');
        $uri .= empty($uri) ? '' : '/';
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

    private static function matchRequest($base_url, $urls, $data) {
        foreach ($urls as $url => $func) {
            if (preg_match($url, $base_url)) {
                if (is_array($func)) {
                    $new_base_url = preg_replace($url, '', $base_url);
                    if (self::matchRequest($new_base_url, $func, $data)) {
                        return true;
                    }
                } else {
                    $func($data);
                    return true;
                }
            }
        }
        return false;
    }

    public static function serveRequest($urls) {
        $base_url = static::getUri();
        $data = static::getData();
        self::matchRequest($base_url, $urls, $data);
    }

    public static function redirect($url) {
        header('Location: ' . $url, true, 303);
    }
}
