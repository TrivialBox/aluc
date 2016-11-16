<?php
namespace Aluc\Service;

use Aluc\Models\Lector;
use Aluc\Models\Moderador;
use Aluc\Views\AdministradorView;
use Aluc\Views\LectorQrView;
use Aluc\Views\ModeradorView;
use Aluc\Views\GeneralView;
use Aluc\Tools\Tools;


/**
 * Clase que maneja todas las solicitudes a /admin
 */
class AdministradorSrv {
    private static $view_moderador;
    private static $view_general;
    private static $view_lector_qr;
    private static $view_administrador;

    public static function init() {
        static::$view_moderador = ModeradorView::getInstance();
        static::$view_general = GeneralView::getInstance();
        static::$view_lector_qr = LectorQrView::getInstance();
        static::$view_administrador = AdministradorView::getInstance();
    }

    private static function admin_do($func, $error) {
        try {
            if (Tools::check_session('admin')) {
                $func();
            } else {
                self::$view_general
                    ->error404()
                    ->render();
            }
        } catch (\Exception $e) {
            $error($e);
        }
    }

    /**
     * /admin
     *
     * Muestra la página principal del administrador
     * desde la cual tiene acceso a varias herramientas
     * de administración.
     * @param $data
     */
    public static function home($data) {
        self::admin_do(
            function () use ($data){
                self::$view_administrador
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
     * /admin/moderadores
     *
     * Muestra una lista de todos los moderadores.
     * Sólo el administrador tiene acceso.
     * @param $data
     */
    public static function moderadores($data) {
        self::admin_do(
            function () use ($data) {
                self::$view_moderador
                    ->listAll()
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
     * /admin/moderadores/nuevo
     *
     * Crea un nuevo moderador.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     * @param $data
     */
    public static function moderadores_nuevo($data) {
        self::admin_do (
            function () use ($data) {
                if (!empty($data) and Tools::check_method('post')) {
                    $id = $data['id'];
                    $laboratorio_id = $data['laboratorio_id'];
                    $moderador = Moderador::getNewInstace($id, $laboratorio_id);
                    $moderador->save();
                }
                self::$view_moderador
                    ->listAll()
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
     * /admin/moderadores/actualizar
     *
     * Editar la información de un moderador.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     * @param $data
     */
    public static function moderadores_actualizar($data) {
        self::admin_do(
            function () use ($data) {
                if (!empty($data) and Tools::check_method('post')) {
                    $id = $data['id'];
                    $laboratorio_id = $data['laboratorio_id'];
                    $moderador = Moderador::getInstance($id);
                    $moderador->id_laboratorio = $laboratorio_id;
                    $moderador->save();
                }
                self::$view_moderador
                    ->listAll()
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
     * /admin/moderadores/eliminar
     *
     * Elimina un moderador del sistema.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     * @param $data
     */
    public static function moderadores_eliminar($data) {
        self::admin_do(
            function () use ($data) {
                if (!empty($data) and Tools::check_method('post')) {
                    $id = $data['id'];
                    $moderador = Moderador::getInstance($id);
                    $moderador->delete();
                }
                self::$view_moderador
                    ->listAll()
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
     * /admin/lectores
     *
     * Muestra una lista de todos los lectores QR.
     * Sólo el administrador tiene acceso.
     * @param $data
     */
    public static function lectores($data) {
        self::admin_do(
            function () use ($data) {
                self::$view_lector_qr
                    ->listAll()
                    ->render();
            },
            function () {
                self::$view_general
                    ->error404()
                    ->render();
            }
        );
    }


    /**
     * /admin/lectores/nuevo
     *
     * Crea un nuevo lector QR.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     * @param $data
     */
    public static function lectores_nuevo($data) {
        self::admin_do(
            function () use ($data) {
                if (!empty($data) and Tools::check_method('post')) {
                    $ip = $data['ip'];
                    $mac = $data['mac'];
                    $laboratorio_id = $data['laboratorio_id'];
                    $lector = Lector::getNewInstance($ip, $mac, $laboratorio_id);
                    $lector->save();
                }
                self::$view_lector_qr
                    ->listAll()
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
     * /admin/lectores/actualizar
     *
     * Edita la información de un lector.
     * Si el valor de new_token es true se genera un nuevo
     * token para el lector.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     * @param $data
     */
    public static function lectores_actualizar($data) {
        self::admin_do(
            function () use ($data) {
                if (!empty($data) and Tools::check_method('post')) {
                    $id = $data['id'];
                    $ip = $data['ip'];
                    $mac = $data['mac'];
                    $laboratorio_id = $data['laboratorio_id'];
                    $new_token = strtolower($data['new_token']) === 'true';
                    $lector = Lector::getInstance($id);
                    $lector->ip = $ip;
                    $lector->mac = $mac;
                    $lector->laboratorio_id = $laboratorio_id;
                    if ($new_token) {
                        $lector->renovarToken();
                    }
                    $lector->save();
                }
                self::$view_lector_qr
                    ->listAll()
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
     * Elimina un lector del sistema.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     * @param $data
     */
    public static function lectores_eliminar($data) {
        self::admin_do(
            function () use ($data) {
                if (!empty($data) and Tools::check_method('post')) {
                    $id = $data['id'];
                    $laboratorio_id = $data['laboratorio_id'];
                    $lector = Lector::getInstance($id, $laboratorio_id);
                    $lector->delete();
                }
                self::$view_lector_qr
                    ->listAll()
                    ->render();
            },
            function () {
                self::$view_general
                    ->error404()
                    ->render();
            }
        );
    }
}

AdministradorSrv::init();
