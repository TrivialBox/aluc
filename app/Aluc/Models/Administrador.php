<?php
namespace Aluc\Models;
use Aluc\Dao\AdministradorDao;

/**
 * Usuario que puede crear nuevos moderadores en el sistema.
 */
class Administrador extends Persona {
    protected function __construct($id, $nombre) {
        parent::__construct($id, $nombre);
    }

    /**
     * Metodo para obtener el objeto Administrador del array devuelto de la
     * base de datos.
     * @param $array
     * @param bool $get_element
     * @return Administrador|array
     */
    public static function get_object($array, $get_element = true){
        if ($get_element){
            return new Administrador($array[0]["id"], $array[0]['nombre']);

        }else {
            $admins = array();
            foreach ($array as $fila){
                array_push($admins,new Administrador($fila['id'], $fila['nombre']));
            }
            return $admins;
        }
    }

    /**
     * Metodo para obtener un administrador de la base de datos.
     * @param $id
     * @return Administrador|array
     */
    public static function getInstance($id) {
        return Administrador::get_object(AdministradorDao::getInstance()->get($id));
    }

    /**
     * Metodo para obtener una lista de todos los administradores.
     * @param null $order_attribute
     * @return Administrador|array
     */
    public static function getAll($order_attribute = null){
        return Administrador::get_object(AdministradorDao::getInstance()->getAll($order_attribute), false);
    }
}
