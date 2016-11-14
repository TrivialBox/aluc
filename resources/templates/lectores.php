<div>
    <!-- Lista de todos los lectores -->
    <div>
        <h2>Lista de Lectores QR</h2>
        <table width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>IP</th>
                <th>MAC</th>
                <th>Laboratorio</th>
                <th>Token</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($lectores as $lector) {
                $laboratorio = $lector->getLaboratorio();
                echo "
                    <tr>
                    <td>{$lector->id}</td>
                    <td>{$lector->ip}</td>
                    <td>{$lector->mac}</td>
                    <td>{$laboratorio->nombre} ({$laboratorio->id}})</td>
                    </tr>
                    ";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div>
        <h2>Agregar nuevo lector QR</h2>
        <form action="/admin/lectores/nuevo" method="post">
            <label for="ip">IP</label>
            <br>
            <input type="text" name="ip" id="ip">
            <br>
            <label for="mac">MAC</label>
            <br>
            <input type="text" name="mac" id="mac">
            <br>
            <label for="laboratorio_id">Laboratorio ID</label>
            <br>
            <input type="text" name="laboratorio_id" id="laboratorio_id">
            <br>
            <input type="submit" value="Agregar">
        </form>
    </div>
</div>
