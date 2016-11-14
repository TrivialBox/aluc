<?php
namespace Aluc\Views;

use Aluc\Service\Lector;

class LectorQrView extends View {
    private static $instance = null;

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function listAll() {
        $lectores = Lector::getAll();
        $this->setTemplate([
                'lectores' => $lectores
            ],
            'lectores.php'
        );
        return $this;
    }
}
