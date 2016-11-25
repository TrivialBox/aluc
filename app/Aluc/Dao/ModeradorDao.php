<?php
namespace Aluc\Dao;


use Aluc\Common\AlucException;

/**
 * Clase para para manejo de base de datos de los moderadores.
 */
class ModeradorDao {
    private $database;
    private static $instance = null;

    /**
     * ModeradorDao constructor.
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
            'id' => $object->id,
            'id_laboratorio' => $object->id_laboratorio
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
    ){
        if ($type_save){
            try{
                $this->database->insert(
                    "moderador",
                    $this->convertObjectArray($object)
                );
            }catch (\Exception $e){
                throw new AlucException(
                    Database::getMgs(
                        $e->getCode(),
                        $this->getModel()),
                    $e->getMessage()
                );
            }
        } else {
            try {
                $where = " id = '{$object->id}'";
                $this->database->update(
                    'moderador',
                    $this->convertObjectArray($object),
                    $where
                );
            } catch (\Exception $e) {
                throw new AlucException(
                    Database::getMgs(
                        $e->getCode(),
                        $this->getModel()),
                    $e->getMessage()
                );
            }
        }
        return $this->get($object->id);
    }

    /**
     * Método para obtener un moderador en específico.
     * @param $id
     * @return mixed
     * @throws AlucException
     */
    public function get($id){

        $where = "id = " . "'" . $id . "'";
        $moderador = $this->database
            ->select(
                "view_moderador",
                "*",
                $where,
                null
            );
        if (count($moderador) === 0){
            throw new AlucException(
                Database::getMgs(
                    5000,
                    $this->getModel()
                ),
                "elemento no existe en la base de datos"
            );
        }
        return $moderador;
    }

    /**
     * Método para obtener todos los moderadores registrados.
     * @param $order_attribute
     * @return mixed
     */
    public function getAll($order_attribute){
        $order_by = null;
        if ($order_attribute != null){
            $order_by =  "order by " . $order_attribute . " asc";
        }
        $list_moderador = $this->database
            ->select(
                "view_moderador",
                "*",
                null,
                $order_by
            );

        return $list_moderador;
    }

    /**
     * Método para eliminar un moderador
     * @param $id
     * @throws AlucException
     */
    public function delete($id){
        $where = "id = " . "'" . $id . "'";
        try{
            $this->database->delete(
                "moderador",
                $where
            );
        }catch (\Exception $e){
            throw new AlucException(
                'El moderador no se puede eliminar',
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
            'clave_foranea' => ['usuario o laboratorio','registrado'],
            'clave_pk_duplicate' => ['moderador'],
            'elemento_null' => ['moderador','registrado']

        ];
    }
}
