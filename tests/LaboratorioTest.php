<?php
use Aluc\Models\Fecha;
use Aluc\Models\Laboratorio;
use Aluc\Models\Moderador;
use PHPUnit\Framework\TestCase;


class LaboratorioTest extends TestCase {

    private function assertEqualsObject(Laboratorio $obj, $values) {
        $horario = $obj->horario;
        self::assertEquals($obj->id, $values['id_laboratorio']);
        self::assertEquals($obj->nombre, $values['nombre_lab']);
        self::assertEquals($obj->capacidad, $values['capacidad_lab']);
        self::assertEquals($obj->descripcion, $values['descripcion_lab']);
        self::assertEquals($horario->jornada1, $values['jornada1']);
        self::assertEquals($horario->jornada2, $values['jornada2']);
    }

    public function testGetValidLaboratorio() {
        Laboratorio::getInstance('6');
    }

    /**
     * @expectedException Exception
     */
    public function testGetInvalidLaboratorio() {
        Laboratorio::getInstance('10');
    }

    public function testGetAllLaboratorios() {
        $laboratorios = $this->getLabs();
        foreach (Laboratorio::getAll() as $laboratorio) {
            $this->assertEqualsObject(
                $laboratorio,
                $laboratorios[$laboratorio->id]
            );
        }
    }

    public function testGetModeradores() {
        try {
            $lab_id = 6;
            $this->createModeradoresForLab($lab_id);
            $laboratorio = Laboratorio::getInstance($lab_id);
            $moderadores = $laboratorio->getModeradores();
            $usuarios = ModeradorTest::getUsers();
            $this->assertEquals(
                count($moderadores),
                count($usuarios)
            );
            foreach ($moderadores as $moderador_id) {
                $this->assertArrayHasKey($moderador_id, $usuarios);
            }
        } finally {
            ModeradorTest::deleteModeradores();
        }
    }

    private function createModeradoresForLab($lab_id) {
        foreach (ModeradorTest::getUsers() as $user) {
            Moderador::getNewInstace(
                $user['id'],
                $lab_id
            )->save();
        }
    }

    private function getLabs() {
        return [
            '1' => [
                'id_laboratorio' => 1,
                'nombre_lab' => 'Lab. Física',
                'capacidad_lab' => 15,
                'descripcion_lab' => 'Laboratorio de física para clases de física.',
                'jornada1' => new Fecha(null, '07:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:00:00', '17:00:00')
            ],
            '2' => [
                'id_laboratorio' => 2,
                'nombre_lab' => 'Lab. Química',
                'capacidad_lab' => 20,
                'descripcion_lab' => 'Laboratorio de química para clases de química.',
                'jornada1' => new Fecha(null, '07:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:30:00', '17:30:00')
            ],
            '3' => [
                'id_laboratorio' => 3,
                'nombre_lab' => 'Lab. Suelos',
                'capacidad_lab' => 10,
                'descripcion_lab' => 'Laboratorio de suelos para los de civil.',
                'jornada1' => new Fecha(null, '09:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:00:00', '17:00:00')
            ],
            '4' => [
                'id_laboratorio' => 4,
                'nombre_lab' => 'Lab. Máquinas',
                'capacidad_lab' => 12,
                'descripcion_lab' => 'Laboratorio de máquinas para los de civil.',
                'jornada1' => new Fecha(null, '09:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:30:00', '17:30:00')
            ],
            '5' => [
                'id_laboratorio' => 5,
                'nombre_lab' => 'Lab. de computo',
                'capacidad_lab' => 25,
                'descripcion_lab' => 'Laboratorio que en realidad son salas de computo.',
                'jornada1' => new Fecha(null, '07:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:00:00', '17:00:00')
            ],
            '6' => [
                'id_laboratorio' => 6,
                'nombre_lab' => 'Lab. de python',
                'capacidad_lab' => 10,
                'descripcion_lab' => 'Laboratorio de python, con la ayuda de Guido Van Rossum.',
                'jornada1' => new Fecha(null, '07:00:00', '13:00:00'),
                'jornada2' => new Fecha(null, '15:30:00', '17:30:00')
            ]];
    }
}
