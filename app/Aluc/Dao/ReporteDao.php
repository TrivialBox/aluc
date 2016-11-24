<?php

namespace Aluc\Dao;


class ReporteDao{
    private $database;
    private static $instance = null;


    private function __construct() {
        $this->database = new Database();
        $this->database->connect();
    }

    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new self();
        }
        return static::$instance;
    }


    public function getReportes(
        $anio,
        $id_usuario
    ){
        try{
            $where = "year(fecha) = '{$anio}'";

            if ($id_usuario != null){
                $where .= " and id_usuario = '{$id_usuario}'";
            }

            return $reporteDia = $this->database
                ->select(
                    "view_reserva",
                    '*',
                    $where,
                    'fecha asc'
                );

        }catch (\Exception $e){
            ReservaDao::generarExcepcion($e);
        }
    }

    public function getReporteDia(
        $fecha,
        $id_usuario,
        $id_laboratorio
    ){
        try{
            $where = "fecha = '{$fecha}'";
            if ($id_usuario != null){
                $where .= " and id_usuario = '{$id_usuario}'";
            }
            if ($id_laboratorio != null){
                $where .= " and id_laboratorio = '{$id_laboratorio}'";
            }
            return $reporteDia = $this->database
                ->select(
                    "view_reserva",
                    '*',
                    $where,
                    'fecha asc'
                );

        }catch (\Exception $e){
            ReservaDao::generarExcepcion($e);
        }
    }

    public function getReporteSemana($semana, $anio,$id_usuario, $id_laboratorio){
        try{
            $where = " week(fecha) = '{$semana}' 
                    and  year(fecha) = '{$anio}'";

            if ($id_usuario != null){
                $where .= " and id_usuario = '{$id_usuario}'";
            }
            if ($id_laboratorio != null){
                $where .= " and id_laboratorio = '{$id_laboratorio}'";
            }
            return $reporteDia = $this->database
                ->select(
                    "view_reserva",
                    '*',
                    $where,
                    'fecha asc'
                );

        }catch (\Exception $e){
            ReservaDao::generarExcepcion($e);
        }
    }

    public function getReporteMes(
        $month,
        $anio,
        $id_usuario,
        $id_laboratorio
    ){
        try{
            $where = "month(fecha) = '{$month}' 
                    and  year(fecha) = '{$anio}'";

            if ($id_usuario != null){
                $where .= " and id_usuario = '{$id_usuario}'";
            }
            if ($id_laboratorio != null){
                $where .= " and id_laboratorio = '{$id_laboratorio}'";
            }
            return $reporteDia = $this->database
                ->select(
                "   view_reserva",
                    '*',
                    $where,
                    'fecha asc'
                );

        }catch (\Exception $e){
            ReservaDao::generarExcepcion($e);
        }
    }



}