<?php
namespace Aluc\Service;

/**
 * Representación de una persona en el sistema.
 */
abstract class Persona implements DBItem {
    public $id;
    public $nombre;

    protected function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
}
