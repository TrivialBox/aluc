<?php
namespace Aluc\Service;

/**
 *
 */
class Reserva {
    public $id;
    public $usuario_id;
    public $descripcion;
    public $numero_usuarios;
    public $tipo_uso;
    public $estado;
    public $laboratorio_id;
    private $fecha;

    private $codigo_secreto;

    function __construct($usuario_id, $laboratorio_id, $fecha) {
    }

    private function generarCodigoSecreto() {
        die('FALTA IMPLEMENTAR');
    }

    public function getCodigoSecreto() {
        return $this->codigo_secreto;
    }
}
