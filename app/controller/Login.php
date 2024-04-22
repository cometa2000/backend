<?php
namespace controller;
use model\TablaLogin;
use config\Config;
require_once realpath('.../../vendor/autoload.php');



class Login{
    public function insertar_Datos(){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nombreUser = $_POST['nombreUser'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmarPassword = $_POST['confirmarPassword'];

        $campos = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'nombre de usuario' => $nombreUser,
            'email' => $email,
            'contraseña' => $password,
            'confirmación de contraseña' => $confirmarPassword
        ];

        foreach ($campos as $campo => $valor) {
            if (empty($valor)) {
                echo "<script>alert('El campo $campo no puede ir vacío'); window.history.back();</script>";
                return;
            }
        }

        $expresionRegular = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/";
        if (!preg_match($expresionRegular, $email)) {
            echo "<script>alert('Por favor ingrese un email válido'); window.history.back();</script>";
            return;
        } 

        if($campos['contraseña'] != $campos['confirmación de contraseña']){
            echo "<script>alert('El Password tiene que ser el mismo'); window.history.back();</script>";
            return;
        }
        $password_encriptada = password_hash($campos['contraseña'], PASSWORD_DEFAULT);

        $login = new TablaLogin();
        if(!$campos['nombre de usuario'] == "") {
            $usuario = $login->consulta()->where('nombreUser',  $campos['nombre de usuario'])->first();
            if($usuario){
                echo "<script>alert('Nombre de Usuario ya existente Usa otro'); window.history.back();</script>";
                return;
            }
        }

        $result = $login->insercion([
            'nombre' => $campos['nombre'],
            'apellido' => $campos['apellido'],
            'nombreUser' => $campos['nombre de usuario'],
            'email' => $campos['email'],
            'password' => $password_encriptada
        ]);
        
        $route = new Config;
        if ($result) {
            $route->redirigir('login');
        } else {
            echo "<script>alert('Error al insertar los datos'); window.history.back();</script>";
        }
    }

    public function conculta_Datos(){
        $nombreUser = $_POST['nombreUser'];
        $password = $_POST['password'];
        $login = new TablaLogin();
        $usuario = $login->consulta()->where('nombreUser',  $nombreUser)->first();
        $route = new Config;

        $campos = [
            'nombre de usuario' => $nombreUser,
            'contraseña' => $password
        ];

        foreach ($campos as $campo => $valor) {
            if (empty($valor)) {
                echo "<script>alert('El campo $campo no puede ir vacío'); window.history.back();</script>";
                return;
            }
        }

        if($usuario){
            if($usuario['password'] == $password){
                // $_SESSION['usuario'] = $usuario[''];
                $route->redirigir('home');
            }else{
                echo "<script>alert('No es la contraseña, Intenta de nuevo'); window.history.back();</script>";
            }
        }else{
            echo "<script>alert('Nombre de Usuario incorrecto'); window.history.back();</script>";
        }

        // $login = new TablaLogin();
        // echo json_encode( $login->consulta()->where('nombreUser', $nombreUser));

    }
}


