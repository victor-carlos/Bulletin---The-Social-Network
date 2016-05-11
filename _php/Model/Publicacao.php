<?php
	//require("_php/Model/Foto.php");
	class Publicacao extends Foto{
		private $id;
		private $tachinha;
		private $cor;
		private $texto;
		private $data;
		private $id_foto;
		
		/* Set */
		public function setID($id) {$this->id = $id;}
		public function setTachinha($tachinha) {$this->tachinha = $tachinha;}
		public function setCor($cor) {$this->cor = htmlentities($cor);}
		public function setTexto($texto) {$this->texto = htmlentities($texto);}
		public function setData($data) {$this->data = $data;}
		public function setIDFoto($id_foto) {$this->id_foto = $id_foto;}
		
		/* Get */
		public function getID() {return $this->id;}
		public function getTachinha() {return $this->tachinha;}
		public function getCor() {return $this->cor;}
		public function getTexto() {return $this->texto;}
		public function getData() {return $this->data;}
		public function getIDFoto() {return $this->id_foto;}
		
	}
?>