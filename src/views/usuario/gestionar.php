<section class="mostrarUsuarios">
    <h1>GESTIÓN USUARIOS</h1>
    <?php if(isset($usuarios) && !empty($usuarios)):?>
        <ul>
            <?php foreach($usuarios as $usuario): ?>
                <?php if(isset($editar) && $editar == true && isset($id) && $id == $usuario['id']):?>
                    <form class="form__editarusuario" action="<?=BASE_URL?>/usuario/editarUsuario/<?=$usuario['id']?>" method="post">
                        <input type="text" name="nombre" value="<?=($usuario['nombre'])?>">
                        <input type="text" name="email" value="<?=($usuario['email'])?>">
                        <input type="text" name="id" value="<?=($usuario["id"])?>" style="display: none">
                        <input type="submit" value="Editar">
                        <a href="<?=BASE_URL?>/usuario/gestionarUsuarios/"><button type="button">Cancelar</button></a>
                    </form>
                <?php else:?>
                    <li>
                        <b>Usuario nombre:</b> <?=($usuario['nombre']) ?> <b>Email:</b> <?=($usuario['email'])?>
                        <a href="<?=BASE_URL?>/usuario/editar/<?=$usuario['id']?>">Editar</a>
                        <a href="<?=BASE_URL?>/usuario/eliminar/<?=$usuario['id']?>">Eliminar</a>
                    </li>
                <?php endif;?>
            <?php endforeach;?>
        </ul>
    <?php endif; ?>
</section>

<style>
    .mostrarUsuarios {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 5px;
    }
    .mostrarUsuarios h1 {
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }
    .mostrarUsuarios ul {
        list-style-type: none;
        padding: 0;
    }
    .mostrarUsuarios li {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #fff;
        border-radius: 5px;
    }
    .mostrarUsuarios li:hover {
        background-color: #f0f0f0;
    }
    .mostrarUsuarios li b {
        font-weight: bold;
    }
    .mostrarUsuarios li form__editarusuario input[type="text"] {
        margin-right: 10px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    .mostrarUsuarios li form__editarusuario input[type="submit"] {
        padding: 5px 10px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    .mostrarUsuarios li form__editarusuario input[type="submit"]:hover {
        background-color: #555;
    }
    .mostrarUsuarios li a {
        margin-left: 10px;
        padding: 5px 10px;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        border-radius: 3px;
    }
    .mostrarUsuarios li a:hover {
        background-color: #555;
    }

    .form__editarusuario button a {
        text-decoration: none;
        color: #000;
    }
</style>
