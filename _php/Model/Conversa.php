<?php
	class Conversa{
		private $id;
		private $end_de;
		private $end_para;
		private $mensagem;
		private $visto;
		
		/* Set */
		public function setID($id) {$this->id = $id; return true;}
		public function setEndDe($end_de) {$this->end_de = $end_de; return true;}
		public function setEndPara($end_para) {$this->end_para = $end_para; return true;}
		public function setMensagem($mensagem) {
			if($mensagem != "") {
				$this->mensagem = htmlentities($mensagem);
				return true;
			}else{
				return false;
			}
		}
		public function setVisto($visto) {$this->visto = $visto; return true;}
		
		/* Get */
		public function getID() {return $this->id;}
		public function getEndDe() {return $this->end_de;}
		public function getEndPara() {return $this->end_para;}
		public function getMensagem() {return $this->mensagem;}
		public function getVisto() {return $this->visto;}
		
	}
?>