<?php
	class Notificacao{
		private $id;
		private $id_publicacao;
		private $id_usuario;
		private $id_amigo;
		private $visto;
		
		/* Set */
		public function setID($id) {$this->id = $id;return true;}
		public function setIDPublicacao($id_publicacao) {$this->id_publicacao = $id_publicacao;return true;}
		public function setIDUsuario($id_usuario) {$this->id_usuario = $id_usuario;return true;}
		public function setIDAmigo($id_amigo) {$this->id_amigo = $id_amigo;return true;}
		public function setVisto($visto) {$this->visto = $visto;return true;}
		
		/* Get */
		public function getID() {return $this->id;}
		public function getIDPublicacao() {return $this->id_publicacao;}
		public function getIDUsuario() {return $this->id_usuario;}
		public function getIDAmigo() {return $this->id_amigo;}
		public function getVisto() {return $this->visto;}
	}
?>