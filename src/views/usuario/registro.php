<?php use utils\utils; ?>
<?php unset($_SESSION['error_login']); ?>
<?php if (isset($_SESSION['register']) && $_SESSION['register']=='complete'): ?>
    <strong>Registro completado correctamente</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register']=='failed'): ?>
    <strong>Registro fallido, introduzca bien los datos</strong>
<?php endif; ?>
<?php utils::deleteSession('register') ?>
<section class="registro">
    <form class="form__registro" action="<?=BASE_URL?>/usuario/registro/" method="post">
        <h1>Registrar Cuenta</h1>
        <p>
            <label for="nombre">Nombre</label><br>
            <input id="nombre" type="text" name="data[nombre]" pattern="[A-Za-záéíóúÁÉÍÓÚ\s]+" title="Por favor, introduce solo letras" required>
        </p>
        <p>
            <label for="apellidos">Apellidos</label><br>
            <input id="apellidos" type="text" name="data[apellidos]" pattern="[A-Za-záéíóúÁÉÍÓÚ\s]+" title="Por favor, introduce solo letras" required>
        </p>
        <p>
            <label for="email">Email</label><br>
            <input id="email" type="email" name="data[email]" pattern="[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]+" title="Por favor, introduce una dirección de correo electrónico válida" required>
        </p>
        <p>
            <label for="password">Contraseña</label><br>
            <input id="password" type="password" name="data[password]" pattern="^[a-zA-Z0-9!@#$%^&*]{8,}$" title="La contraseña debe contener al menos 8 caracteres de longitud" required>
        </p>
        <p>
            <input type="submit" value="Registrarse">
        </p>
    </form>
</section>

<style>
    .registro {
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .form__registro {
        display: flex;
        align-items: center;
        flex-direction: column;

        margin-top: 2rem;
        width: 350px;
        height: 500px;
        box-shadow: 0 0 5px black;
    }

    .form__registro h1 {
        font-size: 2rem;
        margin-bottom: 0;
    }

    .form__registro p {
        text-align: center;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .form__registro p input {
        padding: 10px;
    }

    .form__registro p input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        font-size: 1.2rem;
    }
</style>