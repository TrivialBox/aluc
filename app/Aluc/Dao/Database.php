<?php
namespace Aluc\Dao;

define('CONFIG_FILE', __DIR__ . '/../../../config/database.json');

/**
 *
 */
class Database {
    private $host;
    private $user;
    private $pass;
    private $name;
    private $port;

    private $conn;

    public function __construct() {
        $this->load_configuration();
    }

    private function load_configuration() {
        $json_file = file_get_contents(CONFIG_FILE);
        $config = json_decode($json_file, true);

        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->pass = $config['pass'];
        $this->name = $config['name'];
        $this->port = $config['port'];
    }

    public function connect() {
        $this->conn = new \mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->name,
            $this->port
        );
        if ($this->conn->connect_error) {
            throw new \Exception(
                "Conexión fallida. {$this->conn->connect_error}"
            );
        }
    }

    public function disconnect() {
        if (isset($this->conn)) {
            $this->conn->close();
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function error() {
        return $this->conn->error;
    }

    public function insert($table_name, $values) {
        $items = $this->cat_values($values);
        $values = implode(',', $items['values']);
        $keys = implode(',', $items['keys']);
        $sql = "INSERT INTO {$table_name}
                ({$keys}) VALUES ({$values})";

        if (!$this->query($sql)) {
            throw new \Exception(
                "Error al insertar {$values}. {$this->error()}"
            );
        }
    }

    private function cat_values($array) {
        // TODO sanitizar consulta
        $keys = array_keys($array);
        $values = array();
        foreach (array_values($array) as $value) {
            $values[] = "'{$value}'";
        }
        return array(
            'keys' => $keys,
            'values' => $values
        );
    }

    public function select() {
    }

    public function delete() {
    }

    public function update() {
    }
}
