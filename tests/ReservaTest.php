<?php

use PHPUnit\Framework\TestCase;
use Aluc\Models\Reserva;


class ReservaTest extends TestCase{
    public function testCreateValidReserva(){
        $usuario_id= '0104633177';
        $laboratorio_id = '1';
        $fecha_n = '2016-11-25';
        $hora_inicio = '09:00:00';
        $hora_fin = '11:00:00';
        $descripcion = 'djdj';
        $numero_usuarios = '2';
        $tipo_uso = 'práctica';
        $reserva = Reserva::getNewInstance(
            $usuario_id,
            $laboratorio_id,
            $fecha_n,
            $hora_inicio,
            $hora_fin,
            $descripcion,
            $numero_usuarios,
            $tipo_uso
        )->save();
        $reserva = Reserva::getReservaUsuario('0104633177');
        $this->assertEquals($reserva->laboratorio_id, $laboratorio_id);
        $this->assertEquals($reserva->getUsuarioId(), $usuario_id);
        $this->assertEquals($reserva->getFecha()->hora_inicio, $hora_inicio);
    }

}