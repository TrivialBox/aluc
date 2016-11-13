<?php
namespace Aluc\Dao;

use Aluc\Service\Moderador;

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

        $datos = array();
        $nombre = get_class($obj);
        if($nombre=="Moderador"){
            $datos["id"]=$obj->id;
            $datos["nombre"]=$obj->nombre;
            $datos["id_laboratorio"]=$obj->id_laboratorio;
            $this->database->insert("moderador",$datos);
        }else{
            die("Este onjeto no pertenece a esta clase.");
        }


        return $obj;
    }

    public function get($cedula){
        $retur = $this->database->select("moderador","*","cedula = {$cedula}",null);
        $id = $retur[0];
        $nombre = $retur[1];
        $id_lab = $retur[2];
        $moderador = Moderador::getNewInstace($id,$nombre,$id_lab);
        return $moderador;
    }

    public function del($cedula,$id_laboratorio){
        $this->database->delete("moderador","cedula = {$cedula} and id_laboratorio = {$id_laboratorio} ");
    }
    public function getList(){
        //TODO realizar un array de objetos pra retornar doto por medio de iterador
        $retur = $this->database->select("moderador","*",null,"asc");
        $array = ArrayObject();

        foreach ($retur as $valor){
            $id = $valor[0];
            $nombre = $valor[1];
            $id_lab = $valor[2];
            $moderador = Moderador::getNewInstace($id,$nombre,$id_lab);
            $array->append($moderador);
        }
        unset($array);
        $iterator = function ($array) {
            while ($row = $array->fetch_assoc()) {
                yield $row;
            }
        };
        return 1;
        //TODO en el retorno hacer que regrese
    }
}
