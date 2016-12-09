<?php
namespace Aluc\Models;

use Aluc\Common\AlucException;
use Aluc\Dao\ReporteDao;

class Reporte
{

    private static function getReserva($reserva_view)
    {
        $reporte = [
            0 => [
               'Reserva',
                'Reservación' ,
                'Fecha'
            ]
        ];



        foreach ($reserva_view as $fila) {
            $fecha = [
                'Fecha de reservación' => $fila['fecha'],
                'Hora de inicio de reserva' => $fila['hora_inicio'],
                'Hora final de reserva' => $fila['hora_fin'],
                'Fecha de creacion' => $fila['fecha_creacion'],
                'Hora de activación' => $fila['hora_activacion']
            ];
            if ($fecha['Hora de activación'] == null){
                unset($fecha['Hora de activación']);
            }

            $reserva = [
                'Id reserva' => $fila['id'],
                'Número de usuarios' => $fila['n_usuarios'],
                'Descripción' => $fila['descripcion'],
                'Tipo de uso' => $fila['tipo_uso'],
                'Código secreto' => $fila['codigo_secreto']
            ];

            $reservacion = [
                'Id usuario' => $fila['id_usuario'],
                'Id laboratorio' => $fila['id_laboratorio'],
                'Estado' => $fila['estado']
            ];



            $reporte_file = [
                'Reserva' => $reserva,
                'Reservacion' => $reservacion,
                'Fecha' => $fecha
            ];


            array_push($reporte, $reporte_file);
        }
        return $reporte;
    }

    public static function getReporteAnio(
        $id_usuario = null,
        $id_laboratorio = null,
        $estado = null
    )
    {
        $reserva = ReporteDao::getInstance()
            ->getReportesAnio(
                self::getAnioActual(),
                $id_usuario,
                $id_laboratorio,
                $estado
            );

        return self::getReserva($reserva);
    }

    public static function getReporteDia(
        $id_usuario = null,
        $id_laboratorio = null,
        $estado = null
    )
    {
        $reserva = ReporteDao::getInstance()
            ->getReporteDia(
                self::getDiaActual(),
                $id_usuario,
                $id_laboratorio,
                $estado
            );
        return self::getReserva($reserva);
    }

    public static function getReporteSemana(
        $id_usuario = null,
        $id_laboratorio = null,
        $estado = null
    )
    {
        $reserva = ReporteDao::getInstance()
            ->getReporteSemana(
                self::getSemanaActual(),
                self::getAnioActual(),
                $id_usuario,
                $id_laboratorio,
                $estado
            );
        return self::getReserva($reserva);
    }

    public static function getReporteMes(
        $id_usuario = null,
        $id_laboratorio = null,
        $estado = null
    )
    {
        $reserva = ReporteDao::getInstance()
            ->getReporteMes(
                self::getMesActual(),
                self::getAnioActual(),
                $id_usuario,
                $id_laboratorio,
                $estado
            );
        return self::getReserva($reserva);
    }



    public static function getReportes(
        $fecha_inicial,
        $fecha_final,
        $id_usuario = null,
        $id_laboratorio = null,
        $estado = null
    )
    {
        if (!self::validarFecha($fecha_inicial, $fecha_final)) {
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
                $id_laboratorio,
                $estado
            );
        return self::getReserva($reserva);

    }

    private static function validarFecha(
        $fecha_inicial,
        $fecha_final
    )
    {
        if (strtotime($fecha_final) >= strtotime($fecha_inicial)) {
            return true;
        }
        return false;
    }

    private static function getDiaActual()
    {
        return date("Y-n-j");
    }

    private static function getAnioActual()
    {
        return date("Y");
    }

    private static function getMesActual()
    {
        return date("n");
    }

    private static function getSemanaActual()
    {
        return date("W");
    }
}
