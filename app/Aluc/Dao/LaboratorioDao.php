<?php


namespace Aluc\Dao;


use Aluc\Common\AlucException;

/**
 * Clase para para manejo de base de datos de los laboratorios
 */
class LaboratorioDao{
    private $database;
    private static $instance= null;

    /**
     * LaboratorioDao constructor.
     */
    private function __construct(){
        $this->database = new Database();
        $this->database->connect();
    }

    /**
     * Obtener la instancia de la clase.
     * @return null
     */
    public static function getInstance(){
        if (static::$instance == null){
            static::$instance = new self();
        }
        return static::$instance;
    }

    /**
     * Método para obtener un laboratorio en específico.
     * @param $id
     * @return laboratorio
     * @throws AlucException
     */
    public function  get($id){
        $where_lab = "id = " . "'" . $id . "'";
        $laboratorio = $this->database
            ->select(
                "view_laboratorio",
                "*",
                $where_lab,
                null
            );

        if (count($laboratorio) === 0){
            throw new AlucException(
                Database::getMgs(
                    5000,
                    $this->getModel()
                ),
                "el laboratorio no se encuentra en la base de datos"
            );
        }
        return $laboratorio;
    }

    /**
     * Método para obtener los moderadores
     * que estén registrados con el id
     * de laboratorio.
     * @param $id
     * @return mixed
     */
    public function getModeradores($id){
        $where_mod = "id_laboratorio = " . "'" . $id . "'";
        $lista_moderadores = $this->database
            ->select(
                "moderador",
                ["id"],
                $where_mod,
                null
            );

        return $lista_moderadores;
    }

    /**
     * Método para obtener todos los
     * laboratorios registrados en la base de datos.
     * @param $order_attribute
     * @return mixed
     */
    public function getAll($order_attribute){
        $order_by = null;

        if ($order_attribute != null) {
            $order_by = "order by " . $order_attribute . " asc";
        }
        $list_laboratorio = $this->database
            ->select(
                "view_laboratorio",
                "*",
                null,
                $order_by
            );

        return $list_laboratorio;
    }

    /**
     * Método para armar códigos de errores de la clase.
     * @return array
     */
    private function getModel(){
        return [
            'elemento_null' => ['laboratorio','registrado']
        ];
    }
}