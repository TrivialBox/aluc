<?php
namespace Aluc\Views;

/**
 * Clase encargada de representar todas las vistas
 * comunes del sistema.
 */
class GeneralView extends View {
    private static $instance = null;

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function error404() {
        $this->setTemplate(
            null,
            '404.php'
        );
        return $this;
    }

    public function error403() {
        $this->setTemplate(
            null,
            '403.php'
        );
        return $this;
    }
}
