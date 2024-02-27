<section class="enviarCorreo">
    <?php if (isset($exito))
        echo $exito;
    ?>
    <h1>Enviar Correo</h1>
    <form class="form__enviarCorreo" action="<?=BASE_URL?>/correo/crearCorreo/" method="post">
        <input class="campos__ocultos" type="email" name="de" value="<?php if($_SESSION['identity']->email) echo $_SESSION['identity']->email?>">
        <label for="id_usuario"><b>Para: </b></label>
        <?php if (isset($usuarios) && !empty($usuarios)): ?>
            <select name="id_usuario">
        <?php foreach($usuarios as $usuario): ?>
                <option value="<?= $usuario['id'] ?>"><?= $usuario['email'] ?></option>
            <?php endforeach;?>
            </select>
        <?php endif; ?>
        <label for="asunto"><b>Asunto: </b></label>
        <input type="text" name="asunto">
        <label for="cuerpo"><b>Cuerpo: </b></label>
        <textarea name="cuerpo" id="cuerpo" cols="30" rows="10"></textarea>
        <input class="campos__ocultos" type="text" name="fecha" value="<?php echo date('Y-m-d')?>">
        <input type="submit" value="Enviar">
    </form>
</section>

<style>

    .enviarCorreo {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .enviarCorreo h1 {
        text-align: center;
    }

    .form__enviarCorreo {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

        box-shadow: 0 0 4px black;
        width: 380px;
        height: 400px;
        padding: 6px;
    }

    .form__enviarCorreo label {
        font-size: 1.2rem;
    }

    .form__enviarCorreo input,textarea, select {
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }

    .form__enviarCorreo input,select {
        width: 300px;
        height: 50px;
    }

    .form__enviarCorreo input[type="submit"] {
        background-color: #4CAF50;
        padding: 8px;
        color: white;
        border: none;
        width: 200px;
    }

    .campos__ocultos {
        display: none;
    }

</style>

