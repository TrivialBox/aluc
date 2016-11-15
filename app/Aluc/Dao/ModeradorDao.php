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
            $where = " id = '{$object->id}'";
            return $this->database->update('moderador',$this->convertObjectArray($object), $where);

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
            $order_by =  "order by " . $order_atribute . " asc";
        }
        $list_moderador = $this->database->select("view_moderador", "*", null, $order_by);

        return $list_moderador;
    }

    public function delete($id){
        $where = "id = " . "'" . $id . "'";
        $this->database->delete("moderador", $where);
    }
}
