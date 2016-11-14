<?php
namespace Aluc\Service;

/**
 * Representación de un lector de códigos QR.
 */
class Lector {
    public $id;
    public $ip;
    public $mac;
    public $laboratorio_id;

    private $token;

    private function __construct($id, $ip, $mac, $token, $laboratorio_id) {
        $this->id = $id;
        $this->ip = $ip;
        $this->mac = $mac;
        $this->token = $token;
        $this->laboratorio_id = $laboratorio_id;
    }

    public static function getNewInstance($ip, $mac, $laboratorio_id) {

    }

    public static function getInstance($id) {

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
