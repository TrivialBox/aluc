<?php
namespace Aluc\Service;

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

    private static function admin_do($func, $view_success, $view_error) {
        $view = null;
        try {
            if (Tools::check_session('admin')) {
                if (Tools::check_method('post')) {
                    $func();
                }
                $view = $view_success();
            } else {
                $view = self::$view_general->error404();
            }
        } catch (\Exception $e) {
            $view = $view_error();
        } finally {
            $view->render();
        }
    }

    private static function admin_go($view_go, $view_error) {
        $view = null;
        try {
            if (Tools::check_session('admin')) {
                $view = $view_go();
            } else {
                $view = self::$view_general->error404();
            }
        } catch (\Exception $e) {
            $view  = $view_error();
        } finally {
            $view->render();
        }
    }

    /**
     * /admin
     *
     * Muestra la página principal del administrador
     * desde la cual tiene acceso a varias herramientas
     * de administración.
     */
    public static function home() {
        self::admin_go(
            function () {
                return self::$view_administrador->home();
            },
            function () {
                return self::$view_general->error404();
            }
        );
    }

    /**
     * /admin/moderadores
     *
     * Muestra una lista de todos los moderadores.
     * Sólo el administrador tiene acceso.
     */
    public static function moderadores() {
        self::admin_go(
            function () {
                return self::$view_moderador->listAll();
            },
            function () {
                return self::$view_general->error404();
            }
        );
    }


    /**
     * /admin/moderadores/nuevo
     *
     * Crea un nuevo moderador.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     */
    public static function moderadores_nuevo() {
        self::admin_do(
            function () {
                $id = Tools::clean_string($_POST['id']);
                $laboratorio_id = Tools::clean_string($_POST['laboratorio_id']);
                $moderador = Moderador::getNewInstace($id, $laboratorio_id);
                $moderador->save();
            },
            function () {
                return self::$view_moderador->listAll();
            },
            function () {
                return self::$view_general->error404();
            }
        );
    }

    /**
     * /admin/moderadores/actualizar
     *
     * Editar la información de un moderador.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     */
    public static function moderadores_actualizar() {
        self::admin_do(
            function () {
                $id = Tools::clean_string($_POST['id']);
                $laboratorio_id = Tools::clean_string($_POST['laboratorio_id']);
                $moderador = Moderador::getInstance($id);
                $moderador->id_laboratorio = $laboratorio_id;
                $moderador->save();
            },
            function () {
                return self::$view_moderador->listAll();
            },
            function () {
                return self::$view_general->error404();
            }
        );
    }


    /**
     * /admin/moderadores/eliminar
     *
     * Elimina un moderador del sistema.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     */
    public static function moderadores_eliminar() {
        self::admin_do(
            function () {
                $id = Tools::clean_string($_POST['id']);
                $moderador = Moderador::getInstance($id);
                $moderador->delete();
            },
            function () {
                return self::$view_moderador->listAll();
            },
            function () {
                return self::$view_general->error404();
            }
        );
    }

    /**
     * /admin/lectores
     *
     * Muestra una lista de todos los lectores QR.
     * Sólo el administrador tiene acceso.
     */
    public static function lectores() {
        self::admin_go(
            function () {
                return self::$view_lector_qr->listAll();
            },
            function () {
                return self::$view_general->error404();
            }
        );
    }


    /**
     * /admin/lectores/nuevo
     *
     * Crea un nuevo lector QR.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     */
    public static function lectores_nuevo() {
        self::admin_do(
            function () {
                $ip = Tools::clean_string($_POST['ip']);
                $mac = Tools::clean_string($_POST['mac']);
                $laboratorio_id = Tools::clean_string($_POST['laboratorio_id']);
                $lector = Lector::getNewInstance($ip, $mac, $laboratorio_id);
                $lector->save();
            },
            function () {
                return self::$view_lector_qr->listAll();
            },
            function () {
                return self::$view_general->error404();
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
     */
    public static function lectores_actualizar() {
        self::admin_do(
            function () {
                $id = Tools::clean_string($_POST['id']);
                $ip = Tools::clean_string($_POST['ip']);
                $mac = Tools::clean_string($_POST['mac']);
                $laboratorio_id = Tools::clean_string($_POST['laboratorio_id']);
                $new_token = strtolower(Tools::clean_string($_POST['new_token'])) === 'true';
                $lector = Lector::getInstance($id);
                $lector->ip = $ip;
                $lector->mac = $mac;
                $lector->laboratorio_id = $laboratorio_id;
                if ($new_token) {
                    $lector->renovarToken();
                }
                $lector->save();
            },
            function () {
                return self::$view_lector_qr->listAll();
            },
            function () {
                return self::$view_general->error404();
            }
        );
    }

    /**
     * Elimina un lector del sistema.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     */
    public static function lectores_eliminar() {
        self::admin_do(
            function () {
                $id = Tools::clean_string($_POST['id']);
                $laboratorio_id = Tools::clean_string($_POST['laboratorio_id']);
                $lector = Lector::getInstance($id, $laboratorio_id);
                $lector->delete();
            },
            function () {
                return self::$view_lector_qr->listAll();
            },
            function () {
                return self::$view_general->error404();
            }
        );
    }
}

AdministradorSrv::init();
