<?php
use Aluc\Common\TemplateGenerator;
?>
<nav class="hidden-xs">
<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="40">
    <?php
        TemplateGenerator::generate([], 'common/menu.php');
    ?>
    <li class="">
        <hr>
        <footer>
            <small class="text-muted">
                Copyright (c) 2016 <a href="http://trivialbox.com" target="_blank">Trivial Box</a>.
                <br>
                Bugs y sugerencias en <a href="https://github.com/trivialbox/aluc/issues/new" target="_blank">GitHub</a>.
                <br>
                Leer la <a href="https://trivialbox.github.io/aluc/">documentación</a>.
            </small>
        </footer>
    </li>
</ul>
</nav>
