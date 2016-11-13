<?php
namespace Aluc\Tools;

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

    public static function serve_request($urls) {
        $base_url = static::get_url();
        foreach ($urls as $url => $func) {
            if (preg_match($url, $base_url)) {
                $func();
                break;
            }
        }
    }
}
