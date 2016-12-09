<?php
namespace Aluc\Service;

use Aluc\Views\LaboratorioView;
use Aluc\Views\GeneralView;
use Aluc\Common\Tools;

class LaboratorioSrv {
    private static $view_laboratorio;
    private static $view_general;

    public static function init() {
        static::$view_laboratorio = LaboratorioView::getInstance();
        static::$view_general = GeneralView::getInstance();
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

    public static function show($data) {
        self::user_do(
            function () use ($data){
                if (!empty($data) and Tools::check_method('post')) {
                    $lab_id = $data['laboratorio_id'];
                    self::$view_laboratorio
                        ->show($lab_id)
                        ->render();
                } else {
                    self::$view_general
                        ->error404()
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
     * URLS para el direccionamiento (url routing).
     * @return array
     */
    public static function urls() {
        $class_name =  __CLASS__;
        return [
            '/^$/i' => "{$class_name}::show"
        ];
    }
}

LaboratorioSrv::init();

