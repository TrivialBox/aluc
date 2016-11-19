<?php

namespace ALUC\Dao;


class LectorQrDao {

    private $database;
    private static $instance = null;

    private function __construct(){
        $this->database = new Database();
        $this->database = $this->database->connect();
    }

    public static function getInstance(){
        if(static::$instance == null){
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
            $this->database->insert('lector', $this->convertObjectArray($object));
        } else {
            $where = " mac = '{$object->mac}'";
            $this->database->update('lector', $this->convertObjectArray($object), $where);
        }
        return $this->get($object->mac);
    }

    public function get($mac){
        $where = "mac = '{$mac}'";
        $lectorQr = $this->database->select("lector", "*", $where, null);
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
        $this->database->delete("lector", $where);
    }
}

