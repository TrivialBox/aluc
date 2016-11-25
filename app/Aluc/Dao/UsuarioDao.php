<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/11/16
 * Time: 1:25
 */

namespace Aluc\Dao;

/**
 * Clase para para manejo de base de datos de los usuarios.
 */
class UsuarioDao{
    private $database;
    private static $instance = null;

    /**
     * UsuarioDao constructor.
     */
    private function __construct(){
        $this->database = new Database();
        $this->database->connect();
    }

    /**
     * Método para obtener la instancia de la clase.
     * @return $instance
     */
    public static function getInstance(){
        if (static::$instance == null){
            static::$instance = new self();
        }
        return static::$instance;
    }

    /**
     * Método para obtener un usuario pasando su id.
     * @param $id
     * @return usuario
     */
    public function get($id){
        $where = "id = " . "'" . $id . "'";
        $usuario = $this->database
            ->select(
                "usuario",
                "*",
                $where,
                null
            );
        if (count($usuario) === 0){
            throw new AlucException(
                Database::getMgs(5000,$this->getModel()),
                "el administrador no se encuentra en la base de datos"
            );
        }
        return $usuario;
    }

    /**
     * Método para obtener una lista de todos los usuarios registrados
     * en la base de datos.
     * @param $order_attribute
     * @return lista_usuarios
     */
    public function getAll($order_attribute){
        $order_by = null;

        if ($order_attribute != null) {
            $order_by = "order by " . $order_attribute . " asc";
        }

        $list_usuario = $this->database
            ->select(
                "usuario",
                "*",
                null,
                $order_by
            );
        return $list_usuario;

    }
    private function getModel(){
        return [
            'elemento_null' => ['Usuario','registrado']

        ];
    }

}