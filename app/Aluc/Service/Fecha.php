<?php
namespace Aluc\Service;

/**
 * Fecha de una reserva.
 */
class Fecha {
    public $fecha;
    public $hora_inicio;
    public $hora_fin;

    public function __construct($fecha, $hora_inicio, $hora_fin) {
        $this->fecha = $fecha;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
    }
}
