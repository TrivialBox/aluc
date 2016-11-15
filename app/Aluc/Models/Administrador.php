<?php
namespace Aluc\Models;

/**
 * Usuario que puede crear nuevos moderadores en el sistema.
 */
class Administrador extends Persona {
    protected function __construct($id, $nombre) {
        parent::__construct($id, $nombre);
    }

    public static function getInstance($id) {
    }
}
