<?php
	class Usuario{
		
		private $id;
		private $nome;
		private $pais;
		private $estado;
		private $linguagem;
		private $sobrenome;
		private $nickname;
		private $dt_nasc;
		private $email;
		private $endereco;
		private $sexo;
		private $senha;
		private $interesses;
		private $sobre;
		private $foto_capa;
		private $foto_perfil;
		
		
		/* Set */
		public function setId($id) {$this->id = $id;}
		
		public function setNome($nome) {
			if($nome != "") {
				$this->nome = ucwords(htmlentities($nome));
				return true;
			}else {
				return false;
			}
		}
		
		public function setSobrenome($sobrenome) {
			if($sobrenome != "") {
				$this->sobrenome = ucwords(htmlentities($sobrenome));
				return true;
			}else {
				return false;
			}
		}
		
		public function setNickname($nickname) {
			if($nickname != "") {
				$this->nickname = htmlentities($nickname);
				return true;
			}else {
				return false;
			}
		}
		
		public function setPais($pais) {
			if($pais != "") {
				$this->pais = ucwords(htmlentities($pais));
				return true;
			}else {
				return false;
			}
		}
		
		public function setEstado($estado) {
			if($estado != "") {
				$this->estado = ucwords(htmlentities($estado));
				return true;
			}else {
				return false;
			}
		}
		
		public function setLinguagem($linguagem) {
			if($linguagem != "") {
				$this->linguagem = $linguagem;
				return true;
			}else {
				return false;
			}
		}
		
		public function setDtNasc($dt_nasc) {
			$arr_dt_nasc1 = explode("/", $dt_nasc);
			$arr_dt_nasc2 = explode("-", $dt_nasc);
			
			
			if(count($arr_dt_nasc1) == 3){
				if($arr_dt_nasc1[0] <= 31 && $arr_dt_nasc1[1] <= 12 && $arr_dt_nasc1[2] < (date("Y") - 16) && $_COOKIE['lang'] == "pt-BR") {
					$this->dt_nasc = strtotime(str_replace("/", "-", $dt_nasc));
					return true;
					
				}elseif($arr_dt_nasc1[0] <= 12 && $arr_dt_nasc1[1] <= 31 && $arr_dt_nasc1[2] < (date("Y") - 16)) {
					$this->dt_nasc = strtotime($arr_dt_nasc1[2]."-".$arr_dt_nasc1[0]."-".$arr_dt_nasc1[1]);
					return true;
				}elseif($arr_dt_nasc1[1] <= 12 && $arr_dt_nasc1[2] <= 31 && $arr_dt_nasc1[0] < (date("Y") - 16)) {
					$this->dt_nasc = strtotime($arr_dt_nasc1[2]."-".$arr_dt_nasc1[1]."-".$arr_dt_nasc1[0]);
					return true;
				}elseif($arr_dt_nasc1[2] <= 12 && $arr_dt_nasc1[1] <= 31 && $arr_dt_nasc1[0] < (date("Y") - 16)) {
					$this->dt_nasc = strtotime($arr_dt_nasc1[2]."-".$arr_dt_nasc1[0]."-".$arr_dt_nasc1[1]);
					return true;
				}else {
					return false;
				}
				
			}elseif(count($arr_dt_nasc2) == 3) {
				if($arr_dt_nasc2[0] <= 31 && $arr_dt_nasc2[1] <= 12 && $arr_dt_nasc2[2] < (date("Y") - 16) && $_COOKIE['lang'] == "pt-BR") {
					$this->dt_nasc = strtotime($dt_nasc);
					return true;
					
				}elseif($arr_dt_nasc2[0] <= 12 && $arr_dt_nasc2[1] <= 31 && $arr_dt_nasc2[2] < (date("Y") - 16)) {
					$this->dt_nasc = strtotime($arr_dt_nasc2[2]."-".$arr_dt_nasc2[0]."-".$arr_dt_nasc2[1]);
					return true;
				}elseif($arr_dt_nasc2[1] <= 12 && $arr_dt_nasc2[2] <= 31 && $arr_dt_nasc2[0] < (date("Y") - 16)) {
					$this->dt_nasc = strtotime($arr_dt_nasc2[2]."-".$arr_dt_nasc2[1]."-".$arr_dt_nasc2[0]);
					return true;
				}elseif($arr_dt_nasc2[2] <= 12 && $arr_dt_nasc2[1] <= 31 && $arr_dt_nasc2[0] < (date("Y") - 16)) {
					$this->dt_nasc = strtotime($arr_dt_nasc2[2]."-".$arr_dt_nasc2[0]."-".$arr_dt_nasc2[1]);
					return true;
				}else {
					return false;
				}
			}else {
				return false;
			}
		}
		
		public function setEmail($email) {
			
			if($email != "" && (count(explode("@", $email))) == 2){
				$this->email = htmlentities($email);
				return true;
			}else {
				return false;
			}
		}
		
		public function setEndereco($endereco) {
			if($endereco != "") {
				$this->endereco = $endereco;
				return true;
			}else {
				return false;
			}
		}
		
		public function setSexo($sexo) {
			if($sexo != "") {
				$this->sexo = htmlentities($sexo);
				return true;
			}else {
				return false;
			}
		}
		
		public function setSenha($senha) {
			if($senha != "") {
				$this->senha = MD5(htmlentities($senha));
				return true;
			}else {
				return false;
			}
		}
		
		public function setInteresses($interesses) {$this->interesses = $interesses;}
		
		public function setSobre($sobre) {$this->sobre = $sobre;}
		
		public function setFotoCapa($foto_capa) {$this->foto_capa = $foto_capa;}
		
		public function setFotoPerfil($foto_perfil) {$this->foto_perfil = $foto_perfil;}
		
		/* Get */
		public function getID() {return $this->id;}
		public function getNome() {return $this->nome;}
		public function getSobrenome() {return $this->sobrenome;}
		public function getNickname() {return $this->nickname;}
		public function getPais() {return $this->pais;}
		public function getEstado() {return $this->estado;}
		public function getLinguagem() {return $this->linguagem;}
		
		public function getDtNasc($padrao) {
			return date($padrao, $this->dt_nasc);
		}
			
		public function getEmail() {return $this->email;}
		public function getEndereco() {return $this->endereco;}
		public function getSexo() {return $this->sexo;}
		public function getSenha() {return $this->senha;}
		public function getInteresses() {return $this->interesses;}
		public function getSobre() {return $this->sobre;}
		public function getFotoCapa() {return $this->foto_capa;}
		public function getFotoPerfil() {return $this->foto_perfil;}
	}
?>