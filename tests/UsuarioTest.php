<?php
use PHPUnit\Framework\TestCase;
use Aluc\Modulo\Usuario as Usuario;

class UsuarioTest extends TestCase {
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
?>
