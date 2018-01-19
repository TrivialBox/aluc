<?php



namespace Aluc\Dao;

/**
 * Clase para para manejo de base de datos de los administradores.
 */
class AdministradorDao{
    private $data_base;
    private static $instance = null;

    private function __construct(){
        $this->data_base = new Database();
        $this->data_base->connect();
    }

    /**
     * Método para obtener la instancia de la clase.
     * @return $instance
     */
    public static function getInstance(){
        if (static::$instance == null){
            static::$instance = new self();
        }
        return static::$instance;
    }

    /**
     * Método para obtener un administrador pasando su id.
     * @param $id
     * @return administrador
     */
    public function get($id){
        $where = "id = " . "'" . $id . "'";
        $admin = $this->database
            ->select(
                "view_administador",
                "*",
                $where,
                null
            );
        if (count($admin) === 0){
            throw new AlucException(
                Database::getMgs(
                    5000,
                    $this->getModel()
                ),
                "el administrador no se encuentra en la base de datos"
            );
        }
        return $admin;
    }

    /**
     * Método para obtener una lista de todos los administradores registrados
     * en la base de datos.
     * @param $order_attribute
     * @return lista_administradores
     */
    public function getAll($order_attribute){
        $order_by = null;

        if ($order_attribute != null) {
            $order_by = "order by " . $order_attribute . " asc";
        }
        $list_admin = $this->database
            ->select(
                "administrador",
                "*",
                null,
                $order_by
            );

        return $list_admin;
    }

    private function getModel(){
        return [
            'elemento_null' => ['Administrador','registrado']

        ];
    }
}
