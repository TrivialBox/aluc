<?php
use Aluc\Common\Tools;
?>
<?php
if (Tools::check_session('admin')) {
?>
<li class="">
    <a href="/admin/moderadores">
        Moderadores
    </a>
</li>
<li class="">
    <a href="/admin/lectores-qr">
        Lectores QR
    </a>
</li>
<?php
}
?>
<?php
if (Tools::check_session('admin', 'moderador')) {
?>
<li class="">
    <a href="/escritorio">
        Escritorio
    </a>
</li>
<li class="">
    <a href="/escritorio/reportes">
        Reportes
    </a>
</li>
<?php
}
?>
<li class="">
    <a href="/reservas">
        Reservas
    </a>
</li>
