<?php
namespace Aluc\Service;

/**
 *
 */
class Persona {
    public $id;
    public $nombre;

    protected function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public static function getNewInstace($id, $nombre) {
        return new self($id, $nombre);
    }

    public static function getInstance($id) {
        die('IMPLEMENTAR');
    }
}
