<?php
namespace Aluc\Models;
use Aluc\Dao\UsuarioDao;

/**
 * Usuario que puede hacer reservas en el sistema.
 */
class Usuario extends Persona {
    protected function __construct($id, $nombre) {
        parent::__construct($id, $nombre);
    }

    /**
     * Metodo para obtener el objeto usuario del array devuelto de la
     * base de datos.
     * @param $array
     * @param bool $get_element
     * @return Usuario|array
     */
    private static function get_object($array, $get_element = true){
        if ($get_element){
            return new Usuario($array[0]["id"],
                $array[0]['nombre']);

        }else {
            $usuarios = array();
            foreach ($array as $fila){
                array_push($usuarios,new Usuario($fila['id'], $fila['nombre']));
            }
            return $usuarios;
        }
    }

    /**
     * Metodo para obtener un usuario de la base de datos.
     * @param $id
     * @return Usuario|array
     */
    public static function getInstance($id) {
        return Administrador::get_object(UsuarioDao::getInstance()->get($id));
    }

    /**
     * Metodo para obtener una lista de todos los usuarios.
     * @param null $order_attribute
     * @return Usuario|array
     */
    public static function getAll($order_attribute = null){
        return self::get_object(UsuarioDao::getInstance()->getAll($order_attribute), false);
    }
}
