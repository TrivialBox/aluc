<?php
namespace Aluc\Views;

class AdministradorView  extends View {
    private static $instance = null;

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function home() {
        $this->setTemplate(
            null,
            'admin_home.php'
        );
        return $this;
    }
}