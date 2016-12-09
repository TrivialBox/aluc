<nav class="">
<ul class="nav nav-pills nav-stacked">
    <li>
        <div class="panel panel-default text-center">
            <div class="panel-heading">
                <form>
                    <div class="form-group">
                        <!--
                        <label for="laboratorios">Laboratorio</label>
                        -->
                        <select class="form-control" id="laboratorios" name="laboratorio_id">
                            <?php
                            foreach ($get('laboratorios') as $laboratorio) {
                                echo <<<TAG
                                <option value="{$laboratorio->id}">{$laboratorio->nombre} ({$laboratorio->id})</option>
TAG;
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>

            <div class="panel-body" id="laboratorio-content">
            </div>
        </div>
    </li>
    <li class="hidden-xs">
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
