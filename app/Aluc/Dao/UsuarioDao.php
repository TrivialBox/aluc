<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/11/16
 * Time: 1:25
 */

namespace Aluc\Dao;


class UsuarioDao{
    private $database;
    private static $instance = null;

    private function __construct(){
        $this->database = new Database();
        $this->database->connect();
    }

    /**
     * Metodo para obtener la clase instanciada.
     * @return $instance
     */
    public static function getInstance(){
        if (static::$instance == null){
            static::$instance = new self();
        }
        return static::$instance;
    }

    /**
     * Metodo para ontener un usuario pasando su id.
     * @param $id
     * @return usuario
     */
    public function get($id){
        $where = "id = " . "'" . $id . "'";
        $usuario = $this->database->select("usuario", "*", $where, null);
        if (count($usuario) === 0){
            throw new AlucException(
                Database::getMgs(5000,$this->getModel()),
                "el administrador no se entuentra en la base de datos"
            );
        }
        return $usuario;
    }

    /**
     * Metodo para obtener una lista de todos los usuarios registrados
     * en la base de datos.
     * @param $order_atribute
     * @return lista_usuarios
     */
    public function getAll($order_atribute){
        $order_by = null;

        if ($order_atribute != null) {
            $order_by = "order by " . $order_atribute . " asc";
        }

        $list_usuario = $this->database->select("usuario", "*", null, $order_by);
        return $list_usuario;

    }
    private function getModel(){
        return [
            'elemento_null' => ['Usuario','registrado']

        ];
    }

}