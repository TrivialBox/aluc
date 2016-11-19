<?php
namespace Aluc\Models;

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


    private function __construct(
        $id, $nombre, $capacidad, $descripcion, $horario
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->capacidad = $capacidad;
        $this->descripcion = $descripcion;
        $this->horario = $horario;
    }

    private static function createHorario($array){
        $jordana1 = new Fecha(null,$array[0]["j1_hora_apertura"],$array[0]["j1_hora_cierre"]);
        $jornada2 = new Fecha(null,$array[0]["j2_hora_apertura"],$array[0]["j2_hora_cierre"]);
        $horario = new Horario($jordana1,$jornada2);

        return $horario;
    }

    private static function get_object($array, $get_element = true){
        if ($get_element){
            return new Laboratorio($array[0]["id"], $array[0]["nombre"], $array[0]["capacidad"],
                $array[0]["descripcion"], Laboratorio::createHorario($array));

        }else {
            $moderadores = array();

            foreach ($array as $fila){
                array_push($moderadores,new Laboratorio($fila[0]["id"], $fila[0]["nombre"], $fila[0]["capacidad"],
                    $fila[0]["descripcion"], Laboratorio::createHorario($fila)));
            }
            return $moderadores;
        }
    }

    public static function getInstance($id) {
        return Laboratorio::get_object(LaboratorioDao::getInstance()->get($id));
    }

    public function getModeradores() {
        $lista_moderadores = LaboratorioDao::getInstance()->getModeradores($this->id);
        return Moderador::get_object($lista_moderadores, false);
    }

    public static function getAll($order_atribute = null){
        return Laboratorio::get_object(LaboratorioDao::getInstance()->getAll($order_atribute), false);
    }

}
