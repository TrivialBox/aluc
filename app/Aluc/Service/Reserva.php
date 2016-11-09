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

    private function __construct(
        $usuario_id, $laboratorio_id, $fecha, $usuario_id,
        $descripcion, $numero_usuarios, $tipo_uso, $estado
    ) {
        $this->usuario_id = $usuario_id;
        $this->laboratorio_id = $laboratorio_id;
        $this->fecha = $fecha;
    }

    public static function getNewInstance(
        $usuario_id, $laboratorio_id, $fecha, $usuario_id,
        $descripcion, $numero_usuarios, $tipo_uso, $estado
    ) {
        return new self(
            $usuario_id, $laboratorio_id, $fecha, $usuario_id,
            $descripcion, $numero_usuarios, $tipo_uso, $estado
        );
    }

    public static function getInstance($id) {
        die('FALTA');
    }

    private function generarCodigoSecreto() {
        die('FALTA IMPLEMENTAR');
    }

    public function getCodigoSecreto() {
        return $this->codigo_secreto;
    }
}
