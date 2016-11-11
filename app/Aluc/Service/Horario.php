<?php
namespace Aluc\Service;

/**
 * Horario dividido en dos jornadas.
 */
class Horario {
    public $jornada_1;
    public $jornada_2;

    public function __construct($jornada_1, $jornada_2) {
        $this->jornada_1 = $jornada_1;
        $this->jornada_2 = $jornada_2;
    }
}
