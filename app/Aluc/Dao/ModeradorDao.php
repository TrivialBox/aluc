<?php
namespace Aluc\Dao;

class ModeradorDao {
    private $database;
    private static $instance;

    protected function __construct() {
        $this->database = new Database();
    }

    public static function getInstance() {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function save($obj){
        $this->database->insert("moderador",$obj);

        //impelemtar un template para retorna
        return $obj;
    }

    public function get($cedula){
        $retur = $this->database->select("modelador","*","cedula = ".$cedula,null);
        //implementar el template
        return $retur;
    }

    public function getList(){
        $retur = $this->database->select("modelador","*",null,"asc");

        //implemntar el template
        return $retur;
    }
}
