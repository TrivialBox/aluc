<?php
namespace Aluc\Tools;

define('TEMPLATES_PATH', __DIR__ . '/../../../resources/templates');

class TemplateGenerator {
    public static function generate($values, $template_name) {
        if (is_array($values)) {
            extract($values);
        }
        include TEMPLATES_PATH . "/{$template_name}";
    }
}

