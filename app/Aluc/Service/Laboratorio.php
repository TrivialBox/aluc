<?php
namespace Aluc\Service;

class Laboratorio {
    public $id;
    public $capacidad;
    public $descripcion;
    public $horario;

    function __construct($id) {
        $this->id = $id;
    }
}