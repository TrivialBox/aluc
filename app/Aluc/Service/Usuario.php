<?php
namespace Aluc\Service;

/**
 *
 */
class Usuario extends Persona {
    public static function getNewInstace($id, $nombre) {
        return parent::getNewInstace($id, $nombre);
    }

    public static function getInstance($id) {
    }
}
