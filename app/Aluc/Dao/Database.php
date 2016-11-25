<?php
namespace Aluc\Dao;

define('CONFIG_FILE', __DIR__ . '/../../../config/database.json');

/**
 * Clase para interactuar con la base de datos.
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
    function __destruct(){
        $this->disconnect();
    }

    public function connect() {
        $this->conn = new \mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->name,
            $this->port
        );
        $this->conn->set_charset("utf8");
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

    private function query($sql) {
        return $this->conn->query($sql);
    }

    public function error() {
        return $this->conn->error;
    }

    public function errno() {
        return $this->conn->errno;
    }

    public function call($procedure_name, $values) {
        $items = $this->quote_array_string($values);
        $values = implode(',', $items);

        $sql = "CALL {$procedure_name}({$values})";
        if (!$this->query($sql)) {
            throw new \Exception(
                $this->error(),
                $this->errno()
            );
        }
    }

    public function insert($table_name, $values) {
        $items = $this->catValues($values);
        $keys = implode(',', $items['keys']);
        $values = implode(',', $items['values']);
        $sql = "INSERT INTO {$table_name} ({$keys}) VALUES ({$values})";
        if (!$this->query($sql)) {
            throw new \Exception(
                "Error al insertar {$values}. {$this->error()}",
                $this->errno()
            );
        }
    }

    private function catValues($array) {
        $keys = array_keys($array);
        $values = $this->quote_array_string(array_values($array));
        return array(
            'keys' => $keys,
            'values' => $values
        );
    }

    private function quote_array_string($array) {
        $values = array();
        foreach ($array as $value) {
            $values[] = $this->quote_string($value);
        }
        return $values;
    }

    private function quote_string($string) {
        return "'{$string}'";
    }

    public function select($table_name, $columns = '*', $where = null, $order = null) {
        if ($columns !== '*') {
            $columns = implode(',', $columns);
        }
        $sql = "SELECT {$columns} FROM {$table_name}";

        if ($where != null) {
            $sql .= " WHERE {$where}";
        }

        if ($order != null) {
            $sql .= " ORDER BY {$order}";
        }

        $result = $this->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function delete($view_name, $where) {
        $sql = "DELETE FROM {$view_name} WHERE {$where}";
        if (!$this->query($sql)) {
            throw new \Exception(
                "Error al eliminar {$this->error()}",
                $this->errno()
            );
        }
    }

    public function update($view_name, $columns, $where) {
        $sql = "UPDATE {$view_name}";
        $columns_set = array();
        foreach ($columns as $key => $value){
            array_push($columns_set,$key . '=' . $this->quote_string($value));
        }
        $sql .= " SET " . implode(',', $columns_set);
        $sql .= " WHERE {$where}";
        if (!$this->query($sql)) {
            throw new \Exception(
                $this->error(),
                $this->errno()
            );
        }
    }

    public static function getMgs($code, $data) {
        switch ($code) {
            // Clave foránea no existente
            case 1452:
                return "El {$data['clave_foranea'][0]} no se encuentra {$data['clave_foranea'][1]}";
            // clave primaria duplicada
            case 1062:
                return "El {$data['clave_pk_duplicate'][0]} ya existe";
            //cuando un elemento no se encuentra registrado en la base de datos.
            case 5000:
                return "El {$data['elemento_null'][0]} no se encuentra {$data['elemento_null'][1]}";
            default:
                return "No se puede agregar su {$data['clave_pk_duplicate'][0]}";
        }
    }




}
