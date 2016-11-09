<?php
namespace Aluc\Service;

/**
 *
 */
class Moderador extends Usuario {
    public static function getNewInstace($id, $nombre) {
        return parent::getNewInstace($id, $nombre);
    }

    public static function getInstance($id) {
        die('FALTA');
    }


    public function getAllLaboratorios() {
        die("FALTA HACER!");
    }
}
