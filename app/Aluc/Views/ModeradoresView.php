<?php
namespace Aluc\Views;


use Aluc\Service\Laboratorio;
use Aluc\Service\Moderador;
use Aluc\Tools\TemplateGenerator;

class ModeradoresView {
    private $data;
    private $template;
    private static $instance = null;

    protected function __construct() {

    }

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function render() {
        TemplateGenerator::generate($this->data, $this->template);
    }

    public function listAll() {
        $moderadores = Moderador::getAll();
        $this->data = array(
            'moderadores' => $moderadores
        );
        $this->template = 'moderadores.php';
        return $this;
    }
}
