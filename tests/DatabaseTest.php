<?php
use Aluc\Dao\Database;

class DatabaseTest extends PHPUnit_Framework_TestCase {
    public function testConexion() {
        $db = new Database();
        $db->connect();
    }
}
