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
        $data['laboratorios'] = Laboratorio::getAll();
        $this->setTemplate(
            $data,
            'moderadores/moderadores.php'
        );
        return $this;
    }


    /**
     * Lista todos los moderadores que
     * coincidan con los criterios de
     * búsqueda en forma de columnas html.
     * @param $filters
     * @return $this
     */
    public function getList($filters) {
        $moderadores = [];
        if (array_key_exists('id', $filters)) {
            $moderadores[] = Moderador::getInstance($filters['id']);
        }
        $this->setTemplate([
                'moderadores' => $moderadores
            ],
            'moderadores/moderadores-list.php'
        );
        return $this;
    }

    public function json(Moderador $obj) {
        $lab = $obj->getLaboratorio();
        $this->setTemplate([
                'id' => $obj->id,
                'nombre' => $obj->nombre,
                'laboratorio' => [
                    'id' => $lab->id,
                    'nombre' => $lab->nombre
                ]
            ],
            'json/json.php'
        );
        return $this;
    }
}
