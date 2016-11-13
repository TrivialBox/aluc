<?php
use Aluc\Dao\Database;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends Testcase {
    public function testConexion() {
        $db = new Database();
        $db->connect();
        $this->assertEmpty($db->error());
    }
}
