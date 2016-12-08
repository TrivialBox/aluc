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
            if (Tools::check_session('admin', 'moderador', 'user', 'profesor')) {
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
                if (!empty($data) and Tools::check_method('get')) {
                    $type = $data['type'];
                    $lab_id = $data['laboratorio_id'];
                    $user_id = $_SESSION['id'];
                    self::$view_reserva
                        ->listReservasUsuario($user_id, $lab_id, $type)
                        ->render();
                } else {
                    self::$view_reserva
                        ->home()
                        ->render();
                }
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
                    $tipo_uso = Tools::check_session('profesor') ? $data['tipo_uso'] : 'práctica';
                    $numero_usuarios = $data['numero_usuarios'];
                    $fecha = Tools::getCanonicalFecha($data['fecha']);
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
                        ->listReserva($reserva->getId())
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
     * /reservas/cancelar
     *
     * Cancela una reserva.
     * El usuario debe estar logeado para
     * realizar esta acción, se realiza una
     * solicitud vía post.
     */
    public static function cancelar($data) {
        self::user_do(
            function () use ($data) {
                if (!empty($data) and Tools::check_method('post')) {
                    $id = $data['id'];
                    $reserva = Reserva::getInstance($id);
                    if (Tools::check_session('moderador', 'admin') ||
                        (Tools::check_session('user') and $reserva->getUsuarioId() === $_SESSION['id'])
                    ) {
                        $reserva->cancelar();
                        self::$view_general
                            ->success_json()
                            ->render();
                    } else {
                        self::$view_general
                            ->error404()
                            ->render();
                    }
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
     * /reservas/codigo-qr
     *
     * Obtiene el código qr de una
     * reserva, se realiza una solicitud vía
     * get.
     */
    public static function codigo_qr($data) {
        self::user_do(
            function () use ($data) {
                if (!empty($data) and Tools::check_method('get')) {
                    $id = $data['id'];
                    $reserva = Reserva::getInstance($id);
                    if (Tools::check_session('moderador', 'admin') ||
                        (Tools::check_session('user', 'profesor') and $reserva->getUsuarioId() === $_SESSION['id'])
                    ) {
                        self::$view_reserva
                            ->codigo_qr($reserva)
                            ->render();
                    } else {
                        self::$view_general
                            ->error404()
                            ->render();
                    }
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
     * /reservas/verificar
     *
     * Verifica una reservación
     * mediante un lector qr ubicado
     * en el laboratorio. Esta acción
     * sólo la puede hacer un lector QR
     * registrado.Se realiza una
     * solicitud vía post.
     */
    public static function verificar($data) {
        try {
            if (!empty($data) and Tools::check_method('post')) {
                $mac = $data['mac'];
                $ip = Tools::get_ip();
                $token = $data['token'];
                $secret_code = $data['secret_code'];
                Reserva::validarQr($mac, $ip, $token, $secret_code);
                self::$view_general
                    ->success_json("Reserva verificada con éxito.")
                    ->render();
            } else {
                self::$view_general
                    ->error404()
                    ->render();
            }
        } catch (\Exception $e) {
            self::$view_general
                ->error_json_default($e)
                ->render();
        }
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
            '/^codigo-qr\/$/i' => "{$class_name}::codigo_qr",
            '/^filtrar\/$/i' => "{$class_name}::filtrar"
        ];
    }
}

ReservasSrv::init();
