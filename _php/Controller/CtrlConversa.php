<?php
	class CtrlConversa{
		function listarConversas(){
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT * FROM conversa WHERE endereco_de = '".$_SESSION['endereco']."' OR endereco_para = '".$_SESSION['endereco']."' LIMIT 20;");
				$result->execute();
				
				$count = 0;
				
				$conversas = array();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$conversas[$count][0] = $linha['id'];
					$conversas[$count][1] = $linha['endereco_de'];
					$conversas[$count][2] = $linha['endereco_para'];
					$conversas[$count][3] = $linha['mensagem'];
					$conversas[$count][4] = $linha['visto'];
					
					$count++;
				}
				
				return $conversas;
			}
		}
		
		function listarConversa($end_para){
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT * FROM conversa WHERE endereco_de = '".$_SESSION['endereco']."' AND endereco_para = '{$end_para}' OR endereco_para = '".$_SESSION['endereco']."' AND endereco_de = '{$end_para}' ORDER BY id DESC;");
				$result->execute();
				
				$count = 0;
				
				$conversas = array();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$conversas[$count][0] = $linha['id'];
					$conversas[$count][1] = $linha['endereco_de'];
					$conversas[$count][2] = $linha['endereco_para'];
					$conversas[$count][3] = $linha['mensagem'];
					$conversas[$count][4] = $linha['foto'];
					$conversas[$count][5] = $linha['visto'];
					
					$count++;
				}
				
				$result1 = $con->pdo->prepare("UPDATE conversa SET visto = true WHERE endereco_de = '".$_SESSION['endereco']."' AND endereco_para = '{$end_para}' OR endereco_para = '".$_SESSION['endereco']."' AND endereco_de = '{$end_para}';");
				$result1->execute();
				
				return $conversas;
			}
		}
		
		public function enviarMensagem($mensagem, $end_para, $foto) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("INSERT INTO conversa (endereco_de, endereco_para, mensagem".((!is_bool($foto))?", foto":"").", visto) VALUES ('".$_SESSION['endereco']."', '{$end_para}', '{$mensagem}'".((!is_bool($foto))?", '{$foto}'":"").", 0)");
				$result->execute();
				
				return;
			}
		}
		
		public function apagarMensagem($id) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT foto FROM conversa WHERE id = {$id}");
				$result->execute();
				
				$foto = "";
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$foto = $linha['foto'];
				}
				
				if($foto != "") {
					unlink($foto);
				}
				
				$result1 = $con->pdo->prepare("DELETE FROM conversa WHERE id = {$id};");
				$result1->execute();
				
				return;
			}
		}
	}
?>