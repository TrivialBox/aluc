<?php


?>
<div>
    <!-- Lista de todos los moderadores -->
    <div>
        <h2>Lista de Moderadores</h2>
        <table width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Laboratorio</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($moderadores as $moderador) {
                    echo "
                    <tr>
                    <td>{$moderador->id}</td>
                    <td>{$moderador->nombre}</td>
                    <td>{$moderador->laboratorio_id}</td>
                    </tr>
                    ";
                }
            ?>
            </tbody>
        </table>
    </div>
    <div>
        <h2>Agregar nuevo moderador</h2>
        <form action="" method="post">
            <label for="id">ID</label>
            <br>
            <input type="text" name="id" id="id">
            <br>
            <input type="submit" value="Agregar">
        </form>
    </div>
</div>