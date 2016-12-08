<?php

namespace Aluc\Dao;


use Aluc\Common\AlucException;

/**
 * Clase para para manejo de base de datos de las reservas
 */
class ReservaDao
{
    private $database;
    private static $instance = null;


    /**
     * ReservaDao constructor.
     */
    private function __construct()
    {
        $this->database = new Database();
        $this->database->connect();
    }

    /**
     * Obtener la instancia de la clase.
     * @return null
     */
    public static function getInstance()
    {
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
    public static function convertObjectArray(
        $object
    )
    {
        $array = [
            'id_usuario' => $object->getUsuarioId(),
            'id_laboratorio' => $object->laboratorio_id,
            'descripcion' => $object->descripcion,
            'n_usuarios' => $object->numero_usuarios,
            'tipo_uso' => $object->tipo_uso,
            'estado' => $object->estado,
            'fecha' => $object->getFecha()->fecha,
            'hora_inicio' => $object->getFecha()->hora_inicio,
            'hora_fin' => $object->getFecha()->hora_fin,
            'codigo_secreto' => $object->getCodigoSecreto()
        ];
        return $array;
    }

    /**
     * Método para convertir un objeto en array asociativo
     * con parámetros en específico.
     * @param $object
     * @return array
     */
    public static function convertEditarReserva(
        $object
    )
    {
        $array = [
            'id' => $object->getId(),
            'id_laboratorio' => $object->laboratorio_id,
            'descripcion' => $object->descripcion,
            'n_usuarios' => $object->numero_usuarios,
            'tipo_uso' => $object->tipo_uso,
            'fecha' => $object->getFecha()->fecha,
            'hora_inicio' => $object->getFecha()->hora_inicio,
            'hora_fin' => $object->getFecha()->hora_fin,
        ];
        return $array;
    }

    /**
     * Método genérico para generar excepciones.
     * @param $e
     * @throws AlucException
     */
    public static function generarExcepcion(
        $e
    )
    {
        $error = $e->getMessage();
        if (strval(intval($error)) !== $error) {

            throw new AlucException(Database::getMgs(
                $e->getCode(), static::getModel()),
                $e->getMessage()
            );
        }
        $mensaje = self::getMsgInsert((int)$e->getMessage());
        throw new AlucException(
            $mensaje,
            $e->getMessage()
        );
    }

    /**
     * Él método save cumple dos funciones, insertar y actualizar
     * en la base de datos, dependiendo del parámetro $is_save.
     * @param $object
     * @param bool $type_save
     */
    public function save(
        $object,
        $type_save = true
    )
    {
        try {
            if ($type_save) {
                $this->database->call(
                    'insertar_reserva',
                    static::convertObjectArray($object)
                );
            } else {
                $this->database->call(
                    'editar_reserva',
                    static::convertEditarReserva($object)
                );

            }
        } catch (\Exception $e) {
            $this->generarExcepcion($e);
        }
    }

    /**
     * Método para obtener reservas pasadas (canceladas, canceladas_ausencia,
     * procesado), pasando como parámetro usuario_id o laboratorio_id.
     * @param $usuario_id
     * @param $laboratorio_id
     * @return mixed
     */
    public function getReservaPasadas(
        $usuario_id,
        $laboratorio_id
    )
    {
        $where = "";
        if ($usuario_id != null) {
            $where .= " id_usuario = '{$usuario_id}' and ";

        }
        if ($laboratorio_id != null) {
            $where .= " id_laboratorio = '{$laboratorio_id}' and ";
        }


        $where .= " estado != 'reservado' ORDER BY fecha DESC";

        $reservas = $this->database->select(
            'view_reserva',
            '*',
            $where
        );
        return $reservas;
    }


    /**
     * Método para obtener reservas.
     * @param null $usuario_id
     * @param null $estado
     * @param null $id
     * @param null $laboratorio_id
     * @return mixed
     */
    public function get(
        $usuario_id = null,
        $estado = null,
        $id = null,
        $laboratorio_id = null
    )
    {
        $where = self::getWhere(
            $usuario_id,
            $estado,
            $id,
            $laboratorio_id
        );

        $reservas = $this->database->select(
            'view_reserva',
            '*',
            $where,
            'fecha asc'
        );

        return $reservas;
    }

    /**
     * Método para obtener todos las reservas registradas.
     * @param $order_attribute
     * @return mixed
     */
    public function getAll(
        $order_attribute
    )
    {
        $order_by = null;

        if ($order_attribute != null) {
            $order_by = "order by " . $order_attribute . " asc";
        }
        $list_reservas = $this->database
            ->select(
                "view_reserva",
                "*",
                null,
                $order_by
            );

        return $list_reservas;
    }

    /**
     * Método para actualizar el estado de una reserva.
     * @param $object
     */
    public function updateEstado(
        $object
    )
    {
        try {

            $where = " id_reserva = '{$object->getId()}'";
            $array = [
                'estado' => $object->estado
            ];
            $this->database->update(
                'reservacion',
                $array,
                $where
            );
        } catch (\Exception $e) {
            self::generarExcepcion($e);
        }
    }

    /**
     * Método para obtener el id de reserva de un token específico.
     * @param $token
     * @return mixed
     * @throws AlucException
     */
    public function getRservaToken(
        $token
    )
    {
        $where = "codigo_secreto = '{$token}'";

        $reserva = $this->database
            ->select(
                'reserva',
                ['id'],
                $where, null
            );

        if (count($reserva) == 0) {
            throw new AlucException(
                'No se encuentra registrada la reserva',
                'No se ha encontrado en la base de datos el token'
            );
        }
        return $reserva;
    }

    public function getEstado(
        $id
    )
    {
        try {
            $where = " id_reserva = '{$id}'";
            $array = [
                'estado'
            ];
            return $this->database->select(
                'reservacion',
                $array,
                $where
            );

        } catch (\Exception $e) {
            self::generarExcepcion($e);
        }
    }

    /**
     * Método para procesar reserva, cuando el usuario acceda ha su
     * reserva el estado de la misma pasa ha procesada.
     * @param $id
     */
    public function procesarReserva(
        $id
    )
    {
        try {
            $where = " id_reserva = '{$id}'";
            $array = [
                'estado' => 'procesado'
            ];
            $this->database->update(
                'reservacion',
                $array,
                $where
            );
        } catch (\Exception $e) {
            self::generarExcepcion($e);
        }
    }

    /**
     * Método para generar el where del método get().
     * @param null $usuario_id
     * @param null $estado
     * @param null $id
     * @param null $laboratorio_id
     * @return string
     */
    private static function getWhere(
        $usuario_id = null,
        $estado = null,
        $id = null,
        $laboratorio_id = null
    )
    {
        $where = "";
        if ($usuario_id != null) {
            $where .= "id_usuario = '{$usuario_id}'";
        }

        if ($id != null) {
            $where .= "id = '{$id}'";
        }

        if ($laboratorio_id != null) {
            $where .= " id_laboratorio = '{$laboratorio_id}'";
        }

        if ($estado != null) {
            $where .= " and estado = '{$estado}'";
        }

        return $where;
    }

    /**
     * Método para armar códigos de errores de la clase.
     * @return array
     */
    private static function getModel()
    {
        return [
            'clave_foranea' => ['Usuario o laboratorio', 'registrado'],
            'clave_pk_duplicate' => ['Usuario'],
            'elemento_null' => ['Usuario', 'registrado']

        ];
    }

    /**
     * Método para armar códigos especiales de la base de datos.
     * @param $code
     * @return string
     */
    private static function getMsgInsert(
        $code
    )
    {
        switch ($code) {
            case 1452:
                return "El laboratorio no se encuentra registrado.";
            case 50000:
                return "En la hora que quiere realizar su reserva el laboratorio se encuentra en horario de clases.";
            case 60000:
                return "En la hora que quiere realizar su reserva el laboratorio no se encuentra en hora de apertura.";
            case 70000:
                return "Tiene un máximo de dos horas diarias, limite excedido!.";
            case 80000:
                return "El laboratorio tiene una capacidad, limite excedido!.";
            case 90000:
                return "Solo se pueden hacer reservas pasado un rango de 5 días máximo.";
            case 100000:
                return "En la fecha que quiere realizar su reserva es anterior a la actual.";
            case 110000:
                return "Su reserva se encuentra cancelada.";
            case 120000:
                return "No se puede sobre escribir una reserva con el mismo usuario.";
            case 130000:
                return "La hora de final de la reseva tiene que ser mayor a la de inicio.";
            default:
                return "Ha ocurrido un error, disculpas por lo acontecido!.";
        }
    }


}
