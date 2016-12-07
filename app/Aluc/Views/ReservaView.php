<?php
namespace Aluc\Views;

use Aluc\Common\Tools;
use Aluc\Models\Laboratorio;
use Aluc\Models\Moderador;
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
        $reservas = Reserva::getReservas($_SESSION['id'], 'reservado');
        $data['reservas'] = $reservas;
        $data['laboratorios'] = Laboratorio::getAll();
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
        $reserva = Reserva::getInstance($id);
        return $this->listAll([
            'reservas' => [$reserva]
        ]);
    }

    public function listReservasUsuario($user_id, $type = 'all') {
        if ($type === 'all') {
            return $this->listAll([
                'reservas' => Reserva::getReservaUsuario($user_id)
            ]);
        } else if ($type === 'new') {
            return $this->listAll([
                'reservas' => Reserva::getReservas($user_id, 'reservado')
            ]);
        } else if ($type === 'old') {
            return $this->listAll([
                'reservas' => Reserva::getReservaPasadas($user_id)
            ]);
        }
    }

    public function listReservasLaboratorio($laboratorio_id) {
        return $this->listAll([
            'reservas' => Reserva::getReservaLaboratorio($laboratorio_id),
            'row_h' => '4'
        ]);
    }

    public function listReservasLaboratorioCompact($laboratorio_id) {
        $this->setTemplate([
                'reservas_pasadas' => Reserva::getReservaPasadas(null, $laboratorio_id),
                'reservas_nuevas' => Reserva::getReservaLaboratorio($laboratorio_id, 'reservado')
            ],
            'escritorio/reservas-tabs.php'
        );
        return $this;
    }

    public function codigo_qr($reserva) {
        $this->setTemplate(
            ['reserva' => $reserva],
            'reservas/codigo-qr.php'
        );
        return $this;
    }

    public function homeModerador($id) {
        if (Tools::check_session('admin')) {
            $laboratorios = Laboratorio::getAll();
        } else {
            $laboratorios = [Moderador::getInstance($id)->getLaboratorio()];
        }
        $this->setTemplate(
            ['laboratorios' => $laboratorios],
            'escritorio/reservas.php'
        );
        return $this;
    }
}
