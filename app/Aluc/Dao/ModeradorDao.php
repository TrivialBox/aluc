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

    public function save(Moderador $obj){
        $datos = array();
        $datos["id"] = $obj->id;
        $datos["nombre"] = $obj->nombre;
        $datos["id_laboratorio"] = $obj->id_laboratorio;
        $this->database->insert("moderador", $datos);
    }

    public function get($cedula){
        $result = $this->database->select(
            'moderador',
            '*',
            "cedula = {$cedula}"
        )->next();
        $id = $result['id'];
        throw new \Exception(
            "FALTA CONSULTAR DE LAS OTRAS TABLAS
            LA INFORMACIÓN DEL MODERADOR"
        );
        $nombre = $result[1];  // Consultar de la  tabla persona/usuario
        $id_lab = $result[2];  // Consultar de la tabla moderadorLaboratorio
        return Moderador::getNewInstace($id, $nombre, $id_lab);
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
        }
    }
}
