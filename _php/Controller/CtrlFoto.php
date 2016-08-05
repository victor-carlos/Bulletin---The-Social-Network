<?php
	//require("_php/ClassDAO/Connect.php");
	
	class CtrlFoto{
		public function publicarFotoPub($nome_foto, $id_publicacao, $id_usuario) {
			$con = new Connect();
			$con->conectar();
			$id_foto = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("INSERT INTO foto (nome_foto, id_publicacao, id_usuario) VALUES ('".$nome_foto."', ".$id_publicacao.",".$id_usuario." );");
				$result->execute();
				
				return true;
			}else {
				return false;
			}
		}
		
	}
?>