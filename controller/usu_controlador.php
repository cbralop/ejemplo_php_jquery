<?php 
    $funcion = $_GET["func"];
    include "../dto/UsuarioDTO.php";
    include "../dao/UsuarioDAO.php";

    switch($funcion){
        case 1:
            cargaUsuarios();
        break;
        case 2:
            guardarUsuarios();
        break;
        case 3:
            buscarId();
        break;
        case 4:
            modUsuario();
        break;
        case 5:
            buscarNombre();
        break;
        case 6:
            desactivarUsuario();
        break;
    }

    function guardarUsuarios(){
        $usuario = new UsuarioDTO();
        $usuario->setNombre($_POST["nombre"]);
        $usuario->setApellido($_POST["apellido"]);
        $usuario->setEmail($_POST["email"]);
        $usuario->setDireccion($_POST["direccion"]);
        $usuario->setRut($_POST["rut"]);
        $usuario->setPerfil($_POST["perfil"]);
        $usuario->setEstado($_POST["estado"]);
        $respuesta = UsuarioDAO::agregarUsuario($usuario);
        if($respuesta == 1){
            echo 200;
        }else{
            echo 300;
        }
    }
    function modUsuario(){
        $usuario = new UsuarioDTO();
        $usuario->setNombre($_POST["nombre"]);
        $usuario->setApellido($_POST["apellido"]);
        $usuario->setEmail($_POST["email"]);
        $usuario->setDireccion($_POST["direccion"]);
        $usuario->setRut($_POST["rut"]);
        $usuario->setPerfil($_POST["perfil"]);
        $usuario->setEstado($_POST["estado"]);
        $id = $_POST["id"];

        $respuesta = UsuarioDAO::modUsuario($usuario, $id);
        if($respuesta == 1){
            echo 200;
        }else{
            echo 300;
        }
    }
    function desactivarUsuario(){
        $respuesta = UsuarioDAO::desactivaUsuario($_POST['id_usuario'], $_POST['estado']);
        if($respuesta == 1){
            echo 300;
        }else{
            echo 200;
        }
    }
    function cargaUsuarios(){
        $listar = UsuarioDAO::listarUsuarios($_GET['valor']);
        if($listar == 300 || $listar == "[]"){
            echo 300;
        }else{
            $cont = 0;
            $array = json_decode($listar, true);
            $tabla = "";
            foreach ($array as $value) {
                $editar = "<button class='btn btn-outline-info mr-1 btn-sm' data-toggle='modal' data-target='#modal_mod' onclick='cargaMod(".$value['id'].");'><i class='far fa-edit'></i></button>";
                $eliminar = "<button class='btn btn-outline-danger btn-sm' onclick='cargaEli(".$value['id'].", ".$value['estado'].")'><i class='fas fa-thumbs-down'></i></button>";
                if($value['estado'] == 1){
                    $estado = "<p class='text-success'>Activo</p>";
                    $eliminar = "<button class='btn btn-outline-danger btn-sm' onclick='cargaEli(".$value['id'].", ".$value['estado'].")'><i class='fas fa-thumbs-down'></i></button>";
                }
                if($value['estado'] == 2){
                    $estado = "<p class='text-danger'>Inactivo</p>";
                    $eliminar = "<button class='btn btn-outline-success btn-sm' onclick='cargaEli(".$value['id'].", ".$value['estado'].")'><i class='fas fa-thumbs-up'></i></button>";
                }
                $cont++;
                $tabla.='{
                        "numero":"'.$cont.'",
                        "nombre":"'.$value['nombre'].' '.$value['apellido'].'",
                        "email":"'.$value['email'].'",
                        "direccion":"'.$value['direccion'].'",
                        "rut":"'.$value['rut'].'",
                        "perfil":"'.$value['perfil_desc'].'",
                        "estado":"'.$estado.'",
                        "accion":"'.$editar.$eliminar.'"
                        },';
            }
            $tabla = substr($tabla,0, strlen($tabla) - 1);
            echo '{"data":['.$tabla.']}';
        }
    }
    function buscarId(){
        $id_usuario = $_POST["id_usuario"];
        $listar = UsuarioDAO::buscarPorId($id_usuario);
        if($listar == 300 || $listar == "[]"){
            echo 300;
        }else{
            echo $listar;
        }
    }
    function buscarNombre(){
        $id_usuario = $_POST["buscar_nombre"];
        $listar = UsuarioDAO::buscarPorNombre($id_usuario);
        if($listar == 300 || $listar == "[]"){
            echo 300;
        }else{
            echo json_encode($listar);
        }
    }
?>