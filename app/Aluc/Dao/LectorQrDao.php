<?php

namespace Aluc\Dao;


use Aluc\Common\AlucException;

/**
 * Clase para para manejo de base de datos de los lectores QR
 */
class LectorQrDao {

    private $database;
    private static $instance = null;

    /**
     * LectorQrDao constructor.
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
     * Método para convertir un objeto en array asociativo.
     * @param $object
     * @return array
     */
    private function convertObjectArray($object){
        $array = [
            'mac' => $object->mac,
            'ip' => $object->ip,
            'id_laboratorio' => $object->id_laboratorio,
            'token' => $object->getToken()
        ];

        return $array;
    }

    /**
     * Él método save cumple dos funciones, insertar y actualizar
     * en la base de datos, dependiendo del parámetro $is_save.
     * @param $object
     * @param bool $type_save
     * @return mixed
     * @throws AlucException
     */
    public function save(
        $object,
        $type_save = true
    ) {
        if ($type_save) {
            try{
                $this->database->insert(
                        'lector',
                        $this->convertObjectArray($object)
                );
            }catch (\Exception $e){

                throw new AlucException(
                    Database::getMgs(
                        $e->getCode(),
                        $this->getModel()
                    ),
                    $e->getMessage()
                );
            }
        } else {
            try{
                $where = " mac = '{$object->mac}'";
                $this->database->update(
                            'lector',
                            $this->convertObjectArray($object),
                            $where
                );
            }catch (\Exception $e){
                throw new AlucException(
                    Database::getMgs(
                        $e->getCode(),
                        $this->getModel()
                    ),
                    $e->getMessage()
                );
            }

        }

        return $this->get($object->mac);
    }

    /**
     * Método para obtener un lector QR en específico.
     * @param $mac
     * @return mixed
     * @throws AlucException
     */
    public function get($mac){
        $where = "mac = '{$mac}'";
        $lectorQr = $this->database
            ->select(
                "lector",
                "*",
                $where,
                null
            );

        if (count($lectorQr) === 0){
            throw new AlucException(
                Database::getMgs(
                    5000,
                    $this->getModel()
                ),
                "elemento no existe en la base de datos"
            );
        }
        return $lectorQr;
    }

    /**
     * Método para obtener todos los lectores Qr registrados.
     * @param $order_attribute
     * @return mixed
     */
    public function getAll($order_attribute){
        $order_by = null;
        if ($order_attribute != null){
            $order_by =  "order by " . $order_attribute . " asc";
        }
        $list_lectorQr = $this->database
            ->select(
                "lector",
                "*",
                null,
                $order_by
            );

        return $list_lectorQr;
    }

    /**
     * Método para eliminar un lector Qr
     * @param $mac
     * @throws AlucException
     */
    public function delete($mac){
        $where = "mac = " . "'" . $mac . "'";
        try{
            $this->database->delete(
                "lector",
                $where
            );

        }catch (\Exception $e){
            throw new AlucException(
                'El Lector no se puede eliminar',
                $e->getMessage()
            );
        }
    }

    /**
     * Método para armar códigos de errores de la clase.
     * @return array
     */
    private function getModel(){
        return [
            'clave_foranea' => ['Laboratorio','registrado'],
            'clave_pk_duplicate' => ['Lector'],
            'elemento_null' => ['Lector','registrado']

        ];
    }
}

