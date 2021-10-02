<?php
	class UsuarioDTO{
		private $id;
        private $nombre;
        private $apellido;
		private $email;
        private $direccion;
        private $rut;
        private $perfil;
        private $estado;

		function __construct() {
   		}

 		function getId() {
     		return $this->id;
 		}
        function getNombre() {
                return $this->nombre;
        }
        function getApellido() {
            return $this->apellido;
        }
        function getEmail() {
            return $this->email;
        }
        function getDireccion() {
            return $this->direccion;
        }
        function getRut() {
            return $this->rut;
        }
        function getPerfil() {
            return $this->perfil;
        }
        function getEstado() {
            return $this->estado;
        }

        function setId($id) {
            $this->id = $id;
        }
        function setNombre($nombre) {
            $this->nombre = $nombre;
        }
        function setApellido($apellido) {
            $this->apellido = $apellido;
        }
        function setEmail($email) {
            $this->email = $email;
        }
        function setDireccion($direccion) {
            $this->direccion = $direccion;
        }
        function setRut($rut) {
            $this->rut = $rut;
        }
        function setPerfil($perfil) {
            $this->perfil = $perfil;
        }
        function setEstado($estado) {
            $this->estado = $estado;
        }
  }
?>