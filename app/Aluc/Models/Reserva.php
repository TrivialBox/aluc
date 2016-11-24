<?php
namespace Aluc\Models;
use Aluc\Dao\ReservaDao;
use Sinergi\Token\StringGenerator;

/**
 * Representación de una reserva en el sistema.
 */
class Reserva {
    public $id;
    private $usuario_id;
    public $laboratorio_id;
    public $descripcion;
    public $numero_usuarios;
    public $tipo_uso;
    public $estado;

    private $fecha;
    private $codigo_secreto;

    private $is_save = true;

    private function __construct(
        $usuario_id, $laboratorio_id, Fecha $fecha,
        $descripcion, $numero_usuarios, $tipo_uso,
        $codigo_secreto, $estado = null, $id = null,
        $is_save = true
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

        $this->is_save = $this->is_save && $is_save;
    }

    public static function getNewInstance(
        $usuario_id, $laboratorio_id,
        $fecha_n, $hora_inicio, $hora_fin,
        $descripcion, $numero_usuarios, $tipo_uso
    ) {
        $fecha = new Fecha($fecha_n, $hora_inicio, $hora_fin);

        return new self(
            $usuario_id, $laboratorio_id, $fecha,
            $descripcion,$numero_usuarios,$tipo_uso,
            self::generarCodigoSecreto(), 'reservado'
        );
    }

    public static function getInstance($id){
        return self::getReserva(null, null, $id);
    }

    public static function getReservaUsuario($usuario_id) {
        return self::getReserva($usuario_id);
    }

    public static function getReservaEstado($usuario_id, $estado){
        return self::getReserva($usuario_id, $estado);
    }
    public static function getReservaLaboratorio($laboratorio_id){
        return self::getReserva(null,null,null,$laboratorio_id);
    }

    private static function get_object($array, $get_element = true){
        if ($get_element){
            $fecha = new Fecha(
                $array[0]['fecha'],
                $array[0]['hora_inicio'],
                $array[0]['hora_fin']
            );
            return new Reserva(
                $array[0]['id_usuario'], $array[0]['id_laboratorio'], $fecha,
                $array[0]['descripcion'], $array[0]['n_usuarios'], $array[0]['tipo_uso'],
                $array[0]['codigo_secreto'], $array[0]['estado'],  $array[0]['id'], false
                 );
        }else{
            foreach ($array as $fila){
                $fecha = new Fecha(
                    $fila['fecha'],
                    $fila['hora_inicio'],
                    $fila['hora_fin']
                );
                return new Reserva(
                    $fila['id_usuario'], $fila['id_laboratorio'], $fecha,
                    $fila['descripcion'], $fila['n_usuarios'], $fila['tipo_uso'],
                    $fila['codigo_secreto'], $fila['estado'],  $fila['id'], false
                );
            }
        }
    }

    private static function getReserva($usuario_id, $estado= null, $id=null, $id_lab=null){
        $reservas = ReservaDao::getInstance()->get($usuario_id, $estado, $id, $id_lab);
        if (count($reservas) == 1){
            return Reserva::get_object($reservas);
        }
        return Reserva::get_object($reservas, false);
    }

    private static function generarCodigoSecreto() {
        return StringGenerator::randomAlnum(15);
    }

    public function getCodigoSecreto() {
        return $this->codigo_secreto;
    }

    public function getUsuarioId(){
        return $this->usuario_id;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha, $hora_inicio, $hora_fin) {
        $fecha_c = new Fecha($fecha, $hora_inicio, $hora_fin);
        $this->fecha = $fecha_c;
    }

    public function getLaboratorio() {
        return Laboratorio::getInstance($this->laboratorio_id);
    }

    public function save(){
        $obj = static::get_object(
            ReservaDao::getInstance()->save($this, $this->is_save)
        );
        $this->id = $obj->id;
        $this->usuario_id = $obj->usuario_id;
        $this->laboratorio_id = $obj->laboratorio_id;
        $this->descripcion = $obj->descripcion;
        $this->numero_usuarios = $obj->numero_usuarios;
        $this->tipo_uso = $obj->tipo_uso;
        $this->estado = $obj->estado;
        $this->fecha = $obj->fecha;
        $this->codigo_secreto = $obj->codigo_secreto;
        $this->is_save = false;
        return $this;
    }

    public function getAll($order_atributo){
        return self::get_object(
            ReservaDao::getInstance()->getAll($order_atributo),
            false
        );
    }

    public function updateEstado($estado){
        $this->estado = $estado;
        ReservaDao::getInstance()->updateEstado($this);
    }
}


/***
 * reservado
 * cancelado
 * cancelado_ausencia
 * procesado
 *
 */