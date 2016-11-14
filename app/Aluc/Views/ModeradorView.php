<?php
namespace Aluc\Views;

use Aluc\Service\Laboratorio;
use Aluc\Service\Moderador;

/**
 * Clase encargada de representar todos los objetos
 * relacionados a la clase Moderador.
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
     */
    public function listAll() {
        $moderadores = Moderador::getAll();
        $this->setTemplate([
                'moderadores' => $moderadores
            ],
            'moderadores.php'
        );
        return $this;
    }
}
