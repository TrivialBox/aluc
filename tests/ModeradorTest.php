<?php
use Aluc\Models\Fecha;
use PHPUnit\Framework\TestCase;
use Aluc\Models\Moderador;


class ModeradorTest extends TestCase {
    private $moderador;

    public function setUp() {
        $user = $this->getUser();
        $this->moderador = Moderador::getNewInstace(
            $user['id'],
            $user['id_laboratorio']
        )->save();
    }

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
        self::assertEquals($horario->jornada1, $values['jornada1']);
        self::assertEquals($horario->jornada2, $values['jornada2']);
    }

    public function testCreateValidModerador() {
        $expected = $this->getUser();
        $actual = $this->moderador;
        $this->assertEqualsObject($actual, $expected);
    }


    /**
     * @expectedException Exception
    */
    public function testCreateInvalidModerador() {
        Moderador::getNewInstace('1d3n0v1l1d0', '2');
    }

    public function testEditModerador() {
        $mod_original = Moderador::getInstance($this->getUser()['id']);
        $mod_original->id_laboratorio = '2';
        $mod_original->save();

        $mod_original = Moderador::getInstance($this->getUser()['id']);

        $mod_expected = $this->getUser();
        $mod_expected['id_laboratorio'] = '2';

        $this->assertEqualsObject($mod_original, $mod_expected);
    }

    private function getUser() {
        return [
            'id' => '0105751473',
            'nombre' => 'MOYANO DUTÁN JOSÉ ALFREDO',
            'id_laboratorio' => 1,
            'nombre_lab' => 'Lab. Física',
            'capacidad_lab' => 15,
            'descripcion_lab' => 'Laboratorio de física para clases de física.',
            'jornada1' => new Fecha(null, '07:00:00', '13:00:00'),
            'jornada2' => new Fecha(null, '15:00:00', '17:00:00')
        ];
    }

    public function tearDown() {
        Moderador::getInstance($this->getUser()['id'])->delete();
    }
}
