<?php
namespace Aluc\Models;

/**
 * Representación de una reserva en el sistema.
 */
class Reserva {
    public $id;
    public $usuario_id;
    public $laboratorio_id;
    public $descripcion;
    public $numero_usuarios;
    public $tipo_uso;
    public $estado;

    private $fecha;
    private $codigo_secreto;

    private function __construct(
        $id, $usuario_id, $laboratorio_id, $fecha,
        $descripcion, $numero_usuarios, $tipo_uso,
        $estado, $codigo_secreto
    ) {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->laboratorio_id = $laboratorio_id;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->numero_usuarios = $numero_usuarios;
        $this->tipo_uso = $tipo_uso;
        $this->estado = $estado;
        $this->codigo_secreto = $codigo_secreto;
    }

    public static function getNewInstance(
        $usuario_id, $laboratorio_id, Fecha $fecha,
        $descripcion, $numero_usuarios, $tipo_uso
    ) {
    }

    public static function getInstance($id) {
    }

    private function generarCodigoSecreto() {
    }

    public function getCodigoSecreto() {
        return $this->codigo_secreto;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha(Fecha $nueva_fecha) {
    }

    private function fechaValida(Fecha $fecha) {

    }
}
