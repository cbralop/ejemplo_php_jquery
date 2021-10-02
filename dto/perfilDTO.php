<?php
    
	class PerfilDTO extends usuarioDTO{
		private $id;
        private $descripcion;

		function __construct() {
   		}

 		function getId() {
     		return $this->id;
 		}
        function getDescripcion() {
                return $this->descripcion;
        }

        function setId($id) {
            $this->id = $id;
        }
        function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }
  }
?>