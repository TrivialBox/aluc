<?php
namespace Aluc\Models;

/**
 * Representación de una persona en el sistema.
 */
abstract class Persona  {
    public $id;
    public $nombre;
    protected $is_save = true;

    protected function __construct($id, $nombre, $is_save = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->is_save = $this->is_save && $is_save;
    }

}
