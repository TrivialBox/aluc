<?php
namespace Aluc\Service;

/**
 * Usuario que puede crear nuevos moderadores en el sistema.
 */
class Administrador extends Persona {
    protected function __construct($id, $nombre) {
        parent::__construct($id, $nombre);
    }

    public static function getInstance($id) {
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
