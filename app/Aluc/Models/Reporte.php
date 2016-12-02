<?php
namespace Aluc\Models;

use Aluc\Common\AlucException;
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

    public static function getReporteAnio(
        $id_usuario =  null
    ){
        $reserva = ReporteDao::getInstance()
            ->getReportesAnio(self::getAnioActual(), $id_usuario);
        return self::getReserva($reserva);
    }

    public static function getReporteDia(
        $id_usuario = null,
        $id_laboratorio = null
    ){
        $reserva = ReporteDao::getInstance()
            ->getReporteDia(
                self::getDiaActual(),
                $id_usuario,
                $id_laboratorio
            );
        return self::getReserva($reserva);
    }

    public static function getReporteSemana(
        $id_usuario = null,
        $id_laboratorio = null
    ){
        $reserva = ReporteDao::getInstance()
            ->getReporteSemana(
                self::getSemanaActual(),
                self::getAnioActual(),
                $id_usuario,
                $id_laboratorio
            );
        return self::getReserva($reserva);
    }

    public static function getReporteMes(
        $id_usuario = null,
        $id_laboratorio = null
    ){
        $reserva = ReporteDao::getInstance()
            ->getReporteMes(
                self::getMesActual(),
               self::getAnioActual(),
                $id_usuario,
                $id_laboratorio
            );
        return self::getReserva($reserva);
    }

    public static function getReportes(
        $fecha_inicial,
        $fecha_final,
        $id_usuario = null,
        $id_laboratorio = null
    ){
        if (!self::validarFecha($fecha_inicial, $fecha_final)){
            throw new AlucException(
                "La fecha final es menor a la fecha inicial",
                "La fecha final es menor a la fecha inicial"
            );
        }
        $reserva = ReporteDao::getInstance()
            ->getReporte(
                $fecha_inicial,
                $fecha_final,
                $id_usuario,
                $id_laboratorio
            );
        return self::getReserva($reserva);

    }

    private static function validarFecha(
        $fecha_inicial,
        $fecha_final
    ){
        if (strtotime($fecha_final) >= strtotime($fecha_inicial)){
            return true;
        }
        return false;
    }

    private static function getDiaActual(){
        return date("Y-n-j");
    }

    private static function getAnioActual(){
        return date("Y");
    }

    private static function getMesActual(){
        return date("n");
    }

    private static function getSemanaActual(){
        return date("W");
    }
}