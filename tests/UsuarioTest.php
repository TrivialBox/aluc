<?php
// use PHPUnit\Framework\TestCase;
use Aluc\Modulo\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends Testcase {
    private $usuario;

    public function setUp() {
        $this->usuario = new Usuario("Juan");
    }

    public function testSaludoHola() {
        $esperado = 'Hola Juan';
        $actual = $this->usuario->saludar('Hola');
        $this->assertEquals($actual, $esperado);
    }
}
