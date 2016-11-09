<?php
namespace Aluc\Service;

/**
 *
 */
class Moderador extends Usuario {

    function __construct($id, $nombre) {
        parent::__construct($id, $nombre);
    }

    public function getAllLaboratorios() {
        die("FALTA HACER!");
    }
}
