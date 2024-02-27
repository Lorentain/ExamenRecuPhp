<?php
namespace utils;
class utils{
    public static function deleteSession($nombreSession){
        if (isset($_SESSION[$nombreSession])){
            $_SESSION[$nombreSession]=null;
            unset($_SESSION[$nombreSession]);
        }
    }

    // Funcion para validar y sanear correo
    public static function validarCorreo($correo){
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)){
            return $correo;
        }else{
            return false;
        }
    }

    // Funcion para validar y sanear contraseña
    public static function validarContrasena($contrasena){
        $contrasena = filter_var($contrasena, FILTER_SANITIZE_SPECIAL_CHARS);
        if (strlen($contrasena) >= 8){
            return $contrasena;
        }else{
            return false;
        }
    }

    // Funcion para validar y sanear nombre
    public static function validarNombre($nombre){
        if (preg_match('/[A-Za-záéíóúÁÉÍÓÚ\s]+/', $nombre)){
            return $nombre;
        }else{
            return false;
        }
    }
}