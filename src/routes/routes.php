<?php

namespace routes;

use controllers\correoController;
use controllers\dashboardController;
use controllers\errorController;
use controllers\usuarioController;
use lib\router;

class routes {
    public static function index() {
        Router::add('GET','/', function (){
            return (new usuarioController())->indetifica();
        });

        Router::add('GET','/usuario/indetifica/', function (){
            return (new usuarioController())->indetifica();
        });

        Router::add('POST','/usuario/login/', function (){
            return (new usuarioController())->login();
        });

        Router::add('GET','/usuario/logout/', function (){
            return (new usuarioController())->logout();
        });

        Router::add('POST','/usuario/registro/', function (){
            return (new usuarioController())->registro();
        });

        Router::add('GET','/usuario/registrar/', function (){
            return (new usuarioController())->registrar();
        });

        Router::add('GET','/usuario/gestionarusuarios/', function (){
            return (new usuarioController())->gestionarUsuarios();
        });

        Router::add('GET', '/usuario/editar/:id', function ($id) {
            (new usuarioController())->editar($id);
        });

        Router::add('POST', '/usuario/editarusuario/:id', function ($id) {
            (new usuarioController())->editarUsuario($id);
        });

        Router::add('GET', '/usuario/eliminar/:id', function ($id) {
            (new usuarioController())->eliminar($id);
        });

        Router::add('GET', '/correos/mostrarcorreos/', function () {
            (new correoController())->mostrarCorreos();
        });

        Router::add('POST', '/correo/eliminarcorreos/', function () {
            (new correoController())->eliminarCorreos();
        });

        Router::add('GET', '/correo/vercuerpo/:id', function ($id) {
            (new correoController())->verCuerpo($id);
        });

        Router::add('GET', '/correo/ocultarcuerpo/', function () {
            (new correoController())->ocultarCuerpo();
        });

        Router::add('GET', '/correo/enviarcorreo/', function () {
            (new correoController())->enviarCorreo();
        });

        Router::add('POST', '/correo/crearcorreo/', function () {
            (new correoController())->crearCorreo();
        });

        Router::add('GET','/error/', function (){
            return (new errorController())->error404();
        });

        Router::dispatch();
    }
}
