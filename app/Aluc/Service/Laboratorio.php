<?php
namespace Aluc\Service;

/**
 * Representación de un laboratorio, el cual debe estar coordinado
 * por al menos un moderador.
 */
class Laboratorio {
    public $id;
    public $nombre;
    public $capacidad;
    public $descripcion;
    public $horario;

    private $moderadores;

    private function __construct(
        $id, $nombre, $capacidad, $descripcion, $horario,
        array $moderadores
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->capacidad = $capacidad;
        $this->descripcion = $descripcion;
        $this->horario = $horario;
        $this->moderadores = $moderadores;
    }

    public static function getInstance($id) {

    }

    public function getModeradores() {

    }

    public function addModerador($id) {

    }

    public function delModerador($id) {

    }
}
