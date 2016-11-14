<?php
namespace Aluc\Service;

use Aluc\Views\ModeradorView;
use Aluc\Views\GeneralView;
use Aluc\Tools\Tools;


/**
 * Clase que maneja todas las solicitudes a /admin
 */
class AdministradorSrv {
    private static $view_moderador;
    private static $view_general;

    public static function init() {
        static::$view_moderador = ModeradorView::getInstance();
        static::$view_general = GeneralView::getInstance();
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
                    echo $id . " - " . $laboratorio_id;
                    // TODO: Mandar a crear un moderador
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
