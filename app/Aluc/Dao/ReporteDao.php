<?php

namespace Aluc\Dao;


/**
 * Clase para para manejo de base de datos de los Reportes
 */
class ReporteDao{
    private $database;
    private static $instance = null;


    /**
     * ReporteDao constructor.
     */
    private function __construct() {
        $this->database = new Database();
        $this->database->connect();
    }

    /**
     * Obtener la instancia de la clase.
     * @return null
     */
    public static function getInstance() {
        if (static::$instance == null) {
            static::$instance = new self();
        }
        return static::$instance;
    }


    /**
     * Método para obtener reportes a partir del año y el id_usuario.
     * @param $year
     * @param $id_usuario
     * @return mixed
     */
    public function getReportes(
        $year,
        $id_usuario
    ){
        try{
            $where = "year(fecha) = '{$year}'";

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

    /**
     * Método para obtener reportes de un día en específico
     * el cual también se puede pasar parámetros para filtar la búsqueda.
     * @param $fecha
     * @param $id_usuario
     * @param $id_laboratorio
     * @return mixed
     */
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

    /**
     * Método para obtener reportes de una semana en específico
     * el cual también se puede pasar parámetros para filtar la búsqueda.
     * @param $semana
     * @param $year
     * @param $id_usuario
     * @param $id_laboratorio
     * @return mixed
     */
    public function getReporteSemana(
        $semana,
        $year,
        $id_usuario,
        $id_laboratorio
    ){
        try{
            $where = " week(fecha) = '{$semana}' 
                    and  year(fecha) = '{$year}'";

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

    /**
     * Método para obtener reportes de un mes en específico
     * el cual también se puede pasar parámetros para filtar la búsqueda.
     * @param $month
     * @param $year
     * @param $id_usuario
     * @param $id_laboratorio
     * @return mixed
     */
    public function getReporteMes(
        $month,
        $year,
        $id_usuario,
        $id_laboratorio
    ){
        try{
            $where = "month(fecha) = '{$month}' 
                    and  year(fecha) = '{$year}'";

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