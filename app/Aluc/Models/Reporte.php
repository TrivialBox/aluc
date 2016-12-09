<?php
namespace Aluc\Models;

use Aluc\Common\AlucException;
use Aluc\Dao\ReporteDao;

class Reporte
{

    private static function getReserva($reserva_view)
    {

        $fecha_metadata = [
            'fecha' => 'fecha',
            'hora_inicio' => 'hora de inicio',
            'hora_fin' => 'hora de fin',
            'fecha_creacion' => 'fecha de creación',
            'hora_activacion' => 'hora de verificación'
        ];

        $reserva_metadata = [
            'id' => 'id reserva',
            'n_usuarios' => 'número de usuarios',
            'descripcion' => 'descripción',
            'tipo_uso' => 'tipo de uso',
            'codigo_secreto' => 'codigo secreto'

        ];

        $reservacion_metadata = [
            'id_usuario' => 'id usuario',
            'id_laboratorio' => 'id laboratorio',
            'estado' => 'estado'
        ];
        $reporte = [
            0 => [
                'reserva' => $reserva_metadata,
                'reservacion' => $reservacion_metadata,
                'fecha' => $fecha_metadata
            ]
        ];


        foreach ($reserva_view as $fila) {
            $reserva = [
                'id' => $fila['id'],
                'n_usuarios' => $fila['n_usuarios'],
                'descripcion' => $fila['descripcion'],
                'tipo_uso' => $fila['tipo_uso'],
                'codigo_secreto' => $fila['codigo_secreto']
            ];

            $reservacion = [
                'id_usuario' => $fila['id_usuario'],
                'id_laboratorio' => $fila['id_laboratorio'],
                'estado' => $fila['estado']
            ];

            $fecha = [
                'fecha' => $fila['fecha'],
                'hora_inicio' => $fila['hora_inicio'],
                'hora_fin' => $fila['hora_fin'],
                'fecha_creacion' => $fila['fecha_creacion'],
                'hora_activacion' => $fila['hora_activacion']
            ];

            $reporte_file = [
                'reserva' => $reserva,
                'reservacion' => $reservacion,
                'fecha' => $fecha
            ];

            array_push($reporte, $reporte_file);
        }
        return $reporte;
    }

    public static function getReporteAnio(
        $id_usuario = null,
        $id_laboratorio = null
    )
    {
        $reserva = ReporteDao::getInstance()
            ->getReportesAnio(
                self::getAnioActual(),
                $id_usuario,
                $id_laboratorio
            );

        return self::getReserva($reserva);
    }

    public static function getReporteDia(
        $id_usuario = null,
        $id_laboratorio = null
    )
    {
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
    )
    {
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
    )
    {
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
                $id_laboratorio
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