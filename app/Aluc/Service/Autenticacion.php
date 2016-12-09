<?php
namespace Aluc\Service;

use Aluc\Common\TemplateGenerator;
use Aluc\Common\Urls;
use Aluc\Common\Tools;


class Autenticacion {
    private static $view_general;
    private static $view_login;

    public static function init() {
        static::$view_general = GeneralView::getInstance();
        static::$view_login = LoginView::getInstance();
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

    public static function login($data) {
        try {
            if (!isset($_SESSION['id']) && Tools::check_method('post')) {
                $_SESSION['id'] = '1400567572';
                $_SESSION['type'] = 'moderador';  // admin, moderador, user, profesor
                Urls::redirect('/');
            } else if (isset($_SESSION['id'])) {
                Urls::redirect('/');
            } else {
                TemplateGenerator::generate([], 'login.php');
            }
        } catch (\Exception $e) {
            self::$view_general
                ->error404()
                ->render();
        }
    }

    public static function logout($data) {
        self::user_do(
            function () use ($data) {
                session_unset();
                session_destroy();
                Urls::redirect('/');
            },
            function ($e) {
                self::$view_general
                    ->error404()
                    ->render();
            }
        );
    }
}

