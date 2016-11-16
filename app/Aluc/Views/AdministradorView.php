<?php
namespace Aluc\Views;


/**
 * Clase encargada de representar todas
 * las vistas comunes del Administrador.
 */
class AdministradorView  extends View {
    private static $instance = null;

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function home($data = []) {
        $this->setTemplate(
            $data,
            'admin_home.php'
        );
        return $this;
    }
}