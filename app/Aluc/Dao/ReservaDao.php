<?php

namespace Aluc\Dao;


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
            'id_usuario' => $object->usuario_id,
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
    public function save($object, $type_save = true){
        if ($type_save){
            $this->database->call('insertar_reserva',$this->convertObjectArray($object));
            echo "hola mundo";
        }else{
            $where = " id = '{$object->usuario_id}'";
            // todo falta implementar un prodedimiento para actualizar una reserva
        }
    }
    public function get($usuario_id){
        
    }
    public function getAll($order_atribute){
        
    }
    public function delete($usuario_id){
        
    }

    private function getModel(){
        return [
            'clave_foranea' => ['usuario o moderador','registrado'],
            'clave_pk_duplicate' => ['moderador'],
            'elemento_null' => ['moderador','registrado']
        ];
    }
    

}