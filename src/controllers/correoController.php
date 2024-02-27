<?php
namespace controllers;

use lib\pages;
use models\correos;

class correoController {
    private pages $pages;

    /**
     * @param pages $pages
     */
    public function __construct()
    {
        $this->pages = new pages();
    }

    /**
     * @return mixed
     */
    public static function extraerCorreos() {
        $correos = correos::fromArray([]);
        return $correos->getAll();
    }

    /**
     * @return void
     */
    public function mostrarCorreos() {
        $correos = correoController::extraerCorreos();
        $this->pages->render("correos/mostrar", ["correos" => $correos]);
    }

    /**
     * @return void
     */
    public function eliminarCorreos() {
        if(isset($_POST['correosEliminar']) && !empty($_POST['correosEliminar'])) {
            $correosEliminar = $_POST['correosEliminar'];
            $resultado = false;
            foreach ($correosEliminar as $id) {
                $correo = correos::fromArray(['id' => $id]);
                $resultado = $correo->eliminar();
            }
            $correos = correoController::extraerCorreos();
            if($resultado) {
                $this->pages->render("correos/mostrar", ["correos" => $correos]);
            } else {
                echo "Error al eliminar el correo";
                $this->pages->render("correos/mostrar", ["correos" => $correos]);
            }
        }else {
            echo "No hay correos seleccionados";
            $correos = correoController::extraerCorreos();
            $this->pages->render("correos/mostrar", ["correos" => $correos]);
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function verCuerpo($id) {
        $correos = correoController::extraerCorreos();
        $verCuerpoID = $id;
        $this->pages->render("correos/mostrar", ["verCuerpoID" => $verCuerpoID, "correos" => $correos]);
    }

    public function ocultarCuerpo() {
        $correos = correoController::extraerCorreos();
        $verCuerpoID = "";
        $this->pages->render("correos/mostrar", ["verCuerpoID" => $verCuerpoID, "correos" => $correos]);
    }

    public function enviarCorreo() {
        $usuarios = usuarioController::extraerUsuarios();
        $this->pages->render("correos/enviar",["usuarios" => $usuarios]);
    }

    public function crearCorreo() {
        $id_usuario = $_POST['id_usuario'];
        $de = filter_var($_POST['de'],FILTER_SANITIZE_EMAIL);
        $asunto = filter_var($_POST['asunto'], FILTER_SANITIZE_SPECIAL_CHARS);
        $cuerpo = filter_var($_POST['cuerpo'],FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = $_POST['fecha'];
        $correo = correos::fromArray(['id_usuario' => $id_usuario,'de' => $de, 'asunto' => $asunto, 'cuerpo' => $cuerpo,'fecha' => $fecha]);
        $resultado = $correo->crear();
        $usuarios = usuarioController::extraerUsuarios();
        if($resultado) {
            $exito = "Correo enviado exitosamente";
            $this->pages->render("correos/enviar", ["usuarios" => $usuarios,"exito" => $exito]);
        } else {
            echo "Error al enviar el correo";
            $this->pages->render("correos/enviar", ["usuarios" => $usuarios]);
        }
    }

}
