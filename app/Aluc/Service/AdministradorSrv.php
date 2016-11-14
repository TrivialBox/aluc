<?php
namespace Aluc\Service;

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

    public static function init() {
        static::$view_moderador = ModeradorView::getInstance();
        static::$view_general = GeneralView::getInstance();
        static::$view_lector_qr = LectorQrView::getInstance();
    }

    public static function home() {
        // página principal del administrador
    }

    /**
     * /admin/moderadores
     *
     * Muestra una lista de todos los moderadores.
     * Sólo el administrador tiene acceso.
     */
    public static function moderadores() {
        $view = null;
        try {
            if (Tools::check_session('admin')) {
                $view = self::$view_moderador->listAll();
            } else {
                $view = self::$view_general->error404();
            }
        } catch (\Exception $e) {
            $view  = self::$view_general->error404();
        } finally {
            $view->render();
        }
    }


    /**
     * /admin/moderadores/nuevo
     *
     * Crea un nuevo moderador.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     */
    public static function moderadores_nuevo() {
        $view = null;
        try {
            if (Tools::check_session('admin')) {
                if (Tools::check_method('post')) {
                    $id = Tools::clean_string($_POST['id']);
                    $laboratorio_id = Tools::clean_string($_POST['laboratorio_id']);
                    $moderador = Moderador::getNewInstace($id, $laboratorio_id);
                    $moderador->save();
                }
                $view = self::$view_moderador->listAll();
            } else {
                $view = self::$view_general->error404();
            }
        } catch (\Exception $e) {
            $view = self::$view_general->error404();
        } finally {
            $view->render();
        }
    }


    /**
     * /admin/lectores
     *
     * Muestra una lista de todos los lectores QR.
     * Sólo el administrador tiene acceso.
     */
    public static function lectores() {
        $view = null;
        try {
            if (Tools::check_session('admin')) {
                $view = self::$view_lector_qr->listAll();
            } else {
                $view = self::$view_general->error404();
            }
        } catch (\Exception $e) {
            $view = self::$view_general->error404();
        } finally {
            $view->render();
        }
    }


    /**
     * /admin/lectores/nuevo
     *
     * Crea un nuevo lector QR.
     * La petición se debe hacer vía post.
     * Sólo un administrador puede realizar esta acción.
     */
    public static function lectores_nuevo() {
        $view = null;
        try {
            if (Tools::check_session('admin')) {
                if (Tools::check_method('post')) {
                    $ip = Tools::clean_string($_POST['ip']);
                    $mac = Tools::clean_string($_POST['mac']);
                    $laboratorio_id = Tools::clean_string($_POST['laboratorio_id']);
                    $lector = Lector::getNewInstance($ip, $mac, $laboratorio_id);
                    $lector->save();
                }
                $view = self::$view_moderador->listAll();
            } else {
                $view = self::$view_general->error404();
            }
        } catch (\Exception $e) {
            $view = self::$view_general->error404();
        } finally {
            $view->render();
        }
    }
}

AdministradorSrv::init();
