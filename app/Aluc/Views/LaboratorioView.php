<?php
namespace Aluc\Views;

use Aluc\Models\Laboratorio;

class LaboratorioView extends View {
    private static $instance = null;

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function show($id_lab) {
        $this->setTemplate([
                'laboratorio' => Laboratorio::getInstance($id_lab)
            ],
            'laboratorios/laboratorio.php'
        );
        return $this;
    }

}
