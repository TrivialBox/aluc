<?php
namespace Aluc\Views;

use Aluc\Common\TemplateGenerator;


/**
 * Clase base de una Vista.
 * Maneja como se debe presentar la información al usuario.
 */
abstract class View {
    private $data;
    private $template;

    protected function __construct() {

    }

    public function render() {
        TemplateGenerator::generate($this->data, $this->template);
        return $this;
    }

    protected function setTemplate($data, $template) {
        $this->data = $data;
        $this->template = $template;
    }
}
