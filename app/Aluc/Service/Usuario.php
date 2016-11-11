<?php
namespace Aluc\Service;

/**
 * Usuario que puede hacer reservas en el sistema.
 */
class Usuario extends Persona {
    protected function __construct($id, $nombre) {
        parent::__construct($id, $nombre);
    }

    public static function getInstance($id) {
    }
}
