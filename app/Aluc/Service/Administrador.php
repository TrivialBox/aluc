<?php
namespace Aluc\Service;

/**
 *
 */
class Administrador extends Moderador {
    public static function getNewInstace($id, $nombre) {
        return parent::getNewInstace($id, $nombre);
    }

    public static function getInstance($id) {
        die('FALTA');
    }
}
