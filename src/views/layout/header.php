<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Examen Recu Lorenzo</title>
</head>
<body>
<header>
    <h1>Examen Recu Lorenzo</h1>
    <ul class="menu">
        <?php if (isset($_SESSION['identity'])):?>
            <li><a href="<?=BASE_URL?>/correos/mostrarCorreos/">Mostrar Correos</a></li>
            <li><a href="<?= BASE_URL ?>/usuario/logout/">Cerrar sesión</a></li>
            <?php if($_SESSION['identity']->rol == "admin"): ?>
                <li><a href="<?=BASE_URL?>/usuario/gestionarUsuarios/">Gestionar Usuarios</a></li>
            <?php endif; ?>
        <?php else: ?>
            <li><a href="<?= BASE_URL ?>/usuario/indetifica/">Identificate</a></li>
            <li><a href="<?= BASE_URL ?>/usuario/registrar/">Crear cuenta</a></li>
        <?php endif; ?>
    </ul>
    <?php if (isset($_SESSION['identity'])): ?>
        <div class="informacion__usuario">
            <h3>Usuario: <?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
        </div>
    <?php endif; ?>
</header>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    header {
        background-color: orange;
        color: #fff;
        padding: 10px 20px;
        text-align: center;
    }
    header h1 {
        margin: 0;
        font-size: 28px;
    }
    .menu {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;

        list-style-type: none;
        padding: 0;
        margin: 20px 0;
        text-align: center;
    }
    .menu li a {
        color: #000;
        text-decoration: none;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
        background-color: #fff;
    }
    .informacion__usuario {
        background-color: #f4f4f4;
        padding: 10px;
        margin: 20px 0;
        border-radius: 5px;
        text-align: center;
        color: #000;
    }
</style>
