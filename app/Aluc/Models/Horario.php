<?php
namespace Aluc\Models;

/**
 * Horario dividido en dos jornadas.
 * joranda1 y jornada2 son reutilizados
 * de la clase Fecha, pero sin usar su
 * atributo fecha.
 */
class Horario {
    public $jornada1;
    public $jornada2;

    public function __construct(Fecha $jornada1, Fecha $jornada2) {
        $this->jornada1 = $jornada1;
        $this->jornada2 = $jornada2;
    }
}
