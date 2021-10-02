<?php

require_once '../dto/usuarioDTO.php';
require_once '../conexion/ClasePDO.php';

class UsuarioDAO{

    public static function login($correo, $pass) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("SELECT usu.nombre, usu.apellido, usu.email, usu.direccion, usu.rut, usu.perfil, usu.estado FROM usuario usu WHERE usu.email = ? AND usu.password = ? AND usu.estado = 1;");
            $stmt->bindParam(1, $correo);
            $stmt->bindParam(2, $pass);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $pdo = null;
            return json_encode($resultado);
        } catch (PDOException $ex) {
            echo "Error al Buscar " . $ex->getMessage();
            echo "300";
        }
        return $dto;
    }

    public static function agregarUsuario($usuario) {
        try {
            $pass = "@#$$#%EDFSDF#FDT@#@!DWEDFC#@WE23dewsdscwseee234e32eewdcsf32w#ER@DSWE23edwedcxsfced@#ED@W#Dsd";
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("INSERT INTO usuario VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?)");
            $nombre = $usuario->getNombre();
            $apellido = $usuario->getApellido();
            $email = $usuario->getEmail();
            $direccion = $usuario->getDireccion();
            $rut = $usuario->getRut();
            $perfil = $usuario->getPerfil();
            $estado = $usuario->getEstado();
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $apellido);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $direccion);
            $stmt->bindParam(5, $rut);
            $stmt->bindParam(6, $perfil);
            $stmt->bindParam(7, $estado);
            $stmt->bindParam(8, $pass);

            return $stmt->execute();
            $pdo = NULL;
        } catch (Exception $ex) {
            echo "Error al agregar Usuario " . $ex->getMessage();
            echo "300";
        }
        return false;
    }

    public static function modUsuario($usuario, $id) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("UPDATE usuario SET nombre = ?, apellido = ?, email = ?, direccion = ?, rut = ?, perfil = ?, estado = ? WHERE id = ?;");
            $nombre = $usuario->getNombre();
            $apellido = $usuario->getApellido();
            $email = $usuario->getEmail();
            $direccion = $usuario->getDireccion();
            $rut = $usuario->getRut();
            $perfil = $usuario->getPerfil();
            $estado = $usuario->getEstado();
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $apellido);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $direccion);
            $stmt->bindParam(5, $rut);
            $stmt->bindParam(6, $perfil);
            $stmt->bindParam(7, $estado);
            $stmt->bindParam(8, $id);

            return $stmt->execute();
            $pdo = NULL;
        } catch (Exception $ex) {
            echo "Error al agregar Usuario " . $ex->getMessage();
            echo "300";
        }
        return false;
    }

    public static function desactivaUsuario($id_usuario, $estado){
        if($estado == 1){
            $nestado = 2;
        }
        if($estado == 2){
            $nestado = 1;
        }
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("UPDATE usuario SET estado = ? WHERE id = ?;");
            $stmt->bindParam(1, $nestado);
            $stmt->bindParam(2, $id_usuario);

            return $stmt->execute();
            $pdo = NULL;
        } catch (Exception $ex) {
            echo "Error al agregar Usuario " . $ex->getMessage();
            echo "300";
        }
        return false;
    }
    public static function buscarPorId($id_usuario) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("SELECT usu.nombre, usu.apellido, usu.email, usu.direccion, usu.rut, usu.perfil, usu.estado FROM usuario usu WHERE usu.id = ?");
            $stmt->bindParam(1, $id_usuario);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $pdo = null;
            return json_encode($resultado);
        } catch (PDOException $ex) {
            echo "Error al Buscar " . $ex->getMessage();
            echo "300";
        }
        return $dto;
    }
    public static function buscarPorNombre($nombre) {
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("SELECT usu.nombre, usu.apellido, usu.email, usu.direccion, usu.rut, usu.perfil, usu.estado FROM usuario usu JOIN perfil pe ON usu.perfil = pe.id WHERE usu.nombre = '%?%'");
            $stmt->bindParam(1, $id_usuario);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $pdo = null;
            return json_encode($resultado);
        } catch (PDOException $ex) {
            echo "Error al Buscar " . $ex->getMessage();
            echo "300";
        }
        return $dto;
    }
    public static function listarUsuarios($valor) {
        if($valor == ""){
            $queryExtra = "";
        }else{
            $queryExtra = " WHERE usu.nombre LIKE '%".$valor."%' OR usu.apellido LIKE '%".$valor."%'";
        }
        try {
            $pdo = new clasePDO();
            $stmt = $pdo->prepare("SELECT usu.id, usu.nombre, usu.apellido, usu.email, usu.direccion, usu.rut, usu.perfil, usu.estado, pe.descripcion as perfil_desc FROM usuario usu LEFT JOIN perfil pe ON usu.perfil = pe.id".$queryExtra."");
            $stmt->execute();
            $pdo = null;
            
            if (!$stmt){
                return 'Error al ejecutar la consulta';
            }else{
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return json_encode($results);
            }
        } catch (Exception $exc) {
            //echo "Error al listar  " . $exc->getMessage();
            echo "300";
        }
    }
}
?>