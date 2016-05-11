<?php
	//require("_php/ClassDAO/Connect.php");
	
	class CtrlVideo{
		public function publicarVideo($nome_video, $id_usuario) {
			$con = new Connect();
			$con->conectar();
			$id_foto = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("INSERT INTO video (nome_video, id_usuario) VALUES ('$nome_video', '$id_usuario');");
				$result->execute();
				
				$result2 = $con->pdo->prepare("SELECT id FROM video WHERE id_usuario = '$id_usuario' AND nome_foto = '$nome_video';");
				$result2->execute();
				
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)){
					$id_foto = $linha['id'];
				}
				
				return $id_foto;
			}
		}
	}
?>