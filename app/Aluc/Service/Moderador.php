<?php

namespace Aluc\Service;

use Aluc\Dao\ModeradorDao;

/**
 * Usuario que asegura el correcto uso de las reservas.
 */
class Moderador extends Persona {
    public $laboratorio_id;

    protected function __construct($id, $nombre, $laboratorio_id) {
        parent::__construct($id, $nombre);
        $this->laboratorio_id = $laboratorio_id;
    }


    public static function getNewInstace($id, $nombre, $laboratorio_id) {
        return new self($id, $nombre, $laboratorio_id);
    }

    private static function get_object($array, $get_element = true){
        if ($get_element){
            //return new Moderador($array[0]["id"],$array[0]['nombre'], $array[0]['id_laboratorio']);
            return new Moderador($array[0]["id"],"Priscila Cedillo", "3883");
        }else {
            $moderadores = array();
            foreach ($array as $fila){
                array_push($moderadores,new Moderador($fila['id'], $fila['nombre'], $fila['id_laboratorio']));
            }
            return $moderadores;
        }
    }

    public static function getInstance($id) {

        return Moderador::get_object(ModeradorDao::getInstance()->get($id));
    }

    public function getLaboratorio() {
    }
    public static function getAll($order_atribute = null) {
        return Moderador::get_object(ModeradorDao::getInstance()->getAll($order_atribute), false);
    }

}
