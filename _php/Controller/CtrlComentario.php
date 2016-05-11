<?php
	class CtrlComentario{
		function comentar($comentario, $id_usuario, $id_publicacao, $foto_perfil, $nome, $sobrenome, $endereco) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("INSERT INTO comentario (comentario, id_usuario, id_publicacao, foto_perfil, nome, sobrenome, endereco) VALUES ('$comentario', {$id_usuario}, {$id_publicacao}, '$foto_perfil', '$nome', '$sobrenome', '$endereco')");
				$result->execute();
			}
			return;
		}
		
		function removerComentario($id_comentario) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("DELETE FROM comentario WHERE id = '$id_comentario';");
				$result->execute();
			}
			return;
		}
		
		function listarComentario($id_post) {
			$con = new Connect();
			$con->conectar();
			$comentarios = "";
			$nome = "";
			$sobrenome = "";
			
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT * FROM comentario WHERE id_publicacao = {$id_post} ORDER BY data_comentario;");
				$result->execute();
				
				
				$count = 0;
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$comentarios .= '<div class="identification">
									<img src="'.$linha["foto_perfil"].'" alt="">
									<a href="index.php?ref=Perfil&addr='.$linha["endereco"].'">'.$linha["nome"].' '.$linha["sobrenome"].' <br> '.$linha["data_comentario"].'</a>
								</div>
								<div class="comentarios">
									<p>'.$linha["comentario"].'</p>
								</div>';
					$count++;
				}
				
			}
			return array(0 => $count, 1 => $comentarios);
		}
		
	}
?>