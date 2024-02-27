<section class="mostrarCorreos">
    <h1>MOSTRAR CORREOS PRUEBA</h1>
    <?php if(isset($correos) && !empty($correos)):?>
        <form id="borrarCorreosForm" action="<?=BASE_URL?>/correo/eliminarCorreos/" method="post">
            <ul>
                <?php foreach($correos as $correo): ?>
                    <?php if ($_SESSION['identity']->id == $correo['id_usuario']): ?>
                        <li>
                            <b>De:</b> <?=($correo['de']) ?> <b><a class="verAsunto" href="<?=BASE_URL?>/correo/verCuerpo/<?=$correo['id']?>">Asunto:</b></a> <?=($correo['asunto'])?>
                            <b>Fecha:</b> <?=($correo['fecha'])?> <input type="checkbox" name="correosEliminar[]" value="<?= $correo['id'] ?>">
                            <?php if(isset($verCuerpoID) && !empty($verCuerpoID) && $verCuerpoID == $correo['id']): ?>
                                <br><b>Cuerpo: </b> <p><?=($correo['cuerpo'])?></p><br>
                                <a class="ocultarAsunto" href="<?=BASE_URL?>/correo/ocultarCuerpo/">Ocultar Asunto</a>
                            <?php endif; ?>
                        </li>
                    <?php endif;?>
                <?php endforeach;?>
            </ul>
            <button type="submit" id="borrarCorreosBtn">Borrar Correos</button>
        </form>
        <a href="<?=BASE_URL?>/correo/enviarCorreo/" style="text-decoration: none"><button type="button" id="enviarCorreosBtn">Enviar Correo</button></a>
    <?php endif; ?>
</section>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .mostrarCorreos {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;

        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 5px;
    }
    .mostrarCorreos h1 {
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }
    .mostrarCorreos ul {
        list-style-type: none;
        padding: 0;
    }
    .mostrarCorreos li {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #fff;
        border-radius: 5px;
    }
    .mostrarCorreos li:hover {
        background-color: #f0f0f0;
    }
    .mostrarCorreos li b {
        font-weight: bold;
    }
    .mostrarCorreos li input[type="checkbox"] {
        margin-right: 5px;
    }
    #borrarCorreosBtn {
        display: block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #enviarCorreosBtn {
        display: block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #borrarCorreosBtn:hover {
        background-color: #555;
    }

    .verAsunto {
        color: #4CAF50;
        font-weight: bold;
        text-decoration: none;
    }


    .ocultarAsunto {
        margin-top: 1rem;
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
    }
</style>

