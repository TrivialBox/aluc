<?php
namespace Aluc\Models;

/**
 * Representación de un lector de códigos QR.
 */
class LectorQr {
    public $id;
    public $ip;
    public $mac;
    public $laboratorio_id;

    private $token;

    /**
     * Santos cara de la buena y reveranda verga, solo creando las clases,
     * por lo menos deja haciendo.
     * postadata --> vales verga jajajaja
     * @param $id
     * @param $ip
     * @param $mac
     * @param $token
     * @param $laboratorio_id
     */
    private function __construct($id, $ip, $mac, $token, $laboratorio_id) {
        $this->ip = $ip;
        $this->mac = $mac;
        $this->token = $token;
        $this->laboratorio_id = $laboratorio_id;
    }

    public static function getNewInstance($ip, $mac, $laboratorio_id) {

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
