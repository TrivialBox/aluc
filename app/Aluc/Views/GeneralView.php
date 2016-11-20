<?php
namespace Aluc\Views;
use Aluc\Common\AlucException;

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

    public function error404($data = []) {
        $this->setTemplate(
            $data,
            '404.php'
        );
        return $this;
    }

    public function error403($data = []) {
        $this->setTemplate(
            $data,
            '403.php'
        );
        return $this;
    }

    public function success_json($msj = "") {
        $this->setTemplate(
            [
                'status' => 'success',
                'description' => $msj
            ],
            'json/json.php'
        );
        return $this;
    }

    public function error_json($description) {
        $this->setTemplate(
            [
                'status' => 'error',
                'description' => $description
            ],
            'json/json.php'
        );
        return $this;
    }

    public function error_json_default($e) {
        $msg = $e instanceof AlucException ? $e->short_message : 'Ups, algo salió mal' . $e->getMessage();
        return $this->error_json($msg);
    }
}
