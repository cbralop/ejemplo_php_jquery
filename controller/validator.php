<?php 
    session_start();
    include "../dto/UsuarioDTO.php";
    include "../dao/UsuarioDAO.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $listar = UsuarioDAO::login($email, $password);
    if($listar == 300 || $listar == "[]"){
        header("Location: ../index.php");
    }else{
        $respuesta = json_decode($listar, true);

        foreach ($respuesta as $clave => $valor) {
            $_SESSION['nombre'] = $respuesta[$clave]['nombre']." ".$respuesta[$clave]['apellido'];
            $_SESSION['rut'] = $respuesta[$clave]['rut'];
            $_SESSION['id'] = $respuesta[$clave]['id'];
            $_SESSION['email'] = $respuesta[$clave]['email'];
            $_SESSION['perfil'] = $respuesta[$clave]['perfil'];
            $_SESSION['estado'] = $respuesta[$clave]['estado'];

            header("Location: ../vistas/home.php");
        }
    }
?>