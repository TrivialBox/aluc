<?php
namespace Aluc\Models;
use ALUC\Dao\LectorDao;

/**
 * Representación de un lector de códigos QR.
 */
class LectorQr {

    public $mac;
    public $ip;
    public $laboratorio_id;

    private $token;

    private function __construct($mac, $ip, $laboratorio_id, $token) {
        $this->ip = $ip;
        $this->mac = $mac;
        $this->token = $token;
        $this->laboratorio_id = $laboratorio_id;
    }

    private static function get_object($array, $get_element = true){

            return 1;
    }

    public static function getNewInstance($mac, $ip, $laboratorio_id) {
        return LectorQr::get_object(LectorDao::getInstance());
    }

    public static function getInstance($mac) {

    }

    public static function getAll() {
    }

    public function getLaboratorio() {

    }

    public function getToken() {
        return $this->token;
    }

    private function generarToken() {
    }

    public function renovarToken() {

    }
}
