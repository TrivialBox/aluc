<?php
namespace Aluc\Service;

/**
 *
 */
class Persona {
    public $id;
    public $nombre;

    function __construct($id) {
        $this->id = $id;
    }
}