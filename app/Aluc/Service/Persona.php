<?php
namespace Aluc\Service;

/**
 *
 */
abstract class Persona {
    public $id;
    public $nombre;

    protected function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
}
