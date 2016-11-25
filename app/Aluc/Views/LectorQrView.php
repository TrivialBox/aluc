<?php
namespace Aluc\Views;

use Aluc\Models\Laboratorio;
use Aluc\Models\LectorQr;

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
        $data['lectores_qr'] = LectorQr::getAll();
        $data['laboratorios'] = Laboratorio::getAll();
        $this->setTemplate(
            $data,
            'lectores-qr/lectores-qr.php'
        );
        return $this;
    }

    /**
     * Lista todos los lectores QR que
     * coincidan con los criterios de
     * búsqueda en forma de columnas html.
     * @param $filters
     * @return $this
     */
    public function getList($filters) {
        $lectores_qr = [];
        if (array_key_exists('mac', $filters)) {
            $lectores_qr[] = LectorQr::getInstance($filters['mac']);
        }
        $this->setTemplate([
                'lectores_qr' => $lectores_qr
            ],
            'lectores-qr/lectores-qr-list.php'
        );
        return $this;
    }
}
