<?php

namespace Aluc\Models;

use Aluc\Dao\ModeradorDao;
use Aluc\Models\Laboratorio;

/**
 * Usuario que asegura el correcto uso de las reservas.
 */
class Moderador extends Persona {
    public $id_laboratorio;

    protected function __construct($id, $id_laboratorio, $nombre = null, $is_save = true) {
        parent::__construct($id, $nombre, $is_save);
        $this->id_laboratorio = $id_laboratorio;
    }


    public static function getNewInstace($id, $id_laboratorio) {
        return new self($id, $id_laboratorio);
    }

    public static function get_object($array, $get_element = true){
        if ($get_element){
            return new Moderador($array[0]["id"], $array[0]['id_laboratorio'], $array[0]['nombre'], false);

        }else {
            $moderadores = array();
            foreach ($array as $fila){
                array_push($moderadores,new Moderador($fila['id'], $fila['id_laboratorio'], $fila['nombre'], false));
            }
            return $moderadores;
        }
    }

    public static function getInstance($id) {
        return Moderador::get_object(ModeradorDao::getInstance()->get($id));
    }

    public function getLaboratorio() {
        return Laboratorio::getInstance($this->id_laboratorio);
    }

    public static function getAll($order_atribute = null) {
        return Moderador::get_object(
            ModeradorDao::getInstance()->getAll($order_atribute),
            false
        );
    }

    public function save() {
        $obj = static::get_object(
            ModeradorDao::getInstance()->save($this, $this->is_save)
        );
        $this->id = $obj->id;
        $this->id_laboratorio = $obj->id_laboratorio;
        $this->nombre = $obj->nombre;
        $this->is_save = false;
        return $this;
    }

    public function delete(){
        ModeradorDao::getInstance()->delete($this->id);
    }
}
