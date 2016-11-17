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

    private function __construct($mac, $ip, $token, $laboratorio_id) {
        $this->ip = $ip;
        $this->mac = $mac;
        $this->token = $token;
        $this->laboratorio_id = $laboratorio_id;
    }

    public static function getNewInstance($mac, $ip, $laboratorio_id) {

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