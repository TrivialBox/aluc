<?php
foreach ($get('moderadores') as $moderador) {
    $laboratorio = $moderador->getLaboratorio();
    echo <<<TAG
    <tr data-id="{$moderador->id}" data-laboratorio-id="{$laboratorio->id}">
    <td>
        {$moderador->id}
    </td>
    <td>
        {$moderador->nombre}
    </td>
    <td>
        {$laboratorio->nombre} ({$laboratorio->id})
    </td>
    <td>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-moderador">
                Editar
            </button>

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm-delete-moderador">
                Eliminar
            </button>
        </div>
    </td>
    </tr>
TAG;
}
