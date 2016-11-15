<?php
namespace Aluc\Service;
use Aluc\Dao\LaboratorioDao;

/**
 * Representación de un laboratorio, el cual debe estar coordinado
 * por al menos un moderador.
 */
class Laboratorio {
    public $id;
    public $nombre;
    public $capacidad;
    public $descripcion;
    public $horario;

    private $moderadores;

    private function __construct(
        $id, $nombre, $capacidad, $descripcion, $horario,
        array $moderadores
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->capacidad = $capacidad;
        $this->descripcion = $descripcion;
        $this->horario = $horario;
        $this->moderadores = $moderadores;
    }

    private static function get_object($array, $get_element = true){

        if ($get_element){

            return new Laboratorio($array[0]["id"],$array[0]["nombre"],$array[0]["capacidad"],
                $array[0]["descripcion"],$array[0]["id_horario"],$array[0]["id_moderadores"]);


        }else {
            $moderadores = array();
            foreach ($array as $fila){
                //array_push($moderadores,new Moderador($fila['id'], $fila['id_laboratorio'], $fila['nombre']));
            }
            return $moderadores;
        }
    }

    public static function getInstance($id) {
        return Laboratorio::get_object(LaboratorioDao::getInstance()->get($id));
    }

    public function getModeradores() {

    }

    public function addModerador($id) {

    }

    public function delModerador($id) {

    }
}
