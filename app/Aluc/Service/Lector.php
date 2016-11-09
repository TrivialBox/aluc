<?php
namespace Aluc\Service;

class Lector {
    public $id;
    public $ip;
    public $mac;

    private $token;

    private function __construct($id, $ip, $mac, $token) {
        $this->id = $id;
        $this->ip = $ip;
        $this->mac = $mac;
        $this->token = $token;
    }

    public static function getNewInstance($ip, $mac) {

    }

    public static function getInstance($id) {

    }

    public function getToken() {
        return $this->token;
    }

    private function generarToken() {
    }

    public function renovarToken() {

    }
}
