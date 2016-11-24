<?php
namespace Aluc\Service;

use Aluc\Common\Tools;
use Aluc\Models\Reserva;
use Aluc\Views\GeneralView;
use Aluc\Views\ReservaView;

/**
 * Clase que maneja todas las solicitudes a /reservas
 */
class ReservasSrv {
    private static $view_general;
    private static $view_reserva;

    public static function init() {
        static::$view_general = GeneralView::getInstance();
        static::$view_reserva = ReservaView::getInstance();
    }

    private static function user_do($func, $error) {
        try {
            if (Tools::check_session('admin', 'moderador', 'user')) {
                $func();
            } else {
                ErrorSrv::redirect404();
            }
        } catch (\Exception $e) {
            $error($e);
        }
    }

    /**
     * /reservas
     *
     * Muestra la página principal de las reservas
     * donde se listan las reservas actuales de un
     * usuario (en caso de entrar como usuario)
     * o las reservas de todos (en caso de entrar
     * como moderador o administrador).
     * @param $data
     */
    public static function home($data) {
        self::user_do(
            function () use ($data){
                self::$view_reserva
                    ->home()
                    ->render();
            },
            function ($e) {
                self::$view_general
                    ->error404()
                    ->render();
            }
        );
    }

    /**
     * /reservas/nueva
     *
     * Crea una nueva reserva.
     * El usuario debe estar logeado para
     * realizar la reserva, se realiza una
     * solicitud vía post.
     */
    public static function nueva($data) {
        self::user_do(
            function () use ($data) {
                if (!empty($data) and Tools::check_method('post')) {
                    $id_laboratorio = $data['id_laboratorio'];
                    $tipo_uso = $_SESSION['type'] === 'profesor' ? $data['tipo_uso'] : 'practica';
                    $numero_usuarios = $data['numero_usuarios'];
                    $fecha = $data['fecha'];
                    $hora_inicio = $data['hora_inicio'];
                    $hora_fin = $data['hora_fin'];
                    $descripcion = $data['descripcion'];
                    $usuario_id = $_SESSION['id'];
                    $reserva = Reserva::getNewInstance(
                        $usuario_id, $id_laboratorio,
                        $fecha, $hora_inicio, $hora_fin,
                        $descripcion, $numero_usuarios,
                        $tipo_uso
                    )->save();
                    self::$view_reserva
                        ->listReserva($reserva->id)
                        ->render();
                } else {
                    self::$view_general
                        ->error404()
                        ->render();
                }
            },
            function ($e) {
                self::$view_general
                    ->error_json_default($e)
                    ->render();
            }
        );
    }

    /**
     * URLS para el direccionamiento (url routing).
     * @return array
     */
    public static function urls() {
        $class_name =  __CLASS__;
        return [
            '/^$/i' => "{$class_name}::home",
            '/^nueva\/$/i' => "{$class_name}::nueva",
            '/^actualizar\/$/i' => "{$class_name}::actualizar",
            '/^cancelar\/$/i' => "{$class_name}::cancelar",
            '/^verificar\/$/i' => "{$class_name}::verificar",
            '/^filtrar\/$/i' => "{$class_name}::filtrar",
        ];
    }
}

ReservasSrv::init();
