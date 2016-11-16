<?php
namespace Aluc\Views;

use Aluc\Models\Laboratorio;
use Aluc\Models\Moderador;

/**
 * Clase encargada de representar todos los objetos
 * relacionados con la clase Moderador.
 */
class ModeradorView extends View {
    private static $instance = null;

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Lista de todos los moderadores de todos los laboratorios.
     * Además se puede agregar un nuevo moderador a un laboratorio
     * existente.
     * @param array $data
     * @return $this
     */
    public function listAll($data = []) {
        $data['moderadores'] = Moderador::getAll();
        $this->setTemplate(
            $data,
            'moderadores.php'
        );
        return $this;
    }
}
