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

    private function assertEqualsObject(Moderador $obj, $values) {
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
     * @expectedException /Exception
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
        $mod_expected['nombre_lab'] = 'Lab. Química';
        $mod_expected['capacidad_lab'] = 20;
        $mod_expected['descripcion_lab'] = 'Laboratorio de química para clases de química.';
        $mod_expected['jornada1'] = new Fecha(null, '07:00:00','13:00:00');
        $mod_expected['jornada2'] = new Fecha(null, '15:30:00', '17:30:00');

        $this->assertEqualsObject($mod_original, $mod_expected);
    }

    public function testGetAllModeradores() {
        $this->createModeradores();
        $num_elements = 0;
        $all_moderadores = $this->getUsers();
        foreach (Moderador::getAll() as $moderador) {
            $this->assertEqualsObject(
                $moderador,
                $all_moderadores[$moderador->id]
            );
            $num_elements++;
        }
        $this->assertEquals(count($all_moderadores), $num_elements);
        $this->deleteModeradores();
    }

    private function createModeradores() {
        foreach ($this->getUsers() as $id => $user) {
            if ($id === '0105751473') {
                continue;
            }
            Moderador::getNewInstace(
                $user['id'],
                $user['id_laboratorio']
            )->save();
        }
    }

    private function deleteModeradores() {
        foreach ($this->getUsers() as $id => $user) {
            if ($id === '0105751473') {
                continue;
            }
            Moderador::getInstance(
                $user['id']
            )->delete();
        }
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

    private function getUsers() {
        return [
            '0105751473' => [
                'id' => '0105751473',
                'nombre' => 'MOYANO DUTÁN JOSÉ ALFREDO',
                'id_laboratorio' => 1,
                'nombre_lab' => 'Lab. Física',
                'capacidad_lab' => 15,
                'descripcion_lab' => 'Laboratorio de física para clases de física.',
                'jornada1' => new Fecha(null, '07:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:00:00', '17:00:00')
            ],
            '0105742811' => [
                'id' => '0105742811',
                'nombre' => 'REA ORELLANA WILLIAM FERNANDO',
                'id_laboratorio' => 2,
                'nombre_lab' => 'Lab. Química',
                'capacidad_lab' => 20,
                'descripcion_lab' => 'Laboratorio de química para clases de química.',
                'jornada1' => new Fecha(null, '07:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:30:00', '17:30:00')
            ],
            '0104429527' => [
                'id' => '0104429527',
                'nombre' => 'SANCHEZ ARIZAGA DAVID FEDERICO',
                'id_laboratorio' => 3,
                'nombre_lab' => 'Lab. Suelos',
                'capacidad_lab' => 10,
                'descripcion_lab' => 'Laboratorio de suelos para los de civil.',
                'jornada1' => new Fecha(null, '09:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:00:00', '17:00:00')
            ],
            '0105631808' => [
                'id' => '0105631808',
                'nombre' => 'RODAS CORREA JUAN CARLOS',
                'id_laboratorio' => 6,
                'nombre_lab' => 'Lab. de python',
                'capacidad_lab' => 10,
                'descripcion_lab' => 'Laboratorio de python, con la ayuda de Guido Van Rossum.',
                'jornada1' => new Fecha(null, '07:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:30:00', '17:30:00')
        ]];
    }

    public function tearDown() {
        Moderador::getInstance($this->getUser()['id'])->delete();
    }
}
