<?php
	class Foto{
		private $id;
		private $nome_foto;
		private $id_usuario;
		
		/* Set */
		public function setID($id) {$this->id = $id;}
		public function setNomeFoto($nome_foto) {$this->nome_foto = $nome_foto;}
		public function setIDUsuario($id_usuario) {$this->id_usuario = $id_usuario;}
		
		/* Get */
		public function getID() {return $this->id;}
		public function getNomeFoto() {return $this->nome_foto;}
		public function getIDUsuario() {return $this->id_usuario;}
		
	}
?>