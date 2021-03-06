<?php
	
	class CtrlNotificacao{
		public function getNotificacoes($id_usuario){
			$con = new Connect();
			$con->conectar();
			$cont = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT visto FROM notificacao WHERE id_usuario = {$id_usuario} OR id_amigo = {$id_usuario} GROUP BY visto DESC LIMIT 50;");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					if(!$linha['visto']){
						$cont++;
					}
				}
			}
			
			return $cont;
		}
		
		public function listNotifications($id_usuario){
			$con = new Connect();
			$con->conectar();
			
			$ctrlUsuario = new CtrlUsuario();
			$ctrlPublicacao = new CtrlPublicacao();
			
			$id = array();
			$id_amigo = array();
			$id_publicacao;
			$data_publicacao;
			$notify = "";
			$visto = "";
			$nome;
			$sobrenome;
			$nickname;
			$foto_perfil = array();
			$endereco = array();
			$endereco_amigo = array();
			$ctNotificacoes = 0;
			$confirmado = array();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT * FROM notificacao WHERE id_usuario = {$id_usuario} OR id_amigo = {$id_usuario} ORDER BY id DESC;");
				$result->execute();
				
				$count = 0;
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dados1[$count] = $ctrlUsuario->selecionaUsuario($linha['id_publicacao']);
					
					/*Solução para o Bug do Último Usuário*/
					//echo (($linha['id_publicacao'] == 0)?(($linha['id_usuario'] != $_SESSION['id'])?$linha['id_usuario']:$linha['id_amigo']):$linha['id_usuario']);
					
					/*Bug do Último Usuário*/
					//(($linha['id_publicacao'] == null)?$linha['id_amigo']:$linha['id_usuario'])
					
					$dados2[$count] = $ctrlUsuario->selecionaAmigo((($linha['id_publicacao'] == 0)?(($linha['id_usuario'] != $_SESSION['id'])?$linha['id_usuario']:$linha['id_amigo']):$linha['id_usuario']));
					
					if($count == 0) {
						$visto .= " id = " . $linha['id'];
					}else{
						$visto .= " OR id = " . $linha['id'];
					}
					
					$id_usuario[$count] = (($linha['id_publicacao'] == 0)?$linha['id_amigo']:$linha['id_usuario']);
					$id_amigo[$count] = $linha['id_amigo'];
					$data_notificacao[$count] = $linha['data_notificacao'];
					$id_publicacao[$count] = $linha['id_publicacao'];
					
					$count++;
					
				}
				
				$ctNotificacoes = $count;
				
				//echo var_dump($dados1);
				
				//if(isset($dados1[0][0])){
					//return;
				//}
				
				//echo var_dump($dados1) . "<br><br>";
				//echo var_dump($dados2);
				
				$count = 0;
				while($count < $ctNotificacoes) {
					//echo $dados2[$count][5] . "-";
					if((isset($dados1[$count][1])?$dados1[$count][1]:0) == $_SESSION['endereco']){
						$notify .= '<div class="identification">
						<img src="'.$_SESSION["foto_perfil"].'" alt="" />
						<a href="index.php?ref=Profile&addr='.$_SESSION["endereco"].'" >'.$_SESSION['nome'].' '.$_SESSION['sobrenome'].' ('.$_SESSION['nickname'].') <br> '.$data_notificacao[$count].' </a>
						<p class="float-right">
						<a href="index.php?ref=Bulletin&bulletin='.$id_publicacao[$count].'">Scored the own Newsletter</a>
						</p>
						</div>
						<div class="bulletin">
						</div>';
						$count++;
					}elseif((isset($dados1[$count][1])?$dados1[$count][1]:0) != $_SESSION['endereco'] && isset($dados1[$count][0])) {
						$notify .= '<div class="identification">
						<img src="'.$dados2[$count][4].'" alt="">
						<a href="index.php?ref=Profile&addr='.$dados2[$count][5].'" >'.$dados2[$count][1].' '.$dados2[$count][2].' ('.$dados2[$count][3].') <br> '.$data_notificacao[$count].' </a>
						<p class="float-right">
						<a href="index.php?ref=Bulletin&bulletin='.$id_publicacao[$count].'">Scored a Newsletter</a>
						</p>
						</div>
						<div class="bulletin">
						</div>';
						
						$count++;
					}elseif($dados2[$count][0] == $id_amigo[$count] && $ctrlUsuario->isSolicitado($_SESSION['endereco'], $dados2[$count][5])) {
						$notify .= '<div class="identification">
						<img src="'.$dados2[$count][4].'" alt="">
						<a href="index.php?ref=Profile&addr='.$dados2[$count][5].'" >'.$dados2[$count][1].' '.$dados2[$count][2].' ('.$dados2[$count][3].') <br> '.$data_notificacao[$count].' </a>
						<p class="float-right">
						<form action="" method="post">
						<input class="float-right" type="submit" name="remove_solicitacao" value="Remove Request Friendship" />
						</form>
						</p>
						</div>
						<div class="bulletin">
						</div>';
						$count++;
					}elseif(!isset($dados1[$count][0]) && !$ctrlUsuario->isAmigo($_SESSION['endereco'], $dados2[$count][5])) {
						$notify .= '<div class="identification">
						<img src="'.$dados2[$count][4].'" alt="">
						<a href="index.php?ref=Profile&addr='.$dados2[$count][5].'" >'.$dados2[$count][1].' '.$dados2[$count][2].' ('.$dados2[$count][3].') <br> '.$data_notificacao[$count].' </a>
						<p class="float-right">
						<form action="" method="post">
						<input type="submit" name="aprovar_amizade" value="Accept friend request" />
						<input type="hidden" name="id_amigo" value="'.$id[$count].'" />
						<input type="hidden" name="addr" value="'.$dados2[$count][5].'" />
						<input type="submit" name="rejeitar_amizade" value="Reject" />
						</form>
						</p>
						</div>
						<div class="bulletin">
						</div>';
						$count++;
					}else {
						if((isset($dados1[$count][1])?$dados1[$count][1]:0) != $_SESSION['endereco']){
							$notify .= '<div class="identification">
							<img src="'.$dados2[$count][4].'" alt="">
							<a href="index.php?ref=Profile&addr='.$dados2[$count][5].'" >'.$dados2[$count][1].' '.$dados2[$count][2].' ('.$dados2[$count][3].') <br> '.$data_notificacao[$count].' </a>
							<p class="float-right">
							Friends&nbsp;&nbsp;&nbsp;&nbsp;
							</p>
							</div>
							<div class="bulletin">
							</div>';
						}
						$count++;
					}
				}
				
			}
			
			//echo $visto;
			
			if($visto != ""){
				$result1 = $con->pdo->prepare("UPDATE notificacao SET visto = true WHERE ". $visto .";");
				$result1->execute();
			}
			
			return $notify;
		}
		
		public function listarNotificacoes($id_usuario){
			$con = new Connect();
			$con->conectar();
			
			$ctrlUsuario = new CtrlUsuario();
			$ctrlPublicacao = new CtrlPublicacao();
			
			$id = array();
			$id_amigo = array();
			$id_publicacao;
			$data_publicacao;
			$notify = "";
			$visto = "";
			$nome;
			$sobrenome;
			$nickname;
			$foto_perfil = array();
			$endereco = array();
			$endereco_amigo = array();
			$ctNotificacoes = 0;
			$confirmado = array();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT * FROM notificacao WHERE id_usuario = {$id_usuario} OR id_amigo = {$id_usuario} ORDER BY id DESC;");
				$result->execute();
				
				$count = 0;
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$dados1[$count] = $ctrlUsuario->selecionaUsuario($linha['id_publicacao']);
					
					/*Solução para o Bug do Último Usuário*/
					//echo (($linha['id_publicacao'] == 0)?(($linha['id_usuario'] != $_SESSION['id'])?$linha['id_usuario']:$linha['id_amigo']):$linha['id_usuario']);
					
					/*Bug do Último Usuário*/
					//(($linha['id_publicacao'] == null)?$linha['id_amigo']:$linha['id_usuario'])
					
					$dados2[$count] = $ctrlUsuario->selecionaAmigo((($linha['id_publicacao'] == 0)?(($linha['id_usuario'] != $_SESSION['id'])?$linha['id_usuario']:$linha['id_amigo']):$linha['id_usuario']));
					
					if($count == 0) {
						$visto .= " id = " . $linha['id'];
					}else{
						$visto .= " OR id = " . $linha['id'];
					}
					
					$id_usuario[$count] = (($linha['id_publicacao'] == 0)?$linha['id_amigo']:$linha['id_usuario']);
					$id_amigo[$count] = $linha['id_amigo'];
					$data_notificacao[$count] = $linha['data_notificacao'];
					$id_publicacao[$count] = $linha['id_publicacao'];
					
					$count++;
					
				}
				
				$ctNotificacoes = $count;
				
				//echo var_dump($dados1);
				
				//if(isset($dados1[0][0])){
					//return;
				//}
				
				//echo var_dump($dados1) . "<br><br>";
				//echo var_dump($dados2);
				
				$count = 0;
				while($count < $ctNotificacoes) {
					//echo $dados2[$count][5] . "-";
					if((isset($dados1[$count][1])?$dados1[$count][1]:0) == $_SESSION['endereco']){
						$notify .= '<div class="identification">
						<img src="'.$_SESSION["foto_perfil"].'" alt="" />
						<a href="index.php?ref=Perfil&addr='.$_SESSION["endereco"].'" >'.$_SESSION['nome'].' '.$_SESSION['sobrenome'].' ('.$_SESSION['nickname'].') <br> '.$data_notificacao[$count].' </a>
						<p class="float-right">
						<a href="index.php?ref=Boletim&boletim='.$id_publicacao[$count].'">Marcou o próprio boletim</a>
						</p>
						</div>
						<div class="bulletin">
						</div>';
						$count++;
					}elseif((isset($dados1[$count][1])?$dados1[$count][1]:0) != $_SESSION['endereco'] && isset($dados1[$count][0])) {
						$notify .= '<div class="identification">
						<img src="'.$dados2[$count][4].'" alt="">
						<a href="index.php?ref=Perfil&addr='.$dados2[$count][5].'" >'.$dados2[$count][1].' '.$dados2[$count][2].' ('.$dados2[$count][3].') <br> '.$data_notificacao[$count].' </a>
						<p class="float-right">
						<a href="index.php?ref=Boletim&boletim='.$id_publicacao[$count].'">Marcou um boletim</a>
						</p>
						</div>
						<div class="bulletin">
						</div>';
						
						$count++;
					}elseif($dados2[$count][0] == $id_amigo[$count] && $ctrlUsuario->isSolicitado($_SESSION['endereco'], $dados2[$count][5])) {
						$notify .= '<div class="identification">
						<img src="'.$dados2[$count][4].'" alt="">
						<a href="index.php?ref=Perfil&addr='.$dados2[$count][5].'" >'.$dados2[$count][1].' '.$dados2[$count][2].' ('.$dados2[$count][3].') <br> '.$data_notificacao[$count].' </a>
						<p class="float-right">
						<form action="" method="post">
						<input class="float-right" type="submit" name="remove_solicitacao" value="Remover Solicitação de amizade" />
						</form>
						</p>
						</div>
						<div class="bulletin">
						</div>';
						$count++;
					}elseif(!isset($dados1[$count][0]) && !$ctrlUsuario->isAmigo($_SESSION['endereco'], $dados2[$count][5])) {
						$notify .= '<div class="identification">
						<img src="'.$dados2[$count][4].'" alt="">
						<a href="index.php?ref=Perfil&addr='.$dados2[$count][5].'" >'.$dados2[$count][1].' '.$dados2[$count][2].' ('.$dados2[$count][3].') <br> '.$data_notificacao[$count].' </a>
						<p class="float-right">
						<form action="" method="post">
						<input type="submit" name="aprovar_amizade" value="Aceitar solicitação de amizade" />
						<input type="hidden" name="id_amigo" value="'.$id_amigo[$count].'" />
						<input type="hidden" name="addr" value="'.$dados2[$count][5].'" />
						<input type="submit" name="rejeitar_amizade" value="Rejeitar" />
						</form>
						</p>
						</div>
						<div class="bulletin">
						</div>';
						$count++;
					}else {
						if((isset($dados1[$count][1])?$dados1[$count][1]:0) != $_SESSION['endereco']){
							$notify .= '<div class="identification">
							<img src="'.$dados2[$count][4].'" alt="">
							<a href="index.php?ref=Perfil&addr='.$dados2[$count][5].'" >'.$dados2[$count][1].' '.$dados2[$count][2].' ('.$dados2[$count][3].') <br> '.$data_notificacao[$count].' </a>
							<p class="float-right">
							Amigos&nbsp;&nbsp;&nbsp;&nbsp;
							</p>
							</div>
							<div class="bulletin">
							</div>';
						}
						$count++;
					}
				}
				
			}
			
			//echo $visto;
			
			if($visto != ""){
				$result1 = $con->pdo->prepare("UPDATE notificacao SET visto = true WHERE ". $visto .";");
				$result1->execute();
			}
			
			return $notify;
		}
		
	}
?>