<?php

namespace Aluc\Dao;


use Aluc\Common\AlucException;

class LectorQrDao {

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
            'mac' => $object->mac,
            'ip' => $object->ip,
            'id_laboratorio' => $object->id_laboratorio,
            'token' => $object->getToken()
        ];

        return $array;
    }

    public function save($object, $type_save = true) {
        if ($type_save) {

            try{
                $this->database->insert('lector', $this->convertObjectArray($object));

            }catch (\Exception $e){

                throw new AlucException(Database::getMgs($e->getCode(),$this->getModel()),$e->getMessage());
            }

        } else {
            try{
                $where = " mac = '{$object->mac}'";
                $this->database->update('lector', $this->convertObjectArray($object), $where);
            }catch (\Exception $e){
                throw new AlucException(Database::getMgs($e->getCode(),$this->getModel()),$e->getMessage());
            }

        }
        return $this->get($object->mac);
    }

    public function get($mac){
        $where = "mac = '{$mac}'";
        $lectorQr = $this->database->select("lector", "*", $where, null);
        if (count($lectorQr) === 0){
            throw new AlucException(
                Database::getMgs(5000,$this->getModel()),
                "elemento no existe en la base de datos"
            );
        }
        return $lectorQr;
    }

    public function getAll($order_atribute){
        $order_by = null;
        if ($order_atribute != null){
            $order_by =  "order by " . $order_atribute . " asc";
        }
        $list_lectorQr = $this->database->select("lector", "*", null, $order_by);

        return $list_lectorQr;
    }

    public function delete($mac){
        $where = "mac = " . "'" . $mac . "'";
        try{
            $this->database->delete("lector", $where);

        }catch (\Exception $e){
            throw new AlucException('El Lector no se puede eliminar', $e->getMessage());
        }
    }

    private function getModel(){
        return [
            'clave_foranea' => ['Lababoratorio','registrado'],
            'clave_pk_duplicate' => ['Lector'],
            'elemento_null' => ['Lector','registrado']

        ];
    }
}

