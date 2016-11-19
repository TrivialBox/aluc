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
            echo $data[$key];
        };
        $get = function ($key) use ($data) {
            return $data[$key];
        };
        include TEMPLATES_PATH . "/{$template_name}";
    }
}

