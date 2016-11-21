<?php
namespace Aluc\Common;

define('TEMPLATES_PATH', __DIR__ . '/../../../resources/templates');


/**
 * Clase que genera documentos a partir de un template
 * y valores dados en forma de array asociativo.
 *
 * Los templates deben estar ubicados en /resources/templates/.
 */
class TemplateGenerator {
    public static function generate($data, $template_name) {
        $show = function ($key) use ($data){
            if (array_key_exists($key, $data)) {
                echo $data[$key];
            }
        };
        $get = function ($key) use ($data) {
            if (array_key_exists($key, $data)) {
                return $data[$key];
            } else {
                return false;
            }
        };
        $set = function ($key, $value) use ($data) {
            $data[$key] = $value;
        };
        include TEMPLATES_PATH . "/{$template_name}";
    }
}

