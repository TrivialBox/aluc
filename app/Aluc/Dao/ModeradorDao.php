<?php
namespace Aluc\Dao;



class ModeradorDao {
    private $database;
    private static $instance = null;

    private function __construct() {
        $this->database = new Database();
    }

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new self();
        }
        return static::$instance;
    }

    public function save($obj){
        return $this->database->insert("insert_moderador",$obj);
    }

    public function get($cedula){
        $where = "id = " . "'" . $cedula . "'";
        $moderador = $this->database->select("moderador", "*", $where, null);
        return $moderador;
    }

    public function del($cedula, $id_laboratorio){
        $this->database->delete(
            'moderador',
            "cedula = {$cedula} and id_laboratorio = {$id_laboratorio}"
        );
    }

    public function getList(){
        $result = $this->database->select(
            'moderador',
            '*'
        );
        foreach ($result as $valor){
            // TODO: lo mismo que la recuperar un solo moderador
            $id = $valor[0];
            $nombre = $valor[1];
            $id_lab = $valor[2];
            $moderador = Moderador::getNewInstace($id, $nombre, $id_lab);
            yield $moderador;
    public function getAll($order_atribute){
        $order_by = null;

        if ($order_atribute != null){
            $order_by = $order_atribute . " asc";
        }
        /* si se usa una vista especificar el nombre el el primer parametro del metodo select
        *  de igual manera si es una tabla solo poner el nombre de la tabla
        */
        $list_moderador = $this->database->select("moderador", "*", null, $order_by);

        return $list_moderador;

    }
}
