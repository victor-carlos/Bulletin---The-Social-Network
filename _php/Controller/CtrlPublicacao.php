<?php
	require("_php/Model/Publicacao.php");
	//require("_php/ClassDAO/Connect.php");
	
	class CtrlPublicacao{
		public function publicarTextoFoto($id_usuario, $post, $cor, $nome_foto) {
			$con = new Connect();
			$con->conectar();
			$id_publicacao;
			$count = 0;
			$id_publicacao = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("INSERT INTO publicacao (cor, texto, id_usuario, nome_foto) VALUES ('$cor', '$post', ".$id_usuario.", '".$nome_foto."');");
				$result->execute();
				
				$result1 = $con->pdo->prepare("SELECT id FROM publicacao WHERE texto = '$post' AND nome_foto = '$nome_foto';");
				$result1->execute();
				
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					$id_publicacao = $linha['id'];
				}
				
				$result2 = $con->pdo->prepare("SELECT estado FROM usuario WHERE id = '$id_usuario';");
				$result2->execute();
				
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)){
					$local = $linha['estado'];
				}
				
				$result3 = $con->pdo->prepare("UPDATE publicacao SET local = '$local';");
				$result3->execute();
				
				$result4 = $con->pdo->prepare("INSERT INTO visto(visto, id_publicacao, id_usuario) VALUES (false, {$id_publicacao}, {$id_usuario});");
				$result4->execute();
				
				return true;
			}else {
				return false;
			}
		}
		
		public function publicarTextoVideo($id_usuario, $post, $cor, $nome_video) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("INSERT INTO publicacao (cor, texto, nome_video, id_usuario) VALUES ('$cor', '$post', '$nome_video', '$id_usuario');");
				$result->execute();
				
				$result1 = $con->pdo->prepare("SELECT id FROM publicacao WHERE texto = '$post' AND nome_foto = '$nome_foto';");
				$result1->execute();
				
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					$id_publicacao = $linha['id'];
				}
				
				$result2 = $con->pdo->prepare("SELECT estado FROM usuario WHERE id = '$id_usuario';");
				$result2->execute();
				
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)){
					$local = $linha['estado'];
				}
				
				$result3 = $con->pdo->prepare("UPDATE publicacao SET local = '$local';");
				$result3->execute();
				
				$result4 = $con->pdo->prepare("INSERT INTO visto(visto, id_publicacao, id_usuario) VALUES (false, {$id_publicacao}, {$id_usuario});");
				$result4->execute();
				
				return true;
			}else {
				return false;
			}
		}
		
		public function publicarTexto($id_usuario, $post, $cor) {
			$con = new Connect();
			$con->conectar();
			$local = "";
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("INSERT INTO publicacao (cor, texto, id_usuario) VALUES ('$cor', '$post', '$id_usuario');");
				$result->execute();
				
				$result1 = $con->pdo->prepare("SELECT id FROM publicacao WHERE texto = '$post' AND nome_foto = '$nome_foto';");
				$result1->execute();
				
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					$id_publicacao = $linha['id'];
				}
				
				$result2 = $con->pdo->prepare("SELECT estado FROM usuario WHERE id = '$id_usuario';");
				$result2->execute();
				
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)){
					$local = $linha['estado'];
				}
				
				$result3 = $con->pdo->prepare("UPDATE publicacao SET local = '$local';");
				$result3->execute();
				
				$result4 = $con->pdo->prepare("INSERT INTO visto(visto, id_publicacao, id_usuario) VALUES (false, {$id_publicacao}, {$id_usuario});");
				$result4->execute();
				
				return true;
			}else {
				return false;
			}
		}
		
		public function deletarPost($id) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("DELETE FROM publicacao WHERE id = {$id};");
				$result->execute();
				
				$result2 = $con->pdo->prepare("DELETE FROM visto WHERE id_publicacao = {$id};");
				$result2->execute();
				
				$result3 = $con->pdo->prepare("DELETE FROM notificacao WHERE id_publicacao = {$id};");
				$result3->execute();
				
				$result4 = $con->pdo->prepare("DELETE FROM comentario WHERE id_publicacao = {$id};");
				$result4->execute();
				
				$result5 = $con->pdo->prepare("DELETE FROM marcacao WHERE id_publicacao = {$id};");
				$result5->execute();
				
			}
			return;
		}
		
		public function marcarPub($id_publicacao, $id_usuario) {
			$con = new Connect();
			$con->conectar();
			$id_marcacao = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id FROM marcacao WHERE id_usuario = {$id_usuario} AND id_publicacao = {$id_publicacao};");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id_marcacao = $linha['id'];
				}
				
				if($id_marcacao > 0) {
					$result1 = $con->pdo->prepare("DELETE FROM marcacao WHERE id_usuario = {$id_usuario} AND id_publicacao = {$id_publicacao};");
					$result1->execute();
					
					$result2 = $con->pdo->prepare("DELETE FROM notificacao WHERE id_usuario = {$id_usuario} AND id_publicacao = {$id_publicacao};");
					$result2->execute();
				}else {
					$result1 = $con->pdo->prepare("INSERT INTO marcacao (marcacao, id_usuario, id_publicacao) VALUES (true, {$id_usuario}, {$id_publicacao})");
					$result1->execute();
					
					$result2 = $con->pdo->prepare("INSERT INTO notificacao (id_usuario, id_publicacao) VALUES ({$id_usuario}, {$id_publicacao})");
					$result2->execute();
				}
				
				return true;
			}else {
				return false;
			}
		}
		
		public function bulletinNaoVistos($id) {
			$con = new Connect();
			$con->conectar();
			$cont = 0;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT visto FROM visto WHERE id_usuario = {$id} AND visto = false ORDER BY id DESC LIMIT 50;");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					if($linha['visto'] == false){
						$cont++;
					}
				}
			}
			return $cont;
		}
		
		public function retornaNomeUsuario($id_post) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id_usuario FROM publicacao WHERE id = {$id_post};");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id_usuario = $linha['id_usuario'];
				}
				
				$result2 = $con->pdo->prepare("SELECT nome, sobrenome FROM usuario WHERE id = {$id_usuario};");
				$result2->execute();
				
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)){
					$nome_usuario = $linha['nome']." ".$linha['sobrenome'];
				}
			}
			return $nome_usuario;
		}
		
		public function getNomeUsuario($addr) {
			$con = new Connect();
			$con->conectar();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT nome, sobrenome FROM usuario WHERE endereco = '$addr';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$nome_usuario = $linha['nome']." ".$linha['sobrenome'];
				}
			}
			return $nome_usuario;
		}
		
		public function retornaIDUsuario($id_post) {
			$con = new Connect();
			$con->conectar();
			$id_usuario;
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id_usuario FROM publicacao WHERE id = {$id_post};");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$id_usuario = $linha['id_usuario'];
				}
			}
			return $id_usuario;
		}
		
		public function listarPost($id_post2) {
			$con = new Connect();
			$con->conectar();
			$count = 0;
			$id_amigo = "";
			$id_foto = "";
			$post = "";
			$foto_perfil = "";
			$nome = "";
			$sobrenome = "";
			$nickname = "";
			$pais = "";
			$estado = "";
			$nome_foto;
			$marcacao = 0;
			$id_post = "";
			$id_marcacao = array();
			
			$ctrlComentario = new CtrlComentario();
			$ctrlUsuario = new CtrlUsuario();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT foto_perfil, nome, sobrenome, nickname, pais, estado FROM usuario WHERE id = '".$_SESSION['id']."';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$foto_perfil = $linha['foto_perfil'];
					$nome = $linha['nome'];
					$sobrenome = $linha['sobrenome'];
					$nickname = $linha['nickname'];
					$pais = $linha['pais'];
					$estado = $linha['estado'];
				}
				
				$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_usuario = ".$_SESSION['id']." AND confirmado = true;");
				$result1->execute();
				
				$count = 0;
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					if($count == 0){
						$id_amigo .= " id_usuario = " . $linha["id_amigo"];
					
					}else {
						$id_amigo .= " OR id_usuario = " . $linha["id_amigo"];
					}
					
					$count++;
				}
				
				if(count(explode("OR", $id_amigo)) == 1){
					$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_amigo = ".$_SESSION['id']." AND confirmado = true;");
					$result1->execute();
					
					$id_amigo = "";
					$count = 0;
					while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
						if($count == 0){
							$id_amigo .= " id_usuario = " . $linha["id_usuario"];
						
						}else {
							$id_amigo .= " OR id_usuario = " . $linha["id_usuario"];
						}
						
						$count++;
					}
				}
				
				$result2 = $con->pdo->query("SELECT id FROM publicacao WHERE " . $id_amigo . ";");
				$result2->execute();
				
				//return $id_amigo;
				
				$cont = 0;
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)) {
					if($cont == 0){
						$id_post = " id_publicacao = " . $linha['id'];// . " AND id_usuario = " . $id;
					}else {
						$id_post .= " OR id_publicacao = " . $linha['id'];// . " AND id_usuario = " . $id;
					}
					$cont++;
				}
				//return $id_post;
				/* Bug dos boletins vazios */
				if($cont != 0) {
					$result3 = $con->pdo->query("SELECT id_publicacao, marcacao FROM marcacao WHERE {$id_post};");
					$result3->execute();
					
					while ($linha = $result3->fetch(PDO::FETCH_ASSOC)){
						$marcacao = ($linha['marcacao'])?1:0;
						$id_marcacao[$linha['id_publicacao']] = (isset($id_marcacao[$linha['id_publicacao']])? $id_marcacao[$linha['id_publicacao']]:0) + $marcacao;
					}
				}
				
				$result4 = $con->pdo->query("SELECT * FROM publicacao WHERE id = {$id_post2};");
				$result4->execute();
				
				$cont = 1;
				
				while ($linha = $result4->fetch(PDO::FETCH_ASSOC)){
					$dados = $ctrlUsuario->getPerfilPost($linha['id_usuario']);
					$post .= '<article class="content '.$linha["cor"].'">
						<div class="identification">
							<form action="" method="post" class="form" id="form" ><!-- onsubmit="return marcar('.$linha['id'].');" -->
								<div class="marcacoes">'.(isset($id_marcacao[$linha["id"]])?$id_marcacao[$linha["id"]]:0).'</div>
								
								<div class="btn6">::</div>
								<div class="blt_window">
									<ul>
										'.(($_SESSION["id"] == $linha["id_usuario"])?"<li><input type='submit' name='remove_publicacao' value='Deletar publicacao'></li>":"").'
										'.(($_SESSION["id"] != $linha["id_usuario"])?"<li><input type='submit' value='Denunciar publicacao'></li>":"").'
									</ul>
								</div>
								
								<input type="hidden" name="id_post" id="id_post" value="'.$linha['id'].'" />
								<input type="submit" name="check" value="" class="marcar1" />
							</form>
							<img src="'.$dados[4].'" alt="">
							<a href="index.php?ref=Perfil&addr='.$dados[3].'" >'.$dados[0].' '.$dados[1].' ('.$dados[2].') <br> '.$linha["data"].' - '.$dados[6].' - '.$dados[5].' </a>
						</div>
						
						<div class="bulletin">
						<p>'.$linha["texto"].'</p>';
						if(strrpos($linha['nome_foto'], "media") > 0) {
					$post .='<video class="video-page" controls="controls">
							<source src="media/video/01.mp4" type="video/mp4" />
							<!--Suportado em IE9, Chrome 6 e Safari 5 --> 
							O seu navegador não suporta a tag vídeo
						</video>
						';}
						
					if(strrpos($linha['nome_foto'], "img") > 0) {
						$post .='<a href="'.$linha["nome_foto"].'" target="_blank" >
							<figure>
								<img src="'.$linha["nome_foto"].'" alt="">
								<figcaption>'.$linha["texto"].'</figcaption>
							</figure>
						</a>
						';}
					
					$cache = $ctrlComentario->listarComentario($linha["id"]);
					$post .='</div>
							<div>
								<form class="bulletin" action="" method="post">
									<fieldset>
										<legend>Comentar</legend>
										<span class="btn4" onclick="abrirAba('.$cont.');"></span>
										<div class="hide" style="display: none;">
											<textarea placeholder="Comente algo" name="comentario"></textarea>
											
											<br />
											<input type="hidden" name="id_post" value="'.$linha['id'].'" />
											<input class="float-right" name="comment" type="submit" value="Comentar" />
										</div>
									</fieldset>
									<fieldset>
										<legend>Comentários '.(($cache[0] == 0)?"":"(".$cache[0].")").': </legend>
										';
					$post .= $cache[1].'
									</fieldset>
								</form>
							</div>
						<div style="clear: both;"></div>
					</article>';
					$cont++;
					$cont++;
					}
				}
				return $post;
		}
		
		public function listPost($id_post2) {
			$con = new Connect();
			$con->conectar();
			$count = 0;
			$id_amigo = "";
			$id_foto = "";
			$post = "";
			$foto_perfil = "";
			$nome = "";
			$sobrenome = "";
			$nickname = "";
			$pais = "";
			$estado = "";
			$nome_foto;
			$marcacao = 0;
			$id_post = "";
			$id_marcacao = array();
			
			$ctrlComentario = new CtrlComentario();
			$ctrlUsuario = new CtrlUsuario();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT foto_perfil, nome, sobrenome, nickname, pais, estado FROM usuario WHERE id = '".$_SESSION['id']."';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$foto_perfil = $linha['foto_perfil'];
					$nome = $linha['nome'];
					$sobrenome = $linha['sobrenome'];
					$nickname = $linha['nickname'];
					$pais = $linha['pais'];
					$estado = $linha['estado'];
				}
				
				$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_usuario = ".$_SESSION['id']." AND confirmado = true;");
				$result1->execute();
				
				$count = 0;
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					if($count == 0){
						$id_amigo .= " id_usuario = " . $linha["id_amigo"];
					
					}else {
						$id_amigo .= " OR id_usuario = " . $linha["id_amigo"];
					}
					
					$count++;
				}
				
				if(count(explode("OR", $id_amigo)) == 1){
					$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_amigo = ".$_SESSION['id']." AND confirmado = true;");
					$result1->execute();
					
					$id_amigo = "";
					$count = 0;
					while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
						if($count == 0){
							$id_amigo .= " id_usuario = " . $linha["id_usuario"];
						
						}else {
							$id_amigo .= " OR id_usuario = " . $linha["id_usuario"];
						}
						
						$count++;
					}
				}
				
				$result2 = $con->pdo->query("SELECT id FROM publicacao WHERE " . $id_amigo . ";");
				$result2->execute();
				
				//return $id_amigo;
				
				$cont = 0;
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)) {
					if($cont == 0){
						$id_post = " id_publicacao = " . $linha['id'];// . " AND id_usuario = " . $id;
					}else {
						$id_post .= " OR id_publicacao = " . $linha['id'];// . " AND id_usuario = " . $id;
					}
					$cont++;
				}
				//return $id_post;
				/* Bug dos boletins vazios */
				if($cont != 0) {
					$result3 = $con->pdo->query("SELECT id_publicacao, marcacao FROM marcacao WHERE {$id_post};");
					$result3->execute();
					
					while ($linha = $result3->fetch(PDO::FETCH_ASSOC)){
						$marcacao = ($linha['marcacao'])?1:0;
						$id_marcacao[$linha['id_publicacao']] = (isset($id_marcacao[$linha['id_publicacao']])? $id_marcacao[$linha['id_publicacao']]:0) + $marcacao;
					}
				}
				
				$result4 = $con->pdo->query("SELECT * FROM publicacao WHERE id = {$id_post2};");
				$result4->execute();
				
				$cont = 1;
				
				while ($linha = $result4->fetch(PDO::FETCH_ASSOC)){
					$dados = $ctrlUsuario->getPerfilPost($linha['id_usuario']);
					$post .= '<article class="content '.$linha["cor"].'">
						<div class="identification">
							<form action="" method="post" class="form" id="form" ><!-- onsubmit="return marcar('.$linha['id'].');" -->
								<div class="marcacoes">'.(isset($id_marcacao[$linha["id"]])?$id_marcacao[$linha["id"]]:0).'</div>
								
								<div class="btn6">::</div>
								<div class="blt_window">
									<ul>
										'.(($_SESSION["id"] == $linha["id_usuario"])?"<li><input type='submit' name='remove_publicacao' value='Delete Publication'></li>":"").'
										'.(($_SESSION["id"] != $linha["id_usuario"])?"<li><input type='submit' value='Report Publication'></li>":"").'
									</ul>
								</div>
								
								<input type="hidden" name="id_post" id="id_post" value="'.$linha['id'].'" />
								<input type="submit" name="check" value="" class="marcar1" />
							</form>
							<img src="'.$dados[4].'" alt="">
							<a href="index.php?ref=Perfil&addr='.$dados[3].'" >'.$dados[0].' '.$dados[1].' ('.$dados[2].') <br> '.$linha["data"].' - '.$dados[6].' - '.$dados[5].' </a>
						</div>
						
						<div class="bulletin">
						<p>'.$linha["texto"].'</p>';
						if(strrpos($linha['nome_foto'], "media") > 0) {
					$post .='<video class="video-page" controls="controls">
							<source src="media/video/01.mp4" type="video/mp4" />
							<!-- Supported in IE9, Chrome 6 and Safari 5 --> 
							Your browser does not support the video tag
						</video>
						';}
						
					if(strrpos($linha['nome_foto'], "img") > 0) {
						$post .='<a href="'.$linha["nome_foto"].'" target="_blank" >
							<figure>
								<img src="'.$linha["nome_foto"].'" alt="">
								<figcaption>'.$linha["texto"].'</figcaption>
							</figure>
						</a>
						';}
					
					$cache = $ctrlComentario->listarComentario($linha["id"]);
					$post .='</div>
							<div>
								<form class="bulletin" action="" method="post">
									<fieldset>
										<legend>Comment</legend>
										<span class="btn4" onclick="abrirAba('.$cont.');"></span>
										<div class="hide" style="display: none;">
											<textarea placeholder="Comente algo" name="comentario"></textarea>
											
											<br />
											<input type="hidden" name="id_post" value="'.$linha['id'].'" />
											<input class="float-right" name="comment" type="submit" value="Comentar" />
										</div>
									</fieldset>
									<fieldset>
										<legend>Comments '.(($cache[0] == 0)?"":"(".$cache[0].")").': </legend>
										';
					$post .= $cache[1].'
									</fieldset>
								</form>
							</div>
						<div style="clear: both;"></div>
					</article>';
					$cont++;
					$cont++;
					}
				}
				return $post;
		}
		
		public function listPosts($id) {
			$con = new Connect();
			$con->conectar();
			$count = 0;
			$id_amigo = "";
			$id_foto = "";
			$posts = "";
			$foto_perfil = "";
			$nome = "";
			$sobrenome = "";
			$nickname = "";
			$pais = "";
			$estado = "";
			$nome_foto;
			$marcacao = 0;
			$id_post = "";
			$id_marcacao = array();
			
			$ctrlComentario = new CtrlComentario();
			$ctrlUsuario = new CtrlUsuario();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT foto_perfil, nome, sobrenome, nickname, pais, estado FROM usuario WHERE id = '".$id."';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$foto_perfil = $linha['foto_perfil'];
					$nome = $linha['nome'];
					$sobrenome = $linha['sobrenome'];
					$nickname = $linha['nickname'];
					$pais = $linha['pais'];
					$estado = $linha['estado'];
				}
				
				$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_usuario = '$id' AND confirmado = true;");
				$result1->execute();
				
				$count = 0;
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					if($count == 0){
						$id_amigo .= " id_usuario = " . $linha["id_amigo"];
					
					}else {
						$id_amigo .= " OR id_usuario = " . $linha["id_amigo"];
					}
					
					$count++;
				}
				
				if(count(explode("OR", $id_amigo)) == 1){
					$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_amigo = '$id' AND confirmado = true;");
					$result1->execute();
					
					$id_amigo = "";
					$count = 0;
					while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
						if($count == 0){
							$id_amigo .= " id_usuario = " . $linha["id_usuario"];
						
						}else {
							$id_amigo .= " OR id_usuario = " . $linha["id_usuario"];
						}
						
						$count++;
					}
				}
				
				$result2 = $con->pdo->query("SELECT id FROM publicacao WHERE " . $id_amigo . " LIMIT 50;");
				$result2->execute();
				
				//return $id_amigo;
				
				$cont = 0;
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)) {
					if($cont == 0){
						$id_post = " id_publicacao = " . $linha['id'];// . " AND id_usuario = " . $id;
					}else {
						$id_post .= " OR id_publicacao = " . $linha['id'];// . " AND id_usuario = " . $id;
					}
					$cont++;
				}
				//return $id_post;
				/* Bug dos boletins vazios */
				if($cont != 0) {
					$result3 = $con->pdo->query("SELECT id_publicacao, marcacao FROM marcacao WHERE {$id_post};");
					$result3->execute();
					
					while ($linha = $result3->fetch(PDO::FETCH_ASSOC)){
						$marcacao = ($linha['marcacao'])?1:0;
						$id_marcacao[$linha['id_publicacao']] = (isset($id_marcacao[$linha['id_publicacao']])? $id_marcacao[$linha['id_publicacao']]:0) + $marcacao;
					}
				}
				
				$result4 = $con->pdo->query("SELECT * FROM publicacao WHERE " . $id_amigo . " ORDER BY publicacao.id DESC;");
				$result4->execute();
				
				$cont = 2;
				
				while ($linha = $result4->fetch(PDO::FETCH_ASSOC)){
					$dados = $ctrlUsuario->getPerfilPost($linha['id_usuario']);
					$posts .= '<article class="content '.$linha["cor"].'">
						<div class="identification">
							<form action="" method="post" class="form" id="form" ><!-- onsubmit="return marcar('.$linha['id'].');" -->
								<div class="marcacoes">'.(isset($id_marcacao[$linha["id"]])?$id_marcacao[$linha["id"]]:0).'</div>
								
								<div class="btn6">::</div>
								<div class="blt_window">
									<ul>
										'.(($_SESSION["id"] == $linha["id_usuario"])?"<li><input type='submit' name='remove_publicacao' value='Delete Publication'></li>":"").'
										'.(($_SESSION["id"] != $linha["id_usuario"])?"<li><input type='submit' value='Report Publication'></li>":"").'
									</ul>
								</div>
								
								<input type="hidden" name="id_post" id="id_post" value="'.$linha['id'].'" />
								<input type="submit" name="check" value="" class="marcar1" />
							</form>
							<img src="'.$dados[4].'" alt="">
							<a href="index.php?ref=Profile&addr='.$dados[3].'" >'.$dados[0].' '.$dados[1].' ('.$dados[2].') <br> '.$linha["data"].' - '.$dados[6].' - '.$dados[5].' </a>
						</div>
						
						<div class="bulletin">
						<p>'.$linha["texto"].'</p>';
						if(strrpos($linha['nome_foto'], "media") > 0) {
					$posts .='<video class="video-page" controls="controls">
							<source src="media/video/01.mp4" type="video/mp4" />
							<!--Supported in IE9, Chrome 6 and Safari 5 --> 
							Your browser does not support the video tag
						</video>
						';}
						
					if(strrpos($linha['nome_foto'], "img") > 0) {
						$posts .='<a href="'.$linha["nome_foto"].'" target="_blank" >
							<figure>
								<img src="'.$linha["nome_foto"].'" alt="">
								<figcaption>'.$linha["texto"].'</figcaption>
							</figure>
						</a>
						';}
					
					$cache = $ctrlComentario->listarComentario($linha["id"]);
					$posts .='</div>
							<div>
								<form class="bulletin" action="" method="post">
									<fieldset>
										<legend>Comment</legend>
										<span class="btn4" onclick="abrirAba('.$cont.');"></span>
										<div class="hide" style="display: none;">
											<textarea placeholder="Comente algo" name="comentario"></textarea>
											
											<br />
											<input type="hidden" name="id_post" value="'.$linha['id'].'" />
											<input class="float-right" name="comment" type="submit" value="Comentar" />
										</div>
									</fieldset>
									<fieldset>
										<legend>Comments '.(($cache[0] == 0)?"":"(".$cache[0].")").': </legend>
										';
					$posts .= $cache[1].'
									</fieldset>
								</form>
							</div>
						<div style="clear: both;"></div>
					</article>';
					$cont++;
					$cont++;
					}
					
					$result5 = $con->pdo->prepare("UPDATE visto SET visto = true WHERE id_usuario = {$id};");
					$result5->execute();
				
				}
				return $posts;
			}
			
			/* INICIO */
			
			public function listarPostsUmUser($addr) {
			$con = new Connect();
			$con->conectar();
			$count = 0;
			$id = 0;
			$id_amigo = "";
			$id_foto = "";
			$post = "";
			$foto_perfil = "";
			$nome = "";
			$sobrenome = "";
			$nickname = "";
			$pais = "";
			$estado = "";
			$nome_foto;
			$marcacao = 0;
			$id_post = "";
			$id_marcacao = array();
			
			$ctrlComentario = new CtrlComentario();
			$ctrlUsuario = new CtrlUsuario();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id, foto_perfil, nome, sobrenome, nickname, pais, estado FROM usuario WHERE endereco = '$addr';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$foto_perfil = $linha['foto_perfil'];
					$nome = $linha['nome'];
					$sobrenome = $linha['sobrenome'];
					$nickname = $linha['nickname'];
					$pais = $linha['pais'];
					$estado = $linha['estado'];
					$id = $linha['id'];
				}
				
				$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_usuario = '$id' AND confirmado = true;");
				$result1->execute();
				
				$count = 0;
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					if($count == 0){
						$id_amigo .= " id_usuario = " . $linha["id_amigo"];
					
					}else {
						$id_amigo .= " OR id_usuario = " . $linha["id_amigo"];
					}
					
					$count++;
				}
				
				$result2 = $con->pdo->query("SELECT id FROM publicacao WHERE " . $id_amigo . " LIMIT 50;");
				$result2->execute();
				
				$cont = 0;
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)) {
					
					if($cont == 0){
						$id_post .= " id_publicacao = " . $linha['id'] . " OR id_usuario = " . $id;
					}else {
						$id_post .= " OR id_publicacao = " . $linha['id'] . " OR id_usuario = " . $id;
					}
					$cont++;
				}
				
				//echo $id_amigo;
				
				/* Bug dos boletins vazios */
				if($cont != 0) {
					$result3 = $con->pdo->query("SELECT id_publicacao, marcacao FROM marcacao WHERE {$id_post};");
					$result3->execute();
					
					while ($linha = $result3->fetch(PDO::FETCH_ASSOC)){
						$marcacao = ($linha['marcacao'])?1:0;
						$id_marcacao[$linha['id_publicacao']] = (isset($id_marcacao[$linha['id_publicacao']])? $id_marcacao[$linha['id_publicacao']]:0) + $marcacao;
						
					}
					
				}
				
				$result4 = $con->pdo->query("SELECT * FROM publicacao WHERE id_usuario = {$id} ORDER BY id DESC;");
				$result4->execute();
				
				$cont = 1;
				
				while ($linha = $result4->fetch(PDO::FETCH_ASSOC)){
					$dados = $ctrlUsuario->getPerfilPost($linha['id_usuario']);
					$post .= '<article class="content '.$linha["cor"].'">
						<div class="identification">
							<form action="" method="post" class="form" id="form" ><!-- onsubmit="return marcar('.$linha['id'].');" -->
								<div class="marcacoes">'.(isset($id_marcacao[$linha["id"]])?$id_marcacao[$linha["id"]]:0).'</div>
								
								<div class="btn6">::</div>
								<div class="blt_window">
									<ul>
										'.(($_SESSION["id"] == $linha["id_usuario"])?"<li><input type='submit' name='remove_publicacao' value='Deletar publicacao'></li>":"").'
										'.(($_SESSION["id"] != $linha["id_usuario"])?"<li><input type='submit' value='Denunciar publicacao'></li>":"").'
									</ul>
								</div>
								
								<input type="hidden" name="id_post" id="id_post" value="'.$linha['id'].'" />
								<input type="submit" name="check" value="" class="marcar1" />
							</form>
							<img src="'.$dados[4].'" alt="">
							<a href="index.php?ref=Perfil&addr='.$dados[3].'" >'.$dados[0].' '.$dados[1].' ('.$dados[2].') <br> '.$linha["data"].' - '.$dados[6].' - '.$dados[5].' </a>
						</div>
						
						<div class="bulletin">
						<p>'.$linha["texto"].'</p>';
						if(strrpos($linha['nome_foto'], "media") > 0) {
					$post .='<video class="video-page" controls="controls">
							<source src="media/video/01.mp4" type="video/mp4" />
							<!--Suportado em IE9, Chrome 6 e Safari 5 --> 
							O seu navegador não suporta a tag vídeo
						</video>
						';}
						
					if(strrpos($linha['nome_foto'], "img") > 0) {
						$post .='<a href="'.$linha["nome_foto"].'" target="_blank" >
							<figure>
								<img src="'.$linha["nome_foto"].'" alt="">
								<figcaption>'.$linha["texto"].'</figcaption>
							</figure>
						</a>
						';}
					
					$cache = $ctrlComentario->listarComentario($linha["id"]);
					$post .='</div>
							<div>
								<form class="bulletin" action="" method="post">
									<fieldset>
										<legend>Comentar</legend>
										<span class="btn4" onclick="abrirAba('.$cont.');"></span>
										<div class="hide" style="display: none;">
											<textarea placeholder="Comente algo" name="comentario"></textarea>
											
											<br />
											<input type="hidden" name="id_post" value="'.$linha['id'].'" />
											<input class="float-right" name="comment" type="submit" value="Comentar" />
										</div>
									</fieldset>
									<fieldset>
										<legend>Comentários '.(($cache[0] == 0)?"":"(".$cache[0].")").': </legend>
										';
					$post .= $cache[1].'
									</fieldset>
								</form>
							</div>
						<div style="clear: both;"></div>
					</article>';
					$cont++;
					$cont++;
					}
				}
				return $post;
		}
			
			/* FIM */
			
			/* Start */
			
			public function listPostsAnUser($addr) {
			$con = new Connect();
			$con->conectar();
			$count = 0;
			$id = 0;
			$id_amigo = "";
			$id_foto = "";
			$post = "";
			$foto_perfil = "";
			$nome = "";
			$sobrenome = "";
			$nickname = "";
			$pais = "";
			$estado = "";
			$nome_foto;
			$marcacao = 0;
			$id_post = "";
			$id_marcacao = array();
			
			$ctrlComentario = new CtrlComentario();
			$ctrlUsuario = new CtrlUsuario();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT id, foto_perfil, nome, sobrenome, nickname, pais, estado FROM usuario WHERE endereco = '$addr';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$foto_perfil = $linha['foto_perfil'];
					$nome = $linha['nome'];
					$sobrenome = $linha['sobrenome'];
					$nickname = $linha['nickname'];
					$pais = $linha['pais'];
					$estado = $linha['estado'];
					$id = $linha['id'];
				}
				
				$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_usuario = '$id' AND confirmado = true;");
				$result1->execute();
				
				$count = 0;
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					if($count == 0){
						$id_amigo .= " id_usuario = " . $linha["id_amigo"];
					
					}else {
						$id_amigo .= " OR id_usuario = " . $linha["id_amigo"];
					}
					
					$count++;
				}
				
				$result2 = $con->pdo->query("SELECT id FROM publicacao WHERE " . $id_amigo . " LIMIT 50;");
				$result2->execute();
				
				$cont = 0;
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)) {
					
					if($cont == 0){
						$id_post .= " id_publicacao = " . $linha['id'] . " OR id_usuario = " . $id;
					}else {
						$id_post .= " OR id_publicacao = " . $linha['id'] . " OR id_usuario = " . $id;
					}
					$cont++;
				}
				
				//echo $id_amigo;
				
				/* Bug dos boletins vazios */
				if($cont != 0) {
					$result3 = $con->pdo->query("SELECT id_publicacao, marcacao FROM marcacao WHERE {$id_post};");
					$result3->execute();
					
					while ($linha = $result3->fetch(PDO::FETCH_ASSOC)){
						$marcacao = ($linha['marcacao'])?1:0;
						$id_marcacao[$linha['id_publicacao']] = (isset($id_marcacao[$linha['id_publicacao']])? $id_marcacao[$linha['id_publicacao']]:0) + $marcacao;
						
					}
					
				}
				
				$result4 = $con->pdo->query("SELECT * FROM publicacao WHERE id_usuario = {$id} ORDER BY id DESC;");
				$result4->execute();
				
				$cont = 1;
				
				while ($linha = $result4->fetch(PDO::FETCH_ASSOC)){
					$dados = $ctrlUsuario->getPerfilPost($linha['id_usuario']);
					$post .= '<article class="content '.$linha["cor"].'">
						<div class="identification">
							<form action="" method="post" class="form" id="form" ><!-- onsubmit="return marcar('.$linha['id'].');" -->
								<div class="marcacoes">'.(isset($id_marcacao[$linha["id"]])?$id_marcacao[$linha["id"]]:0).'</div>
								
								<div class="btn6">::</div>
								<div class="blt_window">
									<ul>
										'.(($_SESSION["id"] == $linha["id_usuario"])?"<li><input type='submit' name='remove_publicacao' value='Delete Publication'></li>":"").'
										'.(($_SESSION["id"] != $linha["id_usuario"])?"<li><input type='submit' value='Report Publication'></li>":"").'
									</ul>
								</div>
								
								<input type="hidden" name="id_post" id="id_post" value="'.$linha['id'].'" />
								<input type="submit" name="check" value="" class="marcar1" />
							</form>
							<img src="'.$dados[4].'" alt="">
							<a href="index.php?ref=Perfil&addr='.$dados[3].'" >'.$dados[0].' '.$dados[1].' ('.$dados[2].') <br> '.$linha["data"].' - '.$dados[6].' - '.$dados[5].' </a>
						</div>
						
						<div class="bulletin">
						<p>'.$linha["texto"].'</p>';
						if(strrpos($linha['nome_foto'], "media") > 0) {
					$post .='<video class="video-page" controls="controls">
							<source src="media/video/01.mp4" type="video/mp4" />
							<!-- Supported in IE9, Chrome 6 and Safari 5 --> 
							Your browser does not support the video tag
						</video>
						';}
						
					if(strrpos($linha['nome_foto'], "img") > 0) {
						$post .='<a href="'.$linha["nome_foto"].'" target="_blank" >
							<figure>
								<img src="'.$linha["nome_foto"].'" alt="">
								<figcaption>'.$linha["texto"].'</figcaption>
							</figure>
						</a>
						';}
					
					$cache = $ctrlComentario->listarComentario($linha["id"]);
					$post .='</div>
							<div>
								<form class="bulletin" action="" method="post">
									<fieldset>
										<legend>Comment</legend>
										<span class="btn4" onclick="abrirAba('.$cont.');"></span>
										<div class="hide" style="display: none;">
											<textarea placeholder="Comente algo" name="comentario"></textarea>
											
											<br />
											<input type="hidden" name="id_post" value="'.$linha['id'].'" />
											<input class="float-right" name="comment" type="submit" value="Comentar" />
										</div>
									</fieldset>
									<fieldset>
										<legend>Comments '.(($cache[0] == 0)?"":"(".$cache[0].")").': </legend>
										';
					$post .= $cache[1].'
									</fieldset>
								</form>
							</div>
						<div style="clear: both;"></div>
					</article>';
					$cont++;
					$cont++;
					}
				}
				return $post;
		}
			
			/* END */
			
			public function listarPosts($id) {
			$con = new Connect();
			$con->conectar();
			$count = 0;
			$id_amigo = "";
			$id_foto = "";
			$posts = "";
			$foto_perfil = "";
			$nome = "";
			$sobrenome = "";
			$nickname = "";
			$pais = "";
			$estado = "";
			$nome_foto;
			$marcacao = 0;
			$id_post = "";
			$id_marcacao = array();
			
			$ctrlComentario = new CtrlComentario();
			$ctrlUsuario = new CtrlUsuario();
			
			if(!is_bool($con->pdo)) {
				$result = $con->pdo->prepare("SELECT foto_perfil, nome, sobrenome, nickname, pais, estado FROM usuario WHERE id = '".$id."';");
				$result->execute();
				
				while ($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$foto_perfil = $linha['foto_perfil'];
					$nome = $linha['nome'];
					$sobrenome = $linha['sobrenome'];
					$nickname = $linha['nickname'];
					$pais = $linha['pais'];
					$estado = $linha['estado'];
				}
				
				$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_usuario = '$id' AND confirmado = true;");
				$result1->execute();
				
				$count = 0;
				while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
					if($count == 0){
						$id_amigo .= " id_usuario = " . $linha["id_amigo"];
					
					}else {
						$id_amigo .= " OR id_usuario = " . $linha["id_amigo"];
					}
					
					$count++;
				}
				
				if(count(explode("OR", $id_amigo)) == 1){
					$result1 = $con->pdo->prepare("SELECT * FROM amigo WHERE id_amigo = '$id' AND confirmado = true;");
					$result1->execute();
					
					$id_amigo = "";
					$count = 0;
					while ($linha = $result1->fetch(PDO::FETCH_ASSOC)){
						if($count == 0){
							$id_amigo .= " id_usuario = " . $linha["id_usuario"];
						
						}else {
							$id_amigo .= " OR id_usuario = " . $linha["id_usuario"];
						}
						
						$count++;
					}
				}
				
				$result2 = $con->pdo->query("SELECT id FROM publicacao WHERE " . $id_amigo . " LIMIT 50;");
				$result2->execute();
				
				//return $id_amigo;
				
				$cont = 0;
				while ($linha = $result2->fetch(PDO::FETCH_ASSOC)) {
					if($cont == 0){
						$id_post = " id_publicacao = " . $linha['id'];// . " AND id_usuario = " . $id;
					}else {
						$id_post .= " OR id_publicacao = " . $linha['id'];// . " AND id_usuario = " . $id;
					}
					$cont++;
				}
				//return $id_post;
				/* Bug dos boletins vazios */
				if($cont != 0) {
					$result3 = $con->pdo->query("SELECT id_publicacao, marcacao FROM marcacao WHERE {$id_post};");
					$result3->execute();
					
					while ($linha = $result3->fetch(PDO::FETCH_ASSOC)){
						$marcacao = ($linha['marcacao'])?1:0;
						$id_marcacao[$linha['id_publicacao']] = (isset($id_marcacao[$linha['id_publicacao']])? $id_marcacao[$linha['id_publicacao']]:0) + $marcacao;
					}
				}
				
				$result4 = $con->pdo->query("SELECT * FROM publicacao WHERE " . $id_amigo . " ORDER BY publicacao.id DESC;");
				$result4->execute();
				
				$cont = 2;
				
				while ($linha = $result4->fetch(PDO::FETCH_ASSOC)){
					$dados = $ctrlUsuario->getPerfilPost($linha['id_usuario']);
					$posts .= '<article class="content '.$linha["cor"].'">
						<div class="identification">
							<form action="" method="post" class="form" id="form" > <!-- onsubmit="return marcar('.$linha['id'].');" -->
								<div class="marcacoes">'.(isset($id_marcacao[$linha["id"]])?$id_marcacao[$linha["id"]]:0).'</div>
								
								<div class="btn6">::</div>
								<div class="blt_window">
									<ul>
										'.(($_SESSION["id"] == $linha["id_usuario"])?"<li><input type='submit' name='remove_publicacao' value='Deletar publicacao'></li>":"").'
										'.(($_SESSION["id"] != $linha["id_usuario"])?"<li><input type='submit' value='Denunciar publicacao'></li>":"").'
									</ul>
								</div>
								
								<input type="hidden" name="id_post" id="id_post" value="'.$linha['id'].'" />
								<input type="submit" name="check" value="" class="marcar1" />
							</form>
							<img src="'.$dados[4].'" alt="">
							<a href="index.php?ref=Perfil&addr='.$dados[3].'" >'.$dados[0].' '.$dados[1].' ('.$dados[2].') <br> '.$linha["data"].' - '.$dados[6].' - '.$dados[5].' </a>
						</div>
						
						<div class="bulletin">
						<p>'.$linha["texto"].'</p>';
						if(strrpos($linha['nome_foto'], "media") > 0) {
					$posts .='<video class="video-page" controls="controls">
							<source src="media/video/01.mp4" type="video/mp4" />
							<!--Suportado em IE9, Chrome 6 e Safari 5 --> 
							O seu navegador não suporta a tag vídeo
						</video>
						';}
						
					if(strrpos($linha['nome_foto'], "img") > 0) {
						$posts .='<a href="'.$linha["nome_foto"].'" target="_blank" >
							<figure>
								<img src="'.$linha["nome_foto"].'" alt="">
								<figcaption>'.$linha["texto"].'</figcaption>
							</figure>
						</a>
						';}
					
					$cache = $ctrlComentario->listarComentario($linha["id"]);
					$posts .='</div>
							<div>
								<form class="bulletin" action="" method="post">
									<fieldset>
										<legend>Comentar</legend>
										<span class="btn4" onclick="abrirAba('.$cont.');"></span>
										<div class="hide" style="display: none;">
											<textarea placeholder="Comente algo" name="comentario"></textarea>
											
											<br />
											<input type="hidden" name="id_post" value="'.$linha['id'].'" />
											<input class="float-right" name="comment" type="submit" value="Comentar" />
										</div>
									</fieldset>
									<fieldset>
										<legend>Comentários '.(($cache[0] == 0)?"":"(".$cache[0].")").': </legend>
										';
					$posts .= $cache[1].'
									</fieldset>
								</form>
							</div>
						<div style="clear: both;"></div>
					</article>';
					$cont++;
					$cont++;
					}
					
					$result5 = $con->pdo->prepare("UPDATE visto SET visto = true WHERE id_usuario = {$id};");
					$result5->execute();
				
				}
				return $posts;
			}
		}
?> 