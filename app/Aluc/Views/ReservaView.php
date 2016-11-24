<?php
namespace Aluc\Views;

use Aluc\Models\Reserva;


class ReservaView extends View {
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
            'reservas/reservas.php'
        );
        return $this;
    }

    public function listAll($data) {
        $this->setTemplate(
            $data,
            'reservas/reservas-list.php'
        );
        return $this;
    }

    public function listReserva($id) {
        return $this->listAll([
            'reserva' => Reserva::getInstance($id)
        ]);
    }

    public function listReservasUsuario($user_id) {
        return $this->listAll([
            'reservas' => Reserva::getReservaUsuario($user_id)
        ]);
    }
}
