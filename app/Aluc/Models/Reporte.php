<?php


namespace Aluc\Models;

use Aluc\Dao\ReporteDao;

class Reporte{

    private static function getReserva($reserva){
        $reporte = [
           0 =>[
            'id',
            'id_usuario',
            'id_laboratorio',
            'descripción',
            'n_usuarios',
            'tipo_uso',
            'estado',
            'fecha',
            'hora_inicio',
            'hora_fin',
            'codigo_secreto']
        ];
        foreach ($reserva as $fila){
            array_push($reporte,$fila);
        }
        return $reporte;
    }

    public static function getInstance(
        $anio,
        $id_usuario =  null
    ){
        $reserva = ReporteDao::getInstance()
            ->getReportes($anio, $id_usuario);
        return self::getReserva($reserva);
    }

    public static function getReporteDia(
        $fecha,
        $id_usuario = null,
        $id_laboratorio = null
    ){
        $reserva = ReporteDao::getInstance()
            ->getReporteDia(
                $fecha,
                $id_usuario,
                $id_laboratorio
            );
        return self::getReserva($reserva);
    }

    public static function getReporteSemana(
        $num_semana,
        $anio,
        $id_usuario = null,
        $id_laboratorio = null
    ){
        $reserva = ReporteDao::getInstance()
            ->getReporteSemana(
                $num_semana,
                $anio,
                $id_usuario,
                $id_laboratorio
            );
        return self::getReserva($reserva);
    }

    public static function getReporteMes(
        $num_mes,
        $anio,
        $id_usuario = null,
        $id_laboratorio = null
    ){
        $reserva = ReporteDao::getInstance()
            ->getReporteMes(
                $num_mes,
                $anio,
                $id_usuario,
                $id_laboratorio
            );
        return self::getReserva($reserva);
    }




}