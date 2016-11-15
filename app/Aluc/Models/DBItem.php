<?php
namespace Aluc\Models;

/**
 * Representación de un item o tabla de la base de datos.
 */
interface DBItem {
    public function save();
    public function delete();
}

