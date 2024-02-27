<?php
namespace controllers;
use lib\pages,
    models\usuario;
use utils\utils;

class usuarioController{
    private pages $pages;

    public function __construct()
    {
        $this->pages=new pages();
    }

    /**
     * @return void
     */
    public function indetifica(){
        $this->pages->render("usuario/login");
    }

    /**
     * @return void
     */
    public function registrar() {
        $this->pages->render("usuario/registro");
    }

    /**
     * @return void
     */
    public function login(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            if ($_POST['data']){
                $login=$_POST['data'];
                $login['email']=utils::validarCorreo($login['email']);
                $login['password']=utils::validarContrasena($login['password']);

                $usuario=usuario::fromArray($login);
                $identity=$usuario->login();

                if($identity && is_object($identity)){
                    $_SESSION['identity']=$identity;
                    header("Location: " . BASE_URL);
                    if ($identity->rol == 'admin'){
                        $_SESSION['admin']=true;
                    }
                }else {
                    $_SESSION['error_login']='identificacion fallida';
                    // Header a la misma pagina
                    header("Location: " . BASE_URL . "/usuario/indetifica");
                }
            }
        }else{
            echo "No ha entrado por metodo post";
            header("Location: " . BASE_URL);
        }
        $usuario->desconecta();
    }

    /**
     * @return void
     */
    public function registro(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if ($_POST['data']){
                $registrado=$_POST['data'];

                //sanear y validar con metodos estaticos
                $registrado['email']=utils::validarCorreo($registrado['email']);
                $registrado['password']=utils::validarContrasena($registrado['password']);
                $registrado['nombre']=utils::validarNombre($registrado['nombre']);
                $registrado['apellidos']=utils::validarNombre($registrado['apellidos']);

                $registrado['password']=password_hash($registrado['password'],PASSWORD_BCRYPT,['cost'=>4]);

                //tambien se puede validar en la funcion fromArray
                $usuario=usuario::fromArray($registrado);

                $save=$usuario->create();
                if ($save){
                    $_SESSION['register']='complete';
                }else {
                    $_SESSION['register'] = 'failed';
                }
            }else{
                $_SESSION['register'] = 'failed';
            }
            $usuario->desconecta();
        }
        $this->pages->render('usuario/registro');
    }

    /**
     * @return void
     */
    public function logout(){
        utils::deleteSession('identity');
        header("Location: " . BASE_URL);
    }

    /**
     * @return mixed
     */
    public static function extraerUsuarios() {
        $usuarios = usuario::fromArray([]);
        return $usuarios->getAll();
    }

    /**
     * @return void
     */
    public function gestionarUsuarios() {
        $usuarios = $this->extraerUsuarios();
        $this->pages->render('usuario/gestionar', ['usuarios' => $usuarios]);
    }

    /**
     * @param $id
     * @return void
     */
    public function editar($id) {
        $usuarios = $this->extraerUsuarios();
        $editar = true;
        $this->pages->render('usuario/gestionar',['usuarios' => $usuarios,'id' => $id,'editar' => $editar]);
    }

    /**
     * @param $id
     * @return void
     */
    public function editarUsuario($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $usuario = usuario::fromArray(['id' => $id,'nombre' => $nombre, 'email' => $email]);
            $resultado = $usuario->editar();
            $usuarios = usuarioController::extraerUsuarios();
            if($resultado) {
                $this->pages->render("usuario/gestionar",['usuarios' => $usuarios]);
            }else {
                $this->pages->render("usuario/gestionar",['usuarios' => $usuarios,'id' => $id,'editar' => true]);
            }
        }else {
            echo "No método post";
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function eliminar($id) {
        $usuario = usuario::fromArray(['id' => $id]);
        $resultado = $usuario->borrar();
        $usuarios = usuarioController::extraerUsuarios();
        if($resultado) {
            $this->pages->render("usuario/gestionar",['usuarios' => $usuarios]);
        }else {
            echo "Error al eliminar el usuario";
            $this->pages->render("usuario/gestionar",['usuarios' => $usuarios]);
        }
    }

}
