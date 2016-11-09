<?php
namespace Aluc\Service;

class Laboratorio {
    public $id;
    public $capacidad;
    public $descripcion;
    public $horario;

    private function __construct($id, $capacidad, $descripcion, Horario $horario) {
        $this->id = $id;
        $this->capacidad = $capacidad;
        $this->descripcion = $descripcion;
        $this->horario = $horario;
    }

    public static function getInstance($id) {

    }
}