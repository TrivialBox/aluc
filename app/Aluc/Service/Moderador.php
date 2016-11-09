<?php
namespace Aluc\Service;

/**
 * Usuario que asegura el correcto uso de las reservas.
 */
class Moderador extends Persona {
    public $laboratorio_id;

    protected function __construct($id, $nombre, $laboratorio_id) {
        parent::__construct($id, $nombre);
        $this->laboratorio_id = $laboratorio_id;
    }

    public static function getNewInstace($id, $nombre, $laboratorio_id) {
        return new self($id, $nombre, $laboratorio_id);
    }

    public static function getInstance($id) {
    }

    public function getLaboratorio() {
    }
}
