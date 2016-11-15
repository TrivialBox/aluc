<?php
use Aluc\Models\Fecha;
use PHPUnit\Framework\TestCase;
use Aluc\Models\Moderador;

class ModeradorTest extends TestCase {

    public function assertEqualsObject(Moderador $obj, $values) {
        $lab = $obj->getLaboratorio();
        $horario = $lab->horario;
        self::assertEquals($obj->id, $values['id']);
        self::assertEquals($obj->nombre, $values['nombre']);
        self::assertEquals($obj->id_laboratorio, $values['id_laboratorio']);
        self::assertEquals($lab->id, $values['id_laboratorio']);
        self::assertEquals($lab->nombre, $values['nombre_lab']);
        self::assertEquals($lab->capacidad, $values['capacidad_lab']);
        self::assertEquals($lab->descripcion, $values['descripcion_lab']);
        self::assertEquals($horario->jornada1, $values['joranada1']);
        self::assertEquals($horario->jornada2, $values['joranada2']);
    }

    public function testCreateValidModerador() {
        $expected = $this->getUser();
        $actual = Moderador::getNewInstace(
            $expected['id'],
            $expected['id_laboratorio']
        )->save();
        $this->assertEqualsObject($actual, $expected);
    }

    private function getUser() {
        return [
            'id' => '0105751473',
            'nombre' => 'MOYANO DUTÁN JOSÉ ALFREDO',
            'id_laboratorio' => 0,
            'nombre_lab' => 'Lab. Física',
            'capacidad_lab' => 15,
            'descripcion_lab' => 'Laboratorio de física para clases de física.',
            'jornada1' => new Fecha(null, '07:00', '13:00'),
            'jornada2' => new Fecha(null, '15:00', '17:00')
        ];
    }
}
