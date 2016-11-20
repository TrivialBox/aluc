<?php
namespace Aluc\Dao;


use Aluc\Common\AlucException;
use Aluc\Common\AlucRowException;
use Herrera\Json\Exception\Exception;

class ModeradorDao {
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
            'id' => $object->id,
            'id_laboratorio' => $object->id_laboratorio
        ];

        return $array;
    }

    public function save($object, $type_save = true){
        if ($type_save){
            try{
                $this->database->insert("moderador", $this->convertObjectArray($object));
            }catch (\Exception $e){
                throw new AlucException(Database::getMgs($e->getCode(),$this->getModel()),$e->getMessage());
            }
        } else {
            try {
                $where = " id = '{$object->id}'";
                $this->database->update('moderador', $this->convertObjectArray($object), $where);
            } catch (\Exception $e) {
                throw new AlucException(Database::getMgs($e->getCode(),$this->getModel()), $e->getMessage());
            }
        }
        return $this->get($object->id);
    }

    public function get($id){

        $where = "id = " . "'" . $id . "'";
        $moderador = $this->database->select("view_moderador", "*", $where, null);
        if (count($moderador) === 0){
            throw new AlucException(
                Database::getMgs(5000,$this->getModel()),
                "elemento no existe en la base de datos"
            );
        }
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
        try{
            $this->database->delete("moderador", $where);
        }catch (\Exception $e){
            throw new AlucException('El moderador no se puede eliminar', $e->getMessage());
        }

    }

    private function getModel(){
        return [
            'clave_foranea' => ['usuario o moderador','registrado'],
            'clave_pk_duplicate' => ['moderador'],
            'elemento_null' => ['moderador','registrado']

        ];
    }
}
