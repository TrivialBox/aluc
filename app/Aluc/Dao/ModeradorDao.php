<?php
namespace Aluc\Dao;



class ModeradorDao {
    private $database;
    private static $instance = null;

    private function __construct() {
        $this->database = new Database();
        $this->database->connect();
    }
    function __destruct(){
        $this->database->disconnect();
    }

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new self();
        }
        return static::$instance;
    }
    private function convertObjectArray($object){
        $array = [
            'id' => $object->id,
            'id_laboratorio' => $object->id_laboratorio
        ];

        return $array;
    }
    public function save($object, $type_save = true){
        if ($type_save){
            return $this->database->insert("moderador", $this->convertObjectArray($object));
        } else {
            return $this->database->update('moderador',$this->convertObjectArray($object),$object->id);

        }

    }

    public function get($id){
        $where = "id = " . "'" . $id . "'";
        $moderador = $this->database->select("view_moderador", "*", $where, null);
        return $moderador;
    }

    public function getAll($order_atribute){
        $order_by = null;

        if ($order_atribute != null){
            $order_by = $order_atribute . " asc";
        }
        /* si se usa una vista especificar el nombre el el primer parametro del metodo select
        *  de igual manera si es una tabla solo poner el nombre de la tabla
        */
        $list_moderador = $this->database->select("view_moderador", "*", null, $order_by);

        return $list_moderador;

    }
}
