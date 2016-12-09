<?php
use Aluc\Common\TemplateGenerator;
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Commont -->
    <?php
        TemplateGenerator::generate([], 'common/header.php');
    ?>

    <title>Iniciar sesión - ALUC</title>
</head>

<body>

<div class="header">
    <h1>ALUC</h1>
</div>
<div class="login">
    <form method="post">
        <div class="form-group">
        <input class="form-control" type="text" placeholder="Usuario" name="user">
        <input class="form-control" type="password" placeholder="Contraseña" name="password">
        <button class="btn btn-default" type="submit"> Iniciar sesión </button>
        </div>
    </form>
</div>

</body>

</html>
