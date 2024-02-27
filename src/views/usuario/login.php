<section class="login">
    <?php if(isset($_SESSION['error_login'])): ?>
        <h3 style="color: red"><?=$_SESSION['error_login']?></h3>
    <?php endif; ?>
    <?php if(!isset($_SESSION['indentity'])): ?>
    <form class="form__login" action="<?=BASE_URL?>/usuario/login/" method="post">
        <h1>Loguearse</h1>
        <p>
            <label for="email">Email</label><br>
            <input id="email" type="text" name="data[email]" pattern="[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]+" title="Por favor, introduce una dirección de correo electrónico válida" required>
        </p>
        <p>
            <label for="password">Contraseña</label><br>
            <input id="password" type="password" name="data[password]" pattern="^[a-zA-Z0-9!@#$%^&*]{8,}$" title="La contraseña debe contener al menos 8 caracteres de longitud" required>
        </p>
        <p>
            <input type="submit" value="Loguearse">
        </p>
    </form>
    <?php else: ?>
        <h3><?=$_SESSION['identity']->nombre?><?= $_SESSION['identity']->apellidos ?></h3>
    <?php endif; ?>
</section>

<style>
    .login {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .form__login {
        display: flex;
        align-items: center;
        flex-direction: column;

        margin-top: 2rem;
        width: 350px;
        height: 450px;
        box-shadow: 0 0 5px black;
    }

    .form__login h1 {
        font-size: 2rem;
    }

    .form__login p {
        text-align: center;
        font-size: 1.2rem;
    }

    .form__login p input {
        padding: 10px;
    }

    .form__login p input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        font-size: 1.2rem;
    }
</style>