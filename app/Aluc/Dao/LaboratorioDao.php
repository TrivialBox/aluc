<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/11/16
 * Time: 20:26
 */

namespace Aluc\Dao;


class LaboratorioDao{
    private $data_base;
    private static $instance= null;

    private function __construct(){
        $this->data_base = new Database();
        $this->data_base->connect();
    }
    function __destruct(){
        $this->data_base->disconnect();
    }

    public static function getInstance(){
        if (static::$instance == null){
            static::$instance = new self();
        }
        return static::$instance;
    }
    public function  get($id){

        $where_lab = "id = " . "'" . $id . "'";
        $where_mod = "id_laboratorio = " . "'" . $id . "'";

        $laboratorio = $this->data_base->select("laboratorio", "*", $where_lab, null);
        $id_moderadores = $this->data_base->select("moderador", ["id"], $where_mod, null);

        $laboratorio[0]['id_moderadores'] = $id_moderadores;
        return $laboratorio;
    }

    public function getAll($order_atribute){
        $order_by = null;

        if ($order_atribute != null) {
            $order_by = "order by " . $order_atribute . " asc";
        }
        $list_laboratorio = $this->database->select("laboratorio", "*", null, $order_by);

        return $list_laboratorio;

    }
}