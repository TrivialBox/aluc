<?php
namespace Aluc\Service;

define('TEMPLATES_PATH', __DIR__ . '/../../../resources/templates');

class TemplateGenerator {
    public static function generate(array $values, $template_name) {
        extract($values);
        include TEMPLATES_PATH . "/$template_name";
    }
}

