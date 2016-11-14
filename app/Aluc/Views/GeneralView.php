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
        $this->template = '404.php';
        return $this;
    }

    public function error403() {
        $this->template = '403.php';
        return $this;
    }
}
