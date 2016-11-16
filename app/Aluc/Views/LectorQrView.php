<?php
namespace Aluc\Views;

use Aluc\Models\Lector;

/**
 * Clase encargada de representar todos los objetos
 * relacionados con la clase LectorQr.
 */
class LectorQrView extends View {
    private static $instance = null;

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function listAll($data = []) {
        $data['lectores'] = Lector::getAll();
        $this->setTemplate(
            $data,
            'lectores.php'
        );
        return $this;
    }
}
