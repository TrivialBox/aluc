<?php
namespace Aluc\Dao;

class ModeradorDao {
    private $database;
    private static $instance;

    protected function __construct() {
        $this->database = new Database();
    }

    public static function getInstance() {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
