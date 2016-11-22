<?php
foreach ($get('lectores_qr') as $lector) {
    $laboratorio = $lector->getLaboratorio();
    echo <<<TAG
    <tr data-mac="{$lector->mac}" data-laboratorio-id="{$laboratorio->id}" data-ip="{$lector->ip}">
    <td>
        {$lector->mac}
    </td>
    <td>
        {$lector->ip}
    </td>
    <td>
        {$laboratorio->nombre} ({$laboratorio->id})
    </td>
    <td>
        <div class="row">
            <div class="col-xm-2">
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapse-token" data-placement="top" title="Mostrar/Ocultar token">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </button>
                    <button class="btn btn-secondary" type="button" data-placement="top" title="Renovar token">
                        <span class="glyphicon glyphicon-repeat"></span>
                    </button>
                </div>
            </div>
            <div class="collapse col-xm-10" id="collapse-token">
                <small class="text-muted">
                    {$lector->getToken()}
                </small>
            </div>
        </div>
    </td>
    <td>
        <div class="btn-group btn-group-sm" role="group">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-lector-qr">
                Editar
            </button>

            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm-delete-lector-qr">
                Eliminar
            </button>
        </div>
    </td>
    </tr>
TAG;
}
