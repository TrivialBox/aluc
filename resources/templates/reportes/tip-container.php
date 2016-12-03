<?php
use Aluc\Common\TemplateGenerator;


TemplateGenerator::generate([
    'title' => 'Nada por aquí.',
    'tip' => 'No se encontraron resultados para tu búsqueda actual.
              <br>
              Prueba con otros criterios o mira los <a href="/escritorio/reportes">reportes de hoy.</a>'
],
    'common/tip-container.php'
);
