<?php
namespace Aluc\Models;
use ALUC\Dao\LectorDao;
use Sinergi\Token\StringGenerator;

/**
 * Representación de un lector de códigos QR.
 */
class LectorQr {

    public $mac;
    public $ip;
    public $id_laboratorio;

    private $token;

    private function __construct($mac, $ip, $id_laboratorio, $token) {
        $this->ip = $ip;
        $this->mac = $mac;
        $this->token = $token;
        $this->laboratorio_id = $id_laboratorio;
    }

    private static function get_object($array, $get_element = true){
        if ($get_element){
            return new LectorQr($array[0]["mac"],$array[0]["ip"], $array[0]['id_laboratorio'], $array[0]['token']);

        }else {
            $LectoresQr = array();
            foreach ($array as $fila){
                array_push($LectoresQr,new LectorQr($fila["mac"],$fila["ip"], $fila['id_laboratorio'], $fila['token']));
            }
            return $LectoresQr;
        }
    }

    public static function getNewInstance($mac, $ip, $id_laboratorio) {
        return new self($mac, $ip, $id_laboratorio,self::generarToken());
    }

    public static function getInstance($mac) {
        return LectorQr::get_object(LectorDao::getInstance()->get($mac));
    }

    public static function getAll($order_atribute = null) {
        return LectorQr::get_object(
            LectorDao::getInstance()->getAll($order_atribute),
            false
        );
    }

    public function getLaboratorio() {
        return Laboratorio::getInstance($this->id_laboratorio);
    }

    public function save() {
        $obj = static::get_object(
            LectorDao::getInstance()->save($this, $this->is_save)
        );
        $this->mac = $obj->mac;
        $this->ip = $obj->ip;
        $this->id_laboratorio = $obj->id_laboratorio;
        $this->token = $obj->getToken();
        $this->is_save = false;
        return $this;
    }

    public function delete(){
        LectorDao::getInstance()->delete($this->mac);
    }

    public function getToken() {
        return $this->token;
    }

    private static function generarToken() {
        return StringGenerator::randomAlnum(15);
    }

    public function renovarToken() {
        $this->token = self::generarToken();
    }
}
