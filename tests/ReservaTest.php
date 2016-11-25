<?php

use PHPUnit\Framework\TestCase;
use Aluc\Models\Reserva;


class ReservaTest extends TestCase{
    public function testCreateValidReserva(){
        $usuario_id= '0104633177';
        $laboratorio_id = '1';
        $fecha_n = '2016-11-28';
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
        $this->assertEquals($reserva[0]->laboratorio_id, $laboratorio_id);
        $this->assertEquals($reserva[0]->getUsuarioId(), $usuario_id);
        $this->assertEquals($reserva[0]->getFecha()->hora_inicio, $hora_inicio);
    }
    /*public function testCambiarLaboratorioLLeno(){
        $reserva = Reserva::getReservaUsuario('0104633177');

    }

    /**
     * @expectedException Exception
    */
    /*
    public function testIngresarReservaUsuarioMax2Horas(){
        $array = self::getReservas()['1'];
        $reserva = Reserva::getNewInstance(
            $array['usuario_id'],
            $array['laboratorio_id'],
            $array['fecha_n'],
            $array['hora_inicio'],
            $array['hora_fin'],
            $array['descripcion'],
            $array['numero_usuarios'],
            $array['tipo_uso']
        )->save();
    }*/

    private static function getReservas(){
        return [
            '1' => [
                'usuario_id' => '0104633177',
                'laboratorio_id' => '1',
                'fecha_n' => '2016-11-25',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '11:00:00',
                'descripcion' => 'djdj',
                'numero_usuarios' => '2',
                'tipo_uso' => 'práctica'
          ],
            '2' => [
                'usuario_id' => '0104633177',
                'laboratorio_id' => '1',
                'fecha_n' => '2016-11-25',
                'hora_inicio' => '11:00:00',
                'hora_fin' => '13:00:00',
                'descripcion' => 'djdj',
                'numero_usuarios' => '2',
                'tipo_uso' => 'práctica'
            ],

            '3' => [
                'usuario_id' => '0104702881',
                'laboratorio_id' => '6',
                'fecha_n' => '2016-11-25',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '11:00:00',
                'descripcion' => 'djdj',
                'numero_usuarios' => '10',
                'tipo_uso' => 'práctica'
            ],
            '4' => [
                'usuario_id' => '0104737887',
                'laboratorio_id' => '1',
                'fecha_n' => '2016-11-25',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '11:00:00',
                'descripcion' => 'djdj',
                'numero_usuarios' => '8',
                'tipo_uso' => 'práctica'
            ]

        ];
    }

}