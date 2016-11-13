<?php
use PHPUnit\Framework\TestCase;
use Aluc\Dao\Database;

class DatabaseTest extends Testcase {
    public function testConexion() {
        $db = new Database();
        $db->connect();
        $this->assertEmpty($db->error());
    }
}
