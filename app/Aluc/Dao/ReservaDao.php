<?php

namespace Aluc\Dao;


use Aluc\Common\AlucException;

class ReservaDao{
    private $database;
    private static $instance = null;


    private function __construct() {
        $this->database = new Database();
        $this->database->connect();
    }

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new self();
        }
        return static::$instance;
    }


    private function convertObjectArray($object){
        $array = [
            'id_usuario' => $object->getUsuarioId(),
            'id_laboratorio' => $object->laboratorio_id,
            'descripcion' => $object->descripcion,
            'n_usuarios' => $object->numero_usuarios,
            'tipo_uso' => $object->tipo_uso,
            'estado' => $object->estado,
            'fecha' => $object->getFecha()->fecha,
            'hora_inicio' => $object->getFecha()->hora_inicio,
            'hora_fin' => $object->getFecha()->hora_fin,
            'codigo_secreto' => $object->getCodigoSecreto()
        ];
        return $array;
    }

    private function convertEditarReserva($object){
        $array = [
            'id' => $object->getId(),
            'id_laboratorio' => $object->laboratorio_id,
            'descripcion' => $object->descripcion,
            'n_usuarios' => $object->numero_usuarios,
            'tipo_uso' => $object->tipo_uso,
            'fecha' => $object->getFecha()->fecha,
            'hora_inicio' => $object->getFecha()->hora_inicio,
            'hora_fin' => $object->getFecha()->hora_fin,
        ];
        return $array;
    }
    public function save($object, $type_save = true){
        try{
            if ($type_save){
                $this->database->call('insertar_reserva',$this->convertObjectArray($object));

            }else{
                $this->database->call('editar_reserva', $this->convertEditarReserva($object));

            }
        }catch (\Exception $e){
            $error = $e->getMessage();

            if(strval(intval($error))!==$error){

                throw new AlucException(Database::getMgs(
                    $e->getCode(),$this->getModel()),
                    $e->getMessage()
                );
            }
            throw new AlucException($this->getMsgInsert(
                (int)$e->getMessage()),
                $e->getMessage()
            );
        }
    }

    public function get($usuario_id = null, $estado = null, $id = null){
        $where = "";

        if ($usuario_id != null){
            $where = "id_usuario = '{$usuario_id}'";
        }

        if ($estado != null){
            $where .= " and estado = '{$estado}'";
        }

        if ($id != null){
            $where .= "id = '{$id}'";
        }
        $reservas = $this->database->select('view_reserva','*', $where, 'fecha asc');

        if (count($reservas) === 0){
            throw new AlucException(
                'No se ha encontrado reservas',
                'No se enontrado reservas'
            );
        }
        return $reservas;
    }

    public function getAll($order_atribute){
        $order_by = null;

        if ($order_atribute != null){
            $order_by =  "order by " . $order_atribute . " asc";
        }
        $list_reservas = $this->database->select("view_reserva", "*", null, $order_by);

        return $list_reservas;
    }

    public function cancelarReserva($id,$token,$estado){
        //todo Franklin cara de la viejita de santos no acaba con esto.
    }
    private function getModel(){
        return [
            'clave_foranea' => ['Usuario o laboratorio','registrado'],
            'clave_pk_duplicate' => ['Usuario'],
            'elemento_null' => ['Usuario','registrado']

        ];
    }

    private function getMsgInsert($code) {
        switch ($code) {
            case 1452:
                return "El laboratorio no se encuentra registrado";
            case 50000:
                return "La hora que quiere realizar su reserva el laboratorio se encuentra en horario de clases";
            case 60000:
                return "La hora que quiere realizar su reserva el laboratorio no se encuentra disponible";
            case 70000:
                return "Ha accedido a su maximo de reserva diaria (2 horas diarias)";
            case 80000:
                return "Ha excedido la capacidad del laboratorio";
            case 90000:
                return "Solo se pueden hacer reservas en un rango de 5 dias maximo";
            case 100000:
                return "No se puede realizar su actualización antes de hora";
            case 110000:
                return "Su reserva ya esta cancelada";
            default:
                return "Ha ocurrido un error al momento de su petición";
        }
    }

    

}