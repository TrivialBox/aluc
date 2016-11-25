<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 24/11/16
 * Time: 19:43
 */

use PHPUnit\Framework\TestCase;
use Aluc\Models\Reserva;


class ReservaTest extends TestCase{
    public function testCreateValidReserva(){
        $usuario_id= '0103162038';
        $laboratorio_id = '1';
        $fecha_n = '2016-11-25';
        $hora_inicio = '09:00:00';
        $hora_fin = '11:00:00';
        $descripcion = 'djdj';
        $numero_usuarios = '2';
        $tipo_uso = 'práctica';
        Reserva::getNewInstance(
            $usuario_id,
            $laboratorio_id,
            $fecha_n,
            $hora_inicio,
            $hora_fin,
            $descripcion,
            $numero_usuarios,
            $tipo_uso
        )->save();
        $reserva = Reserva::getReservaUsuario('0103162038');
        $this->assertEquals($reserva->laboratorio_id, $laboratorio_id);
        $this->assertEquals($reserva->getUsuarioId(), $usuario_id);
        $this->assertEquals($reserva->getFecha()->hora_inicio, $hora_inicio);
    }

}