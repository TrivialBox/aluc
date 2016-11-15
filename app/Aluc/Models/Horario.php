<?php
namespace Aluc\Models;

/**
 * Horario dividido en dos jornadas.
 */
class Horario {
    public $jornada1;
    public $jornada2;

    public function __construct(Fecha $jornada1, Fecha $jornada2) {
        $this->jornada_1 = $jornada1;
        $this->jornada_2 = $jornada2;
    }
}
