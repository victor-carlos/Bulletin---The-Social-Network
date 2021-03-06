<?php
	class Comentario{
		private $id;
		private $comentario;
		private $id_usuario;
		private $id_publicacao;
		private $data_comentario;
		
		/* Set */
		public function setID($id) {$this->id = $id; return;}
		
		public function setComentario($comentario) {
			if($comentario != ""){
				$this->comentario = htmlentities($comentario);
				return true;
			}else {
				return false;	
			}
		}
		
		public function setIDPublicacao($id_publicacao) {$this->id_publicacao = $id_publicacao; return;}
		public function setDataComentario($data_comentario) {$this->data_comentario = $data_comentario; return;}
		
		/* Get */
		public function getID() {return $this->id;}
		public function getComentario() {return $this->comentario;}
		public function getIDPublicacao() {return $this->id_publicacao;}
		public function getDataComentario() {return $this->data_comentario;}
	}
?>