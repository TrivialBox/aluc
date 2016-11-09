<?php
namespace Aluc\Service;

/**
 *
 */
class Usuario extends Persona {
    protected function __construct($id, $nombre)
    {
        parent::__construct($id, $nombre);
    }

    public static function getNewInstace($id, $nombre) {
    }

    public static function getInstance($id) {
    }
}
