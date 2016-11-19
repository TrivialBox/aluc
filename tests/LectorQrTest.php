<?php
use Aluc\Models\LectorQr;
use PHPUnit\Framework\TestCase;


class LectorQrTest extends TestCase {
    public function testCreateValidLectorQr() {
        $mac = 'e8:91:21:8c:e8:2d';
        $ip = '0.0.0.0';
        $lab_id = '6';
        $lector = LectorQr::getNewInstance($mac, $ip, $lab_id)->save();
        $token = $lector->getToken();

        $lector = LectorQr::getInstance($mac);
        $this->assertEquals($lector->mac, $mac);
        $this->assertEquals($lector->ip, $ip);
        $this->assertEquals($lector->id_laboratorio, $lab_id);
        $this->assertEquals($lector->getToken(), $token);
        $lector->delete();
    }

    /**
     * @expectedException Exception
     */
    public function testCreateLectorQrInvalidMac() {
        $mac = '134:ea:34cc:b12:gg:12h';
        $lector = LectorQr::getNewInstance($mac, '0.0.0.0', '6')->save();
    }

    /**
     * @expectedException Exception
     */
    public function testCreateLectorQrInvalidIp() {
        $mac = 'e8:91:21:8c:e8:2d';
        $ip = '192.168.0.256';
        $lector = LectorQr::getNewInstance($mac, $ip, '6')->save();
    }

    /**
     * @expectedException Exception
     */
    public function testCreateLectorQrInvalidLabid() {
        $mac = 'e8:91:21:8c:e8:2d';
        $ip = '0.0.0.0';
        $lector = LectorQr::getNewInstance($mac, $ip, '8')->save();
    }

    public function testEditLectorQr() {
        $ip = '0.0.0.0';
        $mac = 'e8:91:21:8c:e8:2d';
        $lab_id = '6';
        $new_ip = '0.0.0.1';
        $new_lab_id = '3';
        $lector = LectorQr::getNewInstance($mac, $ip, $lab_id)->save();
        $token = $lector->getToken();
        $lector->ip = $new_ip;
        $lector->id_laboratorio = $new_lab_id;
        $lector->save();

        $lector = LectorQr::getInstance($mac);
        $this->assertEquals($lector->mac, $mac);
        $this->assertEquals($lector->ip, $new_ip);
        $this->assertEquals($lector->id_laboratorio, $new_lab_id);
        $this->assertEquals($lector->getToken(), $token);

        $lector->delete();
    }

    public function testUpdateToken() {
        $ip = '0.0.0.0';
        $mac = 'e8:91:21:8c:e8:2d';
        $lab_id = '6';
        $lector = LectorQr::getNewInstance($mac, $ip, $lab_id)->save();
        $token = $lector->getToken();

        $lector = LectorQr::getInstance($mac);
        $lector->renovarToken();
        $this->assertEquals($lector->getToken(), $token);
        $lector->delete();
    }
}