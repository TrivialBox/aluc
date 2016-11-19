<?php
namespace Aluc\Models;
use Aluc\Dao\LectorQrDao;
use Sinergi\Token\StringGenerator;


/**
 * Representación de un lector de códigos QR.
 */
class LectorQr {

    public $mac;
    public $ip;
    public $id_laboratorio;

    private $token;

    private $is_save = true;

    private function __construct($mac, $ip, $id_laboratorio, $token, $is_save = true) {
        $this->ip = $ip;
        $this->mac = $mac;
        $this->token = $token;
        $this->id_laboratorio = $id_laboratorio;

        $this->is_save = $this->is_save && $is_save;
    }

    private static function get_object($array, $get_element = true){
        if ($get_element){
            return new LectorQr($array[0]["mac"], $array[0]["ip"], $array[0]['id_laboratorio'], $array[0]['token']);
        } else {
            $LectoresQr = [];
            foreach ($array as $fila){
                $LectoresQr[] = new LectorQr($fila["mac"], $fila["ip"], $fila['id_laboratorio'], $fila['token'], false);
            }
            return $LectoresQr;
        }
    }

    public static function getNewInstance($mac, $ip, $id_laboratorio) {
        return new self($mac, $ip, $id_laboratorio, self::generarToken());
    }

    public static function getInstance($mac) {
        return LectorQr::get_object(LectorQrDao::getInstance()->get($mac));
    }

    public static function getAll($order_atribute = null) {
        return LectorQr::get_object(
            LectorQrDao::getInstance()->getAll($order_atribute),
            false
        );
    }

    public function getLaboratorio() {
        return Laboratorio::getInstance($this->id_laboratorio);
    }

    public function save() {
        $obj = static::get_object(
            LectorQrDao::getInstance()->save($this, $this->is_save)
        );
        $this->mac = $obj->mac;
        $this->ip = $obj->ip;
        $this->id_laboratorio = $obj->id_laboratorio;
        $this->token = $obj->getToken();
        $this->is_save = false;
        return $this;
    }

    public function delete(){
        LectorQrDao::getInstance()->delete($this->mac);
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
