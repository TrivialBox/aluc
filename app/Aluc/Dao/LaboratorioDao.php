<?php


namespace Aluc\Dao;


use Aluc\Common\AlucException;

class LaboratorioDao{
    private $database;
    private static $instance= null;

    private function __construct(){
        $this->database = new Database();
        $this->database->connect();
    }

    public static function getInstance(){
        if (static::$instance == null){
            static::$instance = new self();
        }
        return static::$instance;
    }
    public function  get($id){
        $where_lab = "id = " . "'" . $id . "'";
        $laboratorio = $this->database->select("view_laboratorio", "*", $where_lab, null);

        if (count($laboratorio) === 0){
            throw new AlucException(
                Database::getMgs(5000,$this->getModel()),
                "el laboratorio no se entuentra en la base de datos"
            );
        }
        return $laboratorio;
    }

    public function getModeradores($id){
        $where_mod = "id_laboratorio = " . "'" . $id . "'";
        $lista_moderadores = $this->database->select("moderador", ["id"], $where_mod, null);
        return $lista_moderadores;
    }

    public function getAll($order_atribute){
        $order_by = null;

        if ($order_atribute != null) {
            $order_by = "order by " . $order_atribute . " asc";
        }
        $list_laboratorio = $this->database->select("view_laboratorio", "*", null, $order_by);

        return $list_laboratorio;

    }
    private function getModel(){
        return [
            'elemento_null' => ['laboratorio','registrado']

        ];
    }
}