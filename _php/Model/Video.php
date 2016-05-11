<?php
	class Video{
		private $id;
		private $nome_video;
		private $id_usuario;
		
		/* Set */
		public function setID($id) {$this->id = $id;}
		public function setNomeVideo($nome_foto) {$this->nome_foto = $nome_video;}
		public function setIDUsuario($id_usuario) {$this->id_usuario = $id_usuario;}
		
		/* Get */
		public function getID() {return $this->id;}
		public function getNomeVideo() {return $this->nome_video;}
		public function getIDUsuario() {return $this->id_usuario;}
		
	}
?>