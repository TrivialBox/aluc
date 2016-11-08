<?php
namespace Aluc\Modulo;

class Usuario
{
    private $nombre;

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    public function saludar($saludo) {
        return "{$saludo} {$this->nombre}";
    }
}
