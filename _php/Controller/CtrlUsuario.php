<?php
	require("_php/ClassDAO/Connect.php");
	
	class CtrlUsuario{
		public function cadastrarUsuario($nome, $sobrenome, $nickname, $dt_nasc, $email, $endereco, $sexo, $senha, $interesses, $sobre, $foto_perfil, $foto_capa, $linguagem, $pais, $estado) {
			$con = new Connect();
			$con->conectar();
			$id = "";
			$erro = false;
			
			if(!is_bool($con->pdo)) {
				
				$result1 = $con->pdo->prepare("SELECT * FROM usuario WHERE email = '".$email."'");
				$result1->execute();
				
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					$erro = ($linha['email'] == $email)?true:false;
				}
				
				if(!$erro){
					$result2 = $con->pdo->prepare("INSERT INTO usuario (nome, sobrenome, nickname, dt_nasc, email, endereco, sexo, senha, interesses, sobre, foto_perfil, foto_capa, linguagem, pais, estado, confirmado) VALUES ('".$nome."', '".$sobrenome."', '".$nickname."', '".$dt_nasc."', '".$email."', '".$endereco."', '".$sexo."', '".$senha."', '".$interesses."', '".$sobre."', '".$foto_perfil."', '".$foto_capa."', '".$linguagem."', '".$pais."', '".$estado."', false);");
					$result2->execute();
					
					return true;
				}else {
					return false;
				}
				
			}else {
				return false;
			}
		}
		
		public function logar($email, $senha) {
			$con = new Connect();
			$con->conectar();
			$id = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id, email, senha, confirmado, nome, sobrenome, endereco FROM usuario WHERE email = '".$email."' AND senha = '".$senha."';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					if($linha["email"] == $email && $linha["senha"] == $senha && $linha["confirmado"] = true){
						$id = $linha["id"];
					}
					
					if($linha["confirmado"] = false) {
						enviarConfirmacao($email, $linha["nome"], $linha["sobrenome"], $linha["endereco"]);
					}
				}
				
			}
			return $id;
		}
		
		public function getPerfil($id) {
			$con = new Connect();
			$con->conectar();
			$perfil = '';
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT * FROM usuario WHERE id = ".$id.";");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
						$perfil = array(0 => $linha["id"], 1 => $linha["nome"], 2 => $linha["sobrenome"], 3 => $linha["nickname"], 4 => $linha["dt_nasc"], 5 => $linha["email"], 6 => $linha["endereco"], 7 => $linha["sexo"], 8 => $linha["senha"], 9 => $linha["interesses"], 10 => $linha["sobre"], 11 => $linha["foto_perfil"], 12 => $linha["foto_capa"], 13 => $linha["linguagem"], 14 => $linha["pais"], 15 => $linha["estado"]);
				}
			}
			return $perfil;
		}
		
		public function pesquisarUsuario($rq) {
			$usuarios = "";
			$con = new Connect();
			$con->conectar();
			$usuarios = "";
			
			if(!is_bool($con->pdo)){
				$result = $con->pdo->prepare("SELECT id, foto_perfil, nome, sobrenome, nickname, estado, pais, endereco FROM usuario WHERE nome like '%".$rq."%' OR sobrenome like '%".$rq."%' OR endereco = '".$rq."' OR nickname like '%".$rq."%';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					if($linha['id'] > 0) {
						$usuarios .= '<div class="identification">
							<img src="'.$linha['foto_perfil'].'" alt="'.$linha["nome"].'">
							<a href="index.php?ref=Perfil&addr='.$linha["endereco"].'" >'.$linha["nome"].' '.$linha["sobrenome"].' ('.$linha["nickname"].') <br> - '.$linha["estado"].' - '.$linha["pais"].' </a>
						</div>
						<div class="bulletin"></div>';
					}else {
						$usuarios = "<h1>Nada encontrado</h1>";
					}
				}
			}
			return $usuarios;
		}
		
		public function searchUser($rq) {
			$usuarios = "";
			$con = new Connect();
			$con->conectar();
			$usuarios = "";
			
			if(!is_bool($con->pdo)){
				$result = $con->pdo->prepare("SELECT id, foto_perfil, nome, sobrenome, nickname, estado, pais, endereco FROM usuario WHERE nome like '%".$rq."%' OR sobrenome like '%".$rq."%' OR endereco = '".$rq."' OR nickname like '%".$rq."%';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					if($linha['id'] > 0) {
						$usuarios .= '<div class="identification">
							<img src="'.$linha['foto_perfil'].'" alt="'.$linha["nome"].'">
							<a href="index.php?ref=Perfil&addr='.$linha["endereco"].'" >'.$linha["nome"].' '.$linha["sobrenome"].' ('.$linha["nickname"].') <br> - '.$linha["estado"].' - '.$linha["pais"].' </a>
						</div>
						<div class="bulletin"></div>';
					}else {
						$usuarios = "<h1>Not found.</h1>";
					}
				}
			}
			return $usuarios;
		}
		
		public function nomeSobrenomeNickname($addr) {
			$con = new Connect();
			$con->conectar();
			$dados = "";
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT nome, sobrenome, nickname FROM usuario WHERE endereco = '".$addr."';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dados = $linha["nome"].' '.$linha["sobrenome"].' ('.$linha["nickname"].')';
					
				}
			}
			
			return $dados;
		}
		
		public function getPerfilPost($id) {
			$con = new Connect();
			$con->conectar();
			$dados = "";
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT nome, sobrenome, nickname, endereco, foto_perfil, pais, estado FROM usuario WHERE id = '".$id."';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dados = array(0 => $linha['nome'], 1 => $linha['sobrenome'], 2 => $linha['nickname'], 3 => $linha['endereco'], 4 => $linha['foto_perfil'], 5 => $linha['pais'], 6 => $linha['estado']);
					
				}
			}
			
			return $dados;
		}
		
		public function idadePessoa($endereco) {
			$con = new Connect();
			$con->conectar();
			$isAmigo = false;
			$dt_nasc = "";
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT dt_nasc FROM usuario WHERE endereco = '$endereco';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dt_nasc = $linha['dt_nasc'];
				}
				
				$ano = explode("-", $dt_nasc);
				$idade = date('Y') - $ano[0];
			}
			
			return ($ano[1] > 12 && $ano[1] > 31)?($idade - 1):$idade;
		}
		
		public function fotoCapa($addr) {
			$con = new Connect();
			$con->conectar();
			$foto_capa = "";
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT foto_capa FROM usuario WHERE endereco = '$addr';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$foto_capa = $linha['foto_capa'];
					
				}
				
			}
			
			return $foto_capa;
		}
		
		public function fotoPerfil($addr) {
			$con = new Connect();
			$con->conectar();
			$foto_perfil = "";
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT foto_perfil FROM usuario WHERE endereco = '$addr';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$foto_perfil = $linha['foto_perfil'];
					
				}
				
			}
			
			return $foto_perfil;
		}
		
		public function apresentacao($addr) {
			$con = new Connect();
			$con->conectar();
			$sobre = "";
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT sobre FROM usuario WHERE endereco = '$addr';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$sobre = $linha['sobre'];
					
				}
			}
			
			return $sobre;
		}
		
		public function interesses($addr) {
			$con = new Connect();
			$con->conectar();
			$interesses = "";
			$arr_interesses = array();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT interesses FROM usuario WHERE endereco = '$addr';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$interesses = $linha['interesses'];
				}
				
				$arr_interesses = explode("; " , $interesses);
				$interesses = "";
				$count = (count($arr_interesses)) - 1;
				for($i = 0; $i < $count; $i++) {
					if($_COOKIE['lang'] == "pt-BR") {
						if($arr_interesses[$i] == "Network") {$interesses .= "Network; ";}
						if($arr_interesses[$i] == "Amizade" || $arr_interesses[$i] == "Friendship") {$interesses .= "Amizade; ";}
						if($arr_interesses[$i] == "Um relacionamento" || $arr_interesses[$i] == "A relationship") {$interesses .= "Um relacionamento; ";}
						if($arr_interesses[$i] == "Namoro" || $arr_interesses[$i] == "Dating") {$interesses .= "Namoro; ";}
						
					}else {
						if($arr_interesses[$i] == "Network") {$interesses .= "Network; ";}
						if($arr_interesses[$i] == "Amizade" || $arr_interesses[$i] == "Friendship") {$interesses .= "Friendship; ";}
						if($arr_interesses[$i] == "Um relacionamento" || $arr_interesses[$i] == "A relationship") {$interesses .= "A relationship; ";}
						if($arr_interesses[$i] == "Namoro" || $arr_interesses[$i] == "Dating") {$interesses .= "Dating; ";}
					}
				}
			}
			
			return $interesses;
		}
		
		public function solicitarAmizade($addr, $id) {
			$con = new Connect();
			$con->conectar();
			$id2 = "";
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id_amigo FROM amigo WHERE endereco_amigo = '$addr';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id2 = $linha['id_amigo'];
					
				}
				
				$result2 = $con->pdo->prepare("INSERT INTO amigo (id_usuario, id_amigo, endereco_amigo, confirmado) VALUES({$id}, {$id2}, '$addr', false);");
				$result2->execute();
				
				$result3 = $con->pdo->prepare("INSERT INTO notificacao (id_usuario, id_amigo) VALUES ({$id}, {$id2})");
				$result3->execute();
				
			}
			return;
			
		}
		
		public function aprovarAmizade($addr, $endereco_amigo) {
			$con = new Connect();
			$con->conectar();
			$isAmigo = false;
			$id_amigo = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id FROM usuario WHERE endereco = '$endereco_amigo';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id_amigo = $linha['id'];
					//echo $id_amigo;
				}
				
				$result2 = $con->pdo->prepare("UPDATE amigo SET confirmado = true WHERE endereco_amigo = '$addr' AND id_usuario = {$id_amigo};");
				$result2->execute();
				
				//$result3 = $con->pdo->prepare("INSERT INTO amigo (id_usuario, id_amigo, endereco_amigo, confirmado) VALUES ({$id_amigo}, {$_SESSION['id']}, {$_SESSION['endereco']}, true);");
				//$result3->execute();
				
			}
			return;
		}
		
		public function desfazerSolicitacao($addr, $id) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id_amigo FROM amigo WHERE endereco_amigo = '$addr';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id2 = $linha['id_amigo'];
					
				}
				
				$result2 = $con->pdo->prepare("DELETE FROM amigo WHERE endereco_amigo = '$addr' AND id_usuario = {$id};");
				$result2->execute();
				
				$result3 = $con->pdo->prepare("DELETE FROM notificacao WHERE id_usuario = {$id} AND id_amigo = {$id2};");
				$result3->execute();
			}
		}
		
		public function infoBasico($endereco) {
			$con = new Connect();
			$con->conectar();
			$dados = "";
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT nome, sobrenome, nickname, sexo, estado, pais FROM usuario WHERE endereco = '".$endereco."';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dados = array(0 => $linha['nome'], 1 => $linha['sobrenome'], 2 => $linha['nickname'], 3 => $linha['sexo'], 4 => $linha['estado'], 5 => $linha['pais']);
					
				}
			}
			
			return $dados;
		}
		
		public function isAmigo($addr, $endereco_amigo) {
			$con = new Connect();
			$con->conectar();
			$isAmigo = false;
			$id_amigo = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id FROM usuario WHERE endereco = '$endereco_amigo';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id_amigo = $linha['id'];
					//echo $id_amigo;
				}
				
				$result2 = $con->pdo->prepare("SELECT confirmado FROM amigo WHERE endereco_amigo = '$addr' OR id_amigo = {$id_amigo};");
				$result2->execute();
				
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)){
					$isAmigo = $linha['confirmado'];
					//echo "ok";
				}
				
			}
			//echo $isAmigo;
			return $isAmigo;
		}
		
		public function isSolicitado($addr, $endereco_amigo) {
			$con = new Connect();
			$con->conectar();
			$isAmigo = false;
			$id_amigo = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id FROM usuario WHERE endereco = '$endereco_amigo';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id_amigo = $linha['id'];
					//echo $id_amigo;
				}
				
				$result2 = $con->pdo->prepare("SELECT confirmado FROM amigo WHERE endereco_amigo = '$endereco_amigo' AND id_amigo = {$id_amigo} AND confirmado = false;");
				$result2->execute();
				
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)){
					$isAmigo = true;
					//echo $linha['confirmado'];
				}
				
			}
			//echo $endereco_amigo;
			return ($isAmigo)?true:false;
		}
		
		public function selecionaUsuario($id_publicacao) {
			$con = new Connect();
			$con->conectar();
			$dadosUsuario = array();
			$id_usuario = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id_usuario FROM publicacao WHERE id = {$id_publicacao};");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id_usuario = $linha['id_usuario'];
				}
				
				$result1 = $con->pdo->prepare("SELECT confirmado, endereco_amigo FROM amigo WHERE id_usuario = {$id_usuario} AND id_amigo = {$id_usuario};");
				$result1->execute();
				
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					$dadosUsuario = array(0 => $linha['confirmado'], 1 => $linha['endereco_amigo']);
				}
				
			}
			
			return $dadosUsuario;
		}
		
		public function selecionaAmigo($id_amigo) {
			$con = new Connect();
			$con->conectar();
			$dadosAmigo = array();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id, nome, sobrenome, nickname, foto_perfil, endereco FROM usuario WHERE id = {$id_amigo};");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dadosAmigo = array(0 => $linha['id'], 1 => $linha['nome'], 2 => $linha['sobrenome'], 3 => $linha['nickname'], 4 => $linha['foto_perfil'], 5 => $linha['endereco']);
				}
			
			}
			
			return $dadosAmigo;
		}
		
		public function getInteresses($interesse){
			$con = new Connect();
			$con->conectar();
			$condicao = false;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT interesses FROM usuario WHERE id = ".$_SESSION['id'].";");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$interesses = explode("; ", $linha['interesses']);
					for($i = 0; $i < (count($interesses) - 1); $i++){
						if($interesses[$i] == $interesse){
							$condicao = true;
						}
					}
				}
			
			}
			
			return $condicao;
		}
		
		public function getLinguagem(){
			$con = new Connect();
			$con->conectar();
			$linguagem = false;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT linguagem FROM usuario WHERE id = ".$_SESSION['id'].";");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$linguagem = $linha['linguagem'];
					
				}
			
			}
			
			return $linguagem;
		}
		
		public function atualizaDadosPessoais($nome, $sobrenome, $nickname, $pais, $estado, $dt_nasc, $sexo, $interesses, $linguagem) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("UPDATE usuario SET nome = '$nome', sobrenome = '$sobrenome', nickname = '$nickname', pais = '$pais', estado = '$estado', dt_nasc = '$dt_nasc', sexo = '$sexo', interesses = '$interesses', linguagem = '$linguagem' WHERE id = ".$_SESSION['id'].";");
				$result->execute();
				
			}
			
			return;
		}
		
		public function atualizarSobre($sobre) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("UPDATE usuario SET sobre = '$sobre'  WHERE id = ".$_SESSION['id'].";");
				$result->execute();
				
			}
			
			return;
		}
		
		public function atualizarAuth($senha, $antigaSenha) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("UPDATE usuario SET senha = '$senha'  WHERE id = ".$_SESSION['id']." AND senha = '$antigaSenha';");
				$result->execute();
				
			}
			
			return;
		}
		
		public function atualizarFotoPerfil($foto_perfil) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("UPDATE usuario SET foto_perfil = '$foto_perfil'  WHERE id = ".$_SESSION['id'].";");
				$result->execute();
				
			}
			
			return;
		}
		
		public function atualizarFotoCapa($foto_capa) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("UPDATE usuario SET foto_capa = '$foto_capa'  WHERE id = ".$_SESSION['id'].";");
				$result->execute();
				
			}
			
			return;
		}
		
		public function enviarConfirmacao($email, $nome, $sobrenome, $endereco) {
			$con = new Connect();
			$con->conectar();
			
			if($_COOKIE['lang'] == "pt-BR") {
				$mensagem = "<h1>Bem vindo ao Bulletin, {$nome} {$sobrenome}!</h1><br><br>Para confirmar sua conta, <a href='www.bulletin.com/index.php?validation={$endereco}'>clique aqui.</a><br>Ou copie e cole no navegador este endereço: www.bulletin.com/index.php?validation={$endereco}";
			}else {
				$mensagem = "<h1>Welcome to Bulletin, {$nome} {$sobrenome}!</h1><br><br>To confirm your account, <a href='www.bulletin.com/index.php?validation={$endereco}'>click here.</a><br>Or copy and paste into browser this address: www.bulletin.com/index.php?validation={$endereco}";
			}
			
			$headers = "Content-Type:text/html; charset=UTF-8\n";
			$headers .= "From: ".$nome."".$sobrenome."< " . $email . " >\n";
			$headers .= "X-Sender: <noreply.bulletin.com>\n";
			$headers .= "X-Mailer: PHP v".phpversion()."\n";
			$headers .= "X-IP: ". $_SERVER['REMOTE_ADDR'] ."\n";
			$headers .= "Return-Path: ". $email ."\n";
			$headers .= "MIME-Version: 1.0\n";
			
			if(mail($email, "Confirmação de conta do Bulletin", $mensagem, $headers)) {
				return true;
			}else {
				return false;
			}
		}
		
		public function confirmarUsuario($endereco){
			$con = new Connect();
			$con->conectar();
			$confirmado = false;
			
			if(!is_bool($con->pdo)) {
				
				$result1 = $con->pdo->prepare("SELECT confirmado FROM usuario WHERE endereco = '".$endereco."'");
				$result1->execute();
				
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					$confirmado = $linha['confirmado'];
				}
				
				if(!$confirmado){
					$result2 = $con->pdo->prepare("UPDATE usuario SET confirmado = true WHERE endereco = '".$endereco."';");
					$result2->execute();
					
					$result3 = $con->pdo->prepare("SELECT id FROM usuario WHERE endereco = '".$endereco."';");
					$result3->execute();
					
					while ($linha = $result3->fetch(PDO::FETCH_ASSOC)){
						$id = $linha["id"];
					}
					
					$result4 = $con->pdo->prepare("SELECT id FROM amigo WHERE id_usuario = {$id} AND id_amigo = {$id};");
					$result4->execute();
					
					while ($linha = $result4->fetch(PDO::FETCH_ASSOC)){
						$id2 = $linha["id"];
					}
					
					if($id2 <= 0){
						$result5 = $con->pdo->prepare("INSERT INTO amigo (id_usuario, id_amigo, endereco_amigo, confirmado) VALUES ('$id', '$id', '$endereco', 1);");
						$result5->execute();
					}
					
					return true;
				}else {
					return false;
				}
				
			}else {
				return false;
			}
		}
		
		public function meusAmigos($endereco) {
			$con = new Connect();
			$con->conectar();
			$id_amigo = "";
			$id = 0;
			$dados = "";
			
			if(!is_bool($con->pdo)) {
				
				$result = $con->pdo->prepare("SELECT id FROM usuario WHERE endereco = '".$endereco."';");
				$result->execute();
				
				$count = 0;
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id = $linha['id'];
				}
				
				$result1 = $con->pdo->prepare("SELECT id_usuario, id_amigo FROM amigo WHERE ".(($endereco == $_SESSION['endereco'])?'id_usuario':'id_amigo')." = '".$id."' AND confirmado = true;");
				$result1->execute();
				
				$count = 0;
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
				//echo $linha['id_usuario'] . "-" . $linha['id_amigo'];
					if($count == 0){
						$id_amigo = " id = " . (($endereco == $_SESSION['endereco'])?$linha['id_amigo']:$linha['id_usuario']);
					}else {
						$id_amigo =" OR id = " . (($endereco == $_SESSION['endereco'])?$linha['id_amigo']:$linha['id_usuario']);
					}
				}
				//echo $id_amigo;
				$result2 = $con->pdo->prepare("SELECT id, nome, sobrenome, nickname, foto_perfil, endereco FROM usuario WHERE {$id_amigo}");
				$result2->execute();
				
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)){
					$dados .= '<a href="index.php?ref='.(($_COOKIE['lang'] == "pt-BR")?"Perfil":"Profile").'&addr='.$linha["endereco"].'"><figure>
								<img src="'.$linha["foto_perfil"].'" alt="'.$linha["nome"].' '.$linha["sobrenome"].'">
								<figcaption>
									'.$linha["nome"].' '.$linha["sobrenome"].' ('.$linha["nickname"].')
								</figcaption>
							</figure></a>';
				}
				
				return $dados;
			}
		}
	}
	
?>