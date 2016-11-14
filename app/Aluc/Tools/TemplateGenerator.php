<?php
namespace Aluc\Tools;

define('TEMPLATES_PATH', __DIR__ . '/../../../resources/templates');


/**
 * Clase que genera documentos a partir de un template
 * y valores dados en forma de array asociativo.
 *
 * Los templates deben estar ubicados en /resources/templates/.
 */
class TemplateGenerator {
    public static function generate($values, $template_name) {
        if (is_array($values)) {
            extract($values);
        }
        include TEMPLATES_PATH . "/{$template_name}";
    }
}

