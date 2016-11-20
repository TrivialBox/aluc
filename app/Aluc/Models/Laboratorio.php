<?php
namespace Aluc\Models;

use Aluc\Dao\LaboratorioDao;
use Symfony\Component\Console\Command\ListCommand;

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


    private function __construct(
        $id, $nombre, $capacidad, $descripcion, $horario
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->capacidad = $capacidad;
        $this->descripcion = $descripcion;
        $this->horario = $horario;
    }


    private static function get_object($array, $get_element = true){
        if ($get_element){
            $jordana1 = new Fecha(null,$array[0]["j1_hora_apertura"],$array[0]["j1_hora_cierre"]);
            $jornada2 = new Fecha(null,$array[0]["j2_hora_apertura"],$array[0]["j2_hora_cierre"]);
            $horario = new Horario($jordana1,$jornada2);
            return new Laboratorio($array[0]["id"], $array[0]["nombre"], $array[0]["capacidad"],
                $array[0]["descripcion"], $horario);

        }else {
            $labs = array();
            foreach ($array as $fila){
                $jordana1 = new Fecha(null,$fila["j1_hora_apertura"], $fila["j1_hora_cierre"]);
                $jornada2 = new Fecha(null,$fila["j2_hora_apertura"],$fila["j2_hora_cierre"]);
                $horario = new Horario($jordana1,$jornada2);

                array_push($labs,new Laboratorio($fila["id"], $fila["nombre"], $fila["capacidad"],
                    $fila["descripcion"], $horario));
            }
            return $labs;
        }
    }

    public static function getInstance($id) {
        return Laboratorio::get_object(LaboratorioDao::getInstance()->get($id));
    }

    private function convertArray($lista){
        $array = [];
        foreach ($lista as $fila){
            array_push($array,$fila['id']);
        }

        return $array;
    }

    public function getModeradores() {
        return $this->convertArray(LaboratorioDao::getInstance()->getModeradores($this->id));
    }

    public static function getAll($order_atribute = null){
        return Laboratorio::get_object(LaboratorioDao::getInstance()->getAll($order_atribute), false);
    }

}
