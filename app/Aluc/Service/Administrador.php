<?php
namespace Aluc\Service;

/**
 *
 */
class Administrador extends Moderador {
    function __construct($id, $nombre) {
        parent::__construct($id, $nombre);
    }
}
