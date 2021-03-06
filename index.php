<?php
	/*
	error_reporting(0);
	ini_set("display_errors", 0 );
	*/
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	
	require("_php/Model/Usuario.php");
	require("_php/Model/Comentario.php");
	require("_php/Model/Conversa.php");
	require("_php/Model/Foto.php");
	require("_php/Model/Video.php");
	require("_php/Model/Notificacao.php");
	require("_php/Controller/CtrlUsuario.php");
	require("_php/Controller/CtrlComentario.php");
	require("_php/Controller/CtrlConversa.php");
	require("_php/Controller/CtrlPublicacao.php");
	require("_php/Controller/CtrlFoto.php");
	require("_php/Controller/CtrlNotificacao.php");
	
	session_start();
	$country = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
	if(isset($_GET['lang'])) {
		setcookie('lang', htmlentities($_GET['lang']));
		$lang = htmlentities($_GET['lang']);
		
	}elseif(isset($_COOKIE["lang"])) {
		$lang = $_COOKIE["lang"];
		
	}else {
		$_COOKIE["lang"] = (isset($_COOKIE["lang"]))?$_COOKIE["lang"]:$country[0];
		//$_COOKIE["lang"] = (isset($_COOKIE["lang"]))?$_COOKIE["lang"]:"pt-BR"; //provisório
		$lang = $_COOKIE["lang"];
	}
	
	$ref = (isset($_GET['ref']))?htmlentities($_GET['ref']):"";
	$addr = (isset($_GET['addr']))?htmlentities($_GET['addr']):"";
	//$lang = (isset($_SESSION["lang"]))?$_SESSION["lang"]:$country[0];
	
	//$_COOKIE['lang'] = (isset($_SESSION['lang']))?$_SESSION['lang']:$lang;
	
	$usuario = new Usuario();
	$comentario = new Comentario();
	$conversa = new Conversa();
	$foto = new Foto();
	$video = new Video();
	$pub = new Publicacao();
	$notificacao = new Notificacao();
	$ctrlUsuario = new CtrlUsuario();
	$ctrlComentario = new CtrlComentario();
	$ctrlConversa = new CtrlConversa();
	$ctrlPublicacao = new CtrlPublicacao();
	$ctrlFoto = new CtrlFoto();
	$ctrlNotificacao = new CtrlNotificacao();
	
	$head = "";
	$globalNav = "";
	$footer = "";
	$body = "";
	$text_center = "";
	$_SESSION["lang"] = $lang;
	
	if(!isset($_SESSION['logado'])) {
		$_SESSION['logado'] = false;
		
	}
	
	
	/* Verificação de linguagem */
	if($_SESSION["lang"] == "pt-BR") {
		//pt-BR
		
		$head = "_php/View/pt/head.php";
		$globalNav = "_php/View/pt/global-nav.php";
		$body = "";
		$footer = "_php/View/pt/footer.php";
		
		//Cadastro
		if($ref == "Cadastro") {
			$text_center = "Preencha o formulário abaixo:";
			$body = "_php/View/pt/pages/cad.php";
		
		//Página inicial
		}elseif($ref == "Pagina Inicial") {
			if($_SESSION['logado'] == true) {
				$text_center = ($_SESSION['sexo'] == "Masculino" || $_SESSION['sexo'] == "masculino")?"Bem vindo, ".$_SESSION["nome"]:"Bem vinda, ".$_SESSION["nome"];
				$body = "_php/View/pt/pages/pag-inicial.php";
				
			}else{
				header("location:index.php?lang=".$lang);
			}
		
		//Perfil
		}elseif($ref == "Perfil") {
			if($_SESSION['logado'] == true) {
				$text_center = $ctrlUsuario->nomeSobrenomeNickname(htmlentities($_GET['addr']));
				$body = "_php/View/pt/pages/perfil.php";
				
			}else{
				header("location:index.php?lang=".$lang);
			}
		
		//Pesquisa
		}elseif($ref == "Pesquisa") {
			$text_center = "Resultados para '".(htmlentities($_GET['rq']))."':";
			//echo "<script>alert('ok');</script>";
			$body = "_php/View/pt/pages/pesquisa.php";
			
		//Tela de login
		}elseif(!isset($_GET["ref"]) || $ref == "Bulletin") {
			
			if($_SESSION['logado'] == true){
				header("location:index.php?ref=Pagina Inicial");
				
			}else {
				$text_center = "Bulletin<br /> Sua rede social";
				$ref = "Bulletin";
				$body = "_php/View/pt/pages/main.php";
				
			}
		
		//Configurações
		}elseif(!isset($_GET["ref"]) || $ref == "Configuracoes") {
			
			if($_SESSION['logado'] == true){
				$text_center = "Configurações";
				$body = "_php/View/pt/pages/config.php";
				
			}else {
				$text_center = "Bulletin<br /> Sua rede social";
				$ref = "Bulletin";
				$body = "_php/View/pt/pages/main.php";
				
			}
		
		//Notificações
		}elseif(!isset($_GET["ref"]) || $ref == "Notificacoes") {
			
			if($_SESSION['logado'] == true){
				$text_center = "Notificações";
				$body = "_php/View/pt/pages/notificacoes.php";
				
			}else {
				$text_center = "Bulletin<br /> Sua rede social";
				$ref = "Bulletin";
				$body = "_php/View/pt/pages/main.php";
				
			}
		
		//Boletim
		}elseif(!isset($_GET["ref"]) || $ref == "Boletim") {
			
			if($_SESSION['logado'] == true){
				$text_center = ((isset($_GET['boletim']))?"Boletim":"Boletins") . " de '".((isset($_GET['boletim']))?($ctrlPublicacao->retornaNomeUsuario(htmlentities($_GET['boletim']))):($ctrlPublicacao->getNomeUsuario(htmlentities($_GET['addr']))))."':";
				$body = "_php/View/pt/pages/boletim.php";
				
			}else {
				$text_center = "Bulletin<br /> Sua rede social";
				$ref = "Bulletin";
				$body = "_php/View/pt/pages/main.php";
				
			}
		
		//Confirmação de Inscrição
		}elseif(!isset($_GET["ref"]) || $ref == "Confirmacao") {
			$text_center = "Verifique sua caixa de email (veja em Spam também) o link de confirmação.";
			
		//Conversa
		}elseif(!isset($_GET["ref"]) || $ref == "Conversa") {
			$text_center = "Conversa de <br />" . $_SESSION['nome'] . " " . $_SESSION['sobrenome'] . " e " . $ctrlPublicacao->getNomeUsuario(htmlentities($_GET['addr']));
			$body = "_php/View/pt/pages/conversa.php";
			
		//Mensagens
		}elseif(!isset($_GET["ref"]) || $ref == "Mensagens") {
			$text_center = "Caixa de Mensagem";
			$body = "_php/View/pt/pages/mensagens.php";
			
		//Deletar Mensagem
		}elseif($ref == "Deletar") {
			$ctrlConversa->apagarMensagem(htmlentities($_GET['id']));
			echo "<script>window.location.assign('index.php?ref=Conversa&addr=".$_GET['addr']."')</script>";
		//Sair
		}elseif($ref == "Sair") {
			
			/* unsets */
			unset($_SESSION['id']);
			unset($_SESSION['nome']);
			unset($_SESSION['sobrenome']);
			unset($_SESSION['nickname']);
			unset($_SESSION['data_nasc']);
			unset($_SESSION['email']);
			unset($_SESSION['endereco']);
			unset($_SESSION['sexo']);
			unset($_SESSION['senha']);
			unset($_SESSION['interesses']);
			unset($_SESSION['sobre']);
			unset($_SESSION['foto_perfil']);
			unset($_SESSION['foto_capa']);
			unset($_SESSION['linguagem']);
			unset($_SESSION['pais']);
			unset($_SESSION['logado']);
			
			$text_center = "Sair";
			$_SESSION['logado'] = false;
			$_SESSION['foto_capa'] = "_img/bg.jpg";
			
			header("location:index.php?lang=".$lang);
			
		}else{
			$text_center = "Erro 404<br />Página não encontrada";
			$body = "_php/View/pt/pages/404.php";
			
		}
		
	}else{
		/* en-US */
		
		$head = "_php/View/en/head.php";
		$globalNav = "_php/View/en/global-nav.php";
		$body = "";
		$footer = "_php/View/en/footer.php";
		
		//Register
		if($ref == "Register") {
			$text_center = "Complete the form below:";
			$body = "_php/View/en/pages/cad.php";
		
		//Home Page
		}elseif($ref == "Home Page") {
			if($_SESSION['logado'] == true) {
				$text_center = "Welcome, ".$_SESSION["nome"];
				$body = "_php/View/en/pages/pag-inicial.php";
				
			}else{
				header("location:index.php?lang=".$lang);
			}
		
		//Profile
		}elseif($ref == "Profile") {
			if($_SESSION['logado'] == true) {
				$text_center = $ctrlUsuario->nomeSobrenomeNickname(htmlentities($_GET['addr']));
				$body = "_php/View/en/pages/profile.php";
				
			}else{
				header("location:index.php?lang=".$lang);
			}
		
		//Search
		}elseif($ref == "Search") {
			$text_center = "Results for '".(htmlentities($_GET['rq']))."':";
			//echo "<script>alert('ok');</script>";
			$body = "_php/View/en/pages/search.php";
			
		//Login Panel
		// Bug miseravel!!! >:(
		}elseif(!isset($_GET["ref"]) || $ref == "Boletim") {
			
			if($_SESSION['logado'] == true){
				header("location:index.php?ref=Pagina Inicial");
				
			}else {
				$text_center = "Bulletin<br /> Your social network";
				$ref = "Bulletin";
				$body = "_php/View/en/pages/main.php";
				
			}
		
		//Settings
		}elseif(!isset($_GET["ref"]) || $ref == "Settings") {
			
			if($_SESSION['logado'] == true){
				$text_center = "Settings";
				$body = "_php/View/en/pages/settings.php";
				
			}else {
				$text_center = "Bulletin<br /> Your social network";
				$ref = "Bulletin";
				$body = "_php/View/en/pages/main.php";
				
			}
		
		//Notifications
		}elseif(!isset($_GET["ref"]) || $ref == "Notifications") {
			
			if($_SESSION['logado'] == true){
				$text_center = "Notifications";
				$body = "_php/View/en/pages/notifications.php";
				
			}else {
				$text_center = "Bulletin<br /> Your social network";
				$ref = "Bulletin";
				$body = "_php/View/en/pages/main.php";
				
			}
		
		//Bulletin
		}elseif(!isset($_GET["ref"]) || $ref == "Bulletin") {
			
			if($_SESSION['logado'] == true){
				$text_center = ((isset($_GET['bulletin']))?"Bulletin":"Bulletins") . " of '".((isset($_GET['bulletin']))?($ctrlPublicacao->retornaNomeUsuario(htmlentities($_GET['bulletin']))):($ctrlPublicacao->getNomeUsuario(htmlentities($_GET['addr']))))."':";
				$body = "_php/View/en/pages/bulletin.php";
				
			}else {
				$text_center = "Bulletin<br /> Your social network";
				$ref = "Bulletin";
				$body = "_php/View/en/pages/main.php";
				
			}
		
		//Registration Confirmation
		}elseif(!isset($_GET["ref"]) || $ref == "Confirmation") {
			$text_center = "Check your email box (see Spam also) the confirmation link.";
			
		//Chat
		}elseif(!isset($_GET["ref"]) || $ref == "Conversa") {
			$text_center = "Chat <br />" . $_SESSION['nome'] . " " . $_SESSION['sobrenome'] . " and " . $ctrlPublicacao->getNomeUsuario(htmlentities($_GET['addr']));
			
		//Exit
		}elseif($ref == "Exit") {
			
			/* unsets */
			unset($_SESSION['id']);
			unset($_SESSION['nome']);
			unset($_SESSION['sobrenome']);
			unset($_SESSION['nickname']);
			unset($_SESSION['data_nasc']);
			unset($_SESSION['email']);
			unset($_SESSION['endereco']);
			unset($_SESSION['sexo']);
			unset($_SESSION['senha']);
			unset($_SESSION['interesses']);
			unset($_SESSION['sobre']);
			unset($_SESSION['foto_perfil']);
			unset($_SESSION['foto_capa']);
			unset($_SESSION['linguagem']);
			unset($_SESSION['pais']);
			unset($_SESSION['logado']);
			
			$text_center = "Exit";
			$_SESSION['logado'] = false;
			$_SESSION['foto_capa'] = "_img/bg.jpg";
			
			header("location:index.php?lang=".$lang);
			
		}else{
			$text_center = "Error 404<br />Not found";
			$body = "_php/View/en/pages/404.php";
			
		}
		
	}
	
	/* Envio de Mensagem */
	if(isset($_POST['env_conversa'])) {
		$conversa->setMensagem($_POST['conversa']);
		$foto = false;
		
		if(isset($_FILES['foto']['name'])) {
			$nomeFoto = explode(".",$_FILES['foto']['name']);
			$ctFoto = count($nomeFoto);
			$extNomeFoto = $nomeFoto[($ctFoto - 1)];
			$foto = ($extNomeFoto != "")?true:false;
		}
		
		if($foto) {
			if($extNomeFoto == "jpg" || $extNomeFoto == "png"){
				$numTeste = 0;
				$nome = date("Y").date("m").date("d").date("H").date("i").date("s");
				
				$nomeTeste = $nome;
				
				while(file_exists("_img/chat/".$nomeTeste.'.'.$extNomeFoto)) {
					$nomeTeste = $nome.'_'.$numTeste;
					$numTeste++;
					
				}
				
				if(move_uploaded_file($_FILES['foto']['tmp_name'], "_img/chat/".$nomeTeste.'.'.$extNomeFoto)) {
					$foto_chat = "_img/chat/".$nomeTeste.'.'.$extNomeFoto;
					
					$ctrlConversa->enviarMensagem($conversa->getMensagem(), htmlentities($_GET['addr']), $foto_chat);
					$_SESSION['erros'] = "";
				}
				
			}else {
				if($lang == "pt-BR"){
					$_SESSION['erros'] = "Imágem Inválida";
				}else {
					$_SESSION['erros'] = "Invalid Image";
				}
			}
			
		}else {
			$ctrlConversa->enviarMensagem($conversa->getMensagem(), htmlentities($_GET['addr']), $foto);
			$_SESSION['erros'] = "";
			
		}
		
		echo "<script>window.location.assign('index.php?ref=Conversa&addr=".$_GET['addr']."')</script>";
	}
	
	/* Solicitação de amizade */
	if(isset($_POST['solicita_amizade'])) {
		
		if($ctrlUsuario->solicitarAmizade(htmlentities($_POST['addr']), $_SESSION['id'])) {
			//pt-BR
			if($_SESSION["lang"] == "pt-BR") {
				//echo "<script>alert('Sucesso!')</script>";
				echo "";
			}
		}
	}
	
	/* Comentario */
	if(isset($_POST['comment'])) {
		if($ctrlComentario->comentar(htmlentities($_POST['comentario']), $_SESSION['id'], htmlentities($_POST['id_post']), $_SESSION['foto_perfil'], $_SESSION['nome'], $_SESSION['sobrenome'], $_SESSION['endereco'])) {
			header("location:index.php");
		}
	}
	
	/* Remoção de solicitação */
	if(isset($_POST['remove_solicitacao'])) {
		
		if($ctrlUsuario->desfazerSolicitacao(htmlentities($_POST['addr']), $_SESSION['id'])) {
			//pt-BR
			if($_SESSION["lang"] == "pt-BR") {
				echo "";
			}
		}
		
	}
	
	/* Aprovação de amizade */
	if(isset($_POST['aprovar_amizade'])) {
		if($ctrlUsuario->aprovarAmizade($_SESSION['endereco'], (isset($_GET['addr'])?htmlentities($_GET['addr']):htmlentities($_POST['addr'])))) {
			echo "";
		}
	}
	
	/* Chamada para as páginas fatiadas */
	require_once($head);
	require_once($globalNav);
	require_once($body);
	
	/* Login */
	if(isset($_POST["login"])){
		$_SESSION["erros"] = "";
		if($usuario->setEmail(htmlentities($_POST["email"])) && $usuario->setSenha(htmlentities($_POST["passwd"]))) {
			$id = $ctrlUsuario->logar($usuario->getEmail(), MD5(htmlentities($_POST["passwd"])));
			
			if($id > 0){
				$perfil = $ctrlUsuario->getPerfil($id);
				
				$_SESSION['id'] = $perfil[0];
				$_SESSION['nome'] = $perfil[1];
				$_SESSION['sobrenome'] = $perfil[2];
				$_SESSION['nickname'] = $perfil[3];
				$_SESSION['data_nasc'] = $perfil[4];
				$_SESSION['email'] = $perfil[5];
				$_SESSION['endereco'] = $perfil[6];
				$_SESSION['sexo'] = $perfil[7];
				$_SESSION['senha'] = $perfil[8];
				$_SESSION['interesses'] = $perfil[9];
				$_SESSION['sobre'] = $perfil[10];
				$_SESSION['foto_perfil'] = $perfil[11];
				$_SESSION['foto_capa'] = $perfil[12];
				$_SESSION['linguagem'] = $perfil[13];
				$_COOKIE['linguagem'] = $perfil[13];
				$_SESSION['pais'] = $perfil[14];
				$_SESSION['estado'] = $perfil[15];
				$_SESSION['logado'] = true;
				
				if($_SESSION["lang"] == "pt-BR"){
					echo "<script>window.location.assign('index.php?ref=Pagina Inicial')</script>";
					
				}else {
					echo "<script>window.location.assign('index.php?ref=Home Page')</script>";
					
				}
				
			}else {
				if($_SESSION["lang"] == "pt-BR"){
					$_SESSION["erros"] = "Login Inválido";
					
				}else {
					$_SESSION["erros"] = "Invalid Login";
					
				}
				
				echo "<script>window.location.assign('index.php')</script>";
			}
			
		}else {
			if($_SESSION["lang"] == "pt-BR"){
				$_SESSION["erros"] = "Login Inválido";
				
			}else {
				$_SESSION["erros"] = "Invalid Login";
			}
			
			echo "<script>window.location.assign('index.php')</script>";
		}
	}
	
	/* Marcar 1 */
	if(isset($_POST['check'])) {
		$id_post = isset($_POST['id_post'])?htmlentities($_POST['id_post']):false;
		
		if(!is_bool($id_post)) {
			//echo "<script>alert('$id_post')</script>";
			//echo $ctrlPublicacao->marcarPub($id_post, $_SESSION['id']);
			if($ctrlPublicacao->marcarPub($id_post, $_SESSION['id'])) {
				echo "";
			}
		}
		
		//header("location:index.php?ref=Pagina Inicial");
	}
	
	/* Atualizar Dados Pessoais */
	if(isset($_POST['atualiza-dados-pessoais'])) {
		$usuario->setNome(htmlentities($_POST['nome']));
		$usuario->setSobrenome(htmlentities($_POST['sobrenome']));
		$usuario->setNickname(htmlentities($_POST['nickname']));
		$usuario->setPais(htmlentities($_POST['pais']));
		$usuario->setEstado(htmlentities($_POST['estado']));
		$usuario->setDtNasc(htmlentities($_POST['data-nasc']));
		$usuario->setSexo(htmlentities($_POST['sexo']));
		$usuario->setInteresses((isset($_POST['network']))?"Network; ":"");
		$usuario->setInteresses((isset($_POST['amizade']))? $usuario->getInteresses() . "Amizade; ": $usuario->getInteresses() . "");
		$usuario->setInteresses((isset($_POST['relacionamento']))? $usuario->getInteresses() . "Um relacionamento; ": $usuario->getInteresses() . "");
		$usuario->setInteresses((isset($_POST['namoro']))? $usuario->getInteresses() . "Namoro; ": $usuario->getInteresses() . "");
		$usuario->setLinguagem($_POST['linguagem']);
		
		$ctrlUsuario->atualizaDadosPessoais($usuario->getNome(), $usuario->getSobrenome(), $usuario->getNickname(), $usuario->getPais(), $usuario->getEstado(), $usuario->getDtNasc('Y-m-d'), $usuario->getSexo(), $usuario->getInteresses(), $usuario->getLinguagem());
		$_SESSION['erros'] = "";
		header("location:index.php?ref=Configuracoes");
	}
	
	/* Atualizar Sobre */
	if(isset($_POST['atualizar-sobre'])){
		$usuario->setSobre(htmlentities($_POST['sobre']));
		$_SESSION['erros'] = "";
		$ctrlUsuario->atualizarSobre($usuario->getSobre());
		
		header("location:index.php?ref=Configuracoes");
	}
	
	/* Atualizar Autenticação */
	if(isset($_POST['atualizar-auth'])){
		$usuario->setSenha(($_POST['password1'] == $_POST['password2'])?htmlentities($_POST['password1']):'');
		$antigaSenha = htmlentities($_POST['antigo-password']);
		
		if($_POST['password1'] == $_POST['password2']){
			$ctrlUsuario->atualizarAuth($usuario->getSenha(), MD5($antigaSenha));
			$_SESSION['erros'] = "";
			header("location:index.php?ref=Configuracoes");
		}else {
			$_SESSION['erros'] = "Senha Inválida";
		}
	}
	
	/* Atualizar Foto Perfil */
	if(isset($_POST['atualizar-foto-perfil'])){
		$nomeFotoPerfil = explode(".",$_FILES['foto_perfil']['name']);
		$ctFotoPerfil = count($nomeFotoPerfil);
		$extNomeFotoPerfil = $nomeFotoPerfil[($ctFotoPerfil - 1)];
		
		if($extNomeFotoPerfil == "jpg" || $extNomeFotoPerfil == "png"){
			$numTeste = 0;
			$nome = date("Y").date("m").date("d").date("H").date("i").date("s");
			
			$nomeTeste = $nome;
			
			while(file_exists("_img/perfil/".$nomeTeste.'.'.$extNomeFotoPerfil)) {
				$nomeTeste = $nome.'_'.$numTeste;
				$numTeste++;
				
			}
			
			if(move_uploaded_file($_FILES['foto_perfil']['tmp_name'], "_img/perfil/".$nomeTeste.'.'.$extNomeFotoPerfil)) {
				$foto_perfil = "_img/perfil/".$nomeTeste.'.'.$extNomeFotoPerfil;
				unlink($_SESSION['foto_perfil']);
				$_SESSION['foto_perfil'] = $foto_perfil;
				
				$ctrlUsuario->atualizarFotoPerfil($foto_perfil);
				
				header("location:index.php?ref=Configuracoes");
			}
			
		}else {
			$_SESSION['erros'] = "Falha de Upload.";
		}
	}
	
	/* Atualizar Foto Capa */
	if(isset($_POST['atualizar-foto-capa'])){
		$nomeFotoCapa = explode(".",$_FILES['foto_capa']['name']);
		$ctFotoCapa = count($nomeFotoCapa);
		$extNomeFotoCapa = $nomeFotoCapa[($ctFotoCapa - 1)];
		
		if($extNomeFotoCapa == "jpg" || $extNomeFotoCapa == "png"){
			$numTeste = 0;
			$nome = date("Y").date("m").date("d").date("H").date("i").date("s");
			
			$nomeTeste = $nome;
			
			while(file_exists("_img/background/".$nomeTeste.'.'.$extNomeFotoCapa)) {
				$nomeTeste = $nome.'_'.$numTeste;
				$numTeste++;
				
			}
			
			if(move_uploaded_file($_FILES['foto_capa']['tmp_name'], "_img/background/".$nomeTeste.'.'.$extNomeFotoCapa)) {
				$foto_capa = "_img/background/".$nomeTeste.'.'.$extNomeFotoCapa;
				unlink($_SESSION['foto_capa']);
				$_SESSION['foto_capa'] = $foto_capa;
				
				$ctrlUsuario->atualizarFotoCapa($foto_capa);
				
				header("location:index.php?ref=Configuracoes");
			}
			
		}else {
			$_SESSION['erros'] = "Falha de Upload.";
		}
	}
	
	/* Publicação de Post*/
	if(isset($_POST['public_post'])) {
		$pub->setTexto(htmlentities($_POST['post']));
		$pub->setCor(htmlentities($_POST['color']));
		$public_foto = (isset($_FILES['public_foto']['name']))?$_FILES['public_foto']['name']:'';
		
		$name_public_foto = explode(".", $public_foto);
		
		$ct_public_foto = count($name_public_foto);
		
		//echo "<script>alert('" . $pub->getTexto() . "')</script>";
		
		//echo "<script>alert('".$ct_public_video."');</script>";
		
		//Texto com foto
		if($ct_public_foto != 1){
			$ext_public_foto = $name_public_foto[($ct_public_foto - 1)];
			
			$nome = date("Y").date("m").date("d").date("H").date("i").date("s");
			
			$numTeste = 0;
			$nomeTeste = $nome;
			
			while(file_exists("_img/pub/".$nomeTeste.'.'.$ext_public_foto)) {
				$nomeTeste = $nome.'_'.$numTeste;
				$numTeste++;
			}
			
			$nome_foto = "_img/pub/".$nomeTeste.'.'.$ext_public_foto;
			
			if(move_uploaded_file($_FILES['public_foto']['tmp_name'], $nome_foto)) {
				if($ctrlPublicacao->publicarTextoFoto($_SESSION['id'], ("<p>".$pub->getTexto()."</p>"), $pub->getCor(), $nome_foto)) {
				
				}else {
					$_SESSION['erros'] = "Falha de publicação";
					
				}
				
			}else {
				$_SESSION['erros'] = "Falha de upload";
				
			}
		
		
		//Texto com vídeo do YouTube ou somente texto
		}elseif($pub->getTexto() != "") {
			
			$video = explode("v=", $pub->getTexto());
			$video = explode("&", $video[1]);
			
			if(count($video) > 1){
				$pub->setTexto('<textarea disabled="">'.($pub->getTexto()) . '</textarea><br /><iframe src="https://www.youtube.com/embed/'.$video[0].'" frameborder="0" allowfullscreen></iframe>');
				
				if($ctrlPublicacao->publicarTexto($_SESSION['id'], $pub->getTexto(), $pub->getCor())) {
					
						$_SESSION['erros'] = "";
						
					}else {
						$_SESSION['erros'] = "Falha de publicação";
						
				}
			}else {
				if($ctrlPublicacao->publicarTexto($_SESSION['id'], ('<textarea disabled="">'.$pub->getTexto()."</textarea>"), $pub->getCor())) {
					
						$_SESSION['erros'] = "";
						
					}else {
						$_SESSION['erros'] = "Falha de publicação";
						
				}
			}
			
			
				
		}else {
			if($_SESSION["lang"] == "pt-BR"){
				$_SESSION['erros'] = "Dados inválidos";
				
			}else{
				$_SESSION['erros'] = "Invalid Data";
				
			}
		}
		
		echo "<script>window.location.assign('index.php')</script>";
	}
	
	/* Remove publicação */
	if(isset($_POST['remove_publicacao'])){
		//echo "<script>alert('".$_POST['id_post']."')</script>";
		if($ctrlPublicacao->deletarPost(htmlentities($_POST['id_post']))) {
			echo "<script>window.location.assign('index.php')</script>";
		}
	}
	
	/* Cadastro preliminar pt-BR */
	if(isset($_POST["cadastro"])){
		
		echo $_POST["data-nasc"];
		
		if($usuario->setNome($_POST["nome"]) && $usuario->setSobrenome(htmlentities($_POST["sobrenome"])) && $usuario->setDtNasc(htmlentities($_POST["data-nasc"]))) {
			$_SESSION["erros"] = "";
			
			$_SESSION['nome'] = $usuario->getNome();
			$_SESSION['sobrenome'] = $usuario->getSobrenome();
			$_SESSION['data_nasc'] = $_POST["data-nasc"];
			
			header("location:index.php?ref=Cadastro");
			
		}else {
			$_SESSION["erros"] = "Dados Inválidos";
			header("location:index.php?lang=".$lang);
			
		}
	}
	
	/* validação de perfil */
	if(isset($_GET['validation'])){
		if($ctrlUsuario->confirmarUsuario(htmlentities($_GET['validation']))) {
			if($lang == "pt-BR"){
				echo "<script>alert('Agora faça login na página inicial'); window.location.assign('index.php');</script>";
			}else {
				echo "<script>alert('Now log on the home page'); window.location.assign('index.php');</script>";
			}
		}else {
			echo "<script>alert('Validation failure. Try again.'); window.location.assign('index.php');</script>";
		}
	}
	
	/* Cadastro preliminar en-US */
	if(isset($_POST["signUp"])){
		if($usuario->setNome(htmlentities($_POST["nome"])) && $usuario->setSobrenome(htmlentities($_POST["sobrenome"])) && $usuario->setDtNasc(htmlentities($_POST["data-nasc"]))) {
			$_SESSION["erros"] = "";
			
			$_SESSION['nome'] = $usuario->getNome();
			$_SESSION['sobrenome'] = $usuario->getSobrenome();
			$_SESSION['data_nasc'] = $_POST["data-nasc"];
			
			header("location:index.php?ref=Register");
			
		}else {
			$_SESSION["erros"] = "Invalid Data";
			header("location:index.php?lang=".$lang);
			
		}
	}
	
	/* CRIANDO PERFIL */
	if(isset($_POST["criar_perfil"]) || isset($_POST["create_profile"])){
		if($usuario->setNome(htmlentities($_POST["nome"])) && $usuario->setSobrenome(htmlentities($_POST["sobrenome"])) && $usuario->setDtNasc(htmlentities($_POST["data-nasc"]), $country[0]) && $usuario->setLinguagem(htmlentities($_POST["linguagem"]))) {
			$_SESSION['nome'] = $usuario->getNome();
			$_SESSION['sobrenome'] = $usuario->getSobrenome();
			$_SESSION['nickname'] = htmlentities($_POST["nickname"]);
			$_SESSION['data_nasc'] = htmlentities($_POST["data-nasc"]);
			$_SESSION['email'] = htmlentities($_POST["email"]);
			$_SESSION['pais'] = htmlentities($_POST["pais"]);
			$_SESSION['estado'] = htmlentities($_POST["estado"]);
			$_SESSION['senha'] = ($_POST["password1"] == $_POST["password2"])?htmlentities($_POST["password1"]):'';
			$_SESSION['sexo'] = htmlentities($_POST["sexo"]);
			
			$_SESSION['interesses'] = (isset($_POST['network']))?"Network; ":"";
			$_SESSION['interesses'] .= (isset($_POST['amizade']))?"Amizade; ":"";
			$_SESSION['interesses'] .= (isset($_POST['relacionamento']))?"Um relacionamento; ":"";
			$_SESSION['interesses'] .= (isset($_POST['namoro']))?"Namoro":"";
			
			$_SESSION['sobre'] = htmlentities($_POST["sobre"]);
			
			$err = false;
			
			$err = $usuario->setEmail($_POST["email"]);
			$err = $usuario->setNickname($_POST["nickname"]);
			$err = $usuario->setPais($_POST["pais"]);
			$err = $usuario->setEstado($_POST["estado"]);
			$err = $usuario->setSenha($_POST["password1"]);
			$err = $usuario->setSexo($_POST["sexo"]);
			$err = $usuario->setInteresses($_SESSION['interesses']);
			$err = $usuario->setSobre($_POST["sobre"]);
			
			$data_nasc = "";
			
			if($usuario->setDtNasc($_SESSION['data_nasc'])){
				$data_nasc = $usuario->getDtNasc('Y-m-d');
			}
			
			$nomeFotoPerfil = explode(".",$_FILES['foto_perfil']['name']);
			$nomeFotoCapa = explode(".",$_FILES['foto_capa']['name']);
			
			$ctFotoPerfil = count($nomeFotoPerfil);
			$ctFotoCapa = count($nomeFotoCapa);
			
			$extNomeFotoPerfil = $nomeFotoPerfil[($ctFotoPerfil - 1)];
			$extNomeFotoCapa = $nomeFotoCapa[($ctFotoPerfil - 1)];
			
			if(!$err && $_POST["password1"] == $_POST["password2"]) {
			
				if($extNomeFotoCapa == "jpg" && $extNomeFotoPerfil == "jpg" && $_SESSION['palavra'] == $_POST['captcha']) {
				
					$numTeste = 0;
					$nome = date("Y").date("m").date("d").date("H").date("i").date("s");
					
					$nomeTeste = $nome;
				
					while(file_exists("_img/perfil/".$nomeTeste.'.'.$extNomeFotoPerfil && file_exists("_img/background/".$nomeTeste.'.'.$extNomeFotoCapa))) {
						$nomeTeste = $nome.'_'.$numTeste;
						$numTeste++;
						
					}
					
					$endereco = $nomeTeste;
					
					if(move_uploaded_file($_FILES['foto_perfil']['tmp_name'], "_img/perfil/".$nomeTeste.'.'.$extNomeFotoPerfil)) {
						
						$foto_perfil = "_img/perfil/".$nomeTeste.'.'.$extNomeFotoPerfil;
						//$_SESSION['foto_perfil'] = $foto_perfil;
				
						
						if(move_uploaded_file($_FILES['foto_capa']['tmp_name'], "_img/background/".$nomeTeste.'.'.$extNomeFotoCapa)) {
							$foto_capa = "_img/background/".$nomeTeste.'.'.$extNomeFotoCapa;
							//$_SESSION['foto_capa'] = $foto_capa;
							
							if($ctrlUsuario->cadastrarUsuario($usuario->getNome(), $usuario->getSobrenome(), $usuario->getNickname(), $data_nasc, $usuario->getEmail(), $endereco, $usuario->getSexo(), $usuario->getSenha(), $usuario->getInteresses(), $usuario->getSobre(), $foto_perfil, $foto_capa, $usuario->getLinguagem(), $usuario->getPais(), $usuario->getEstado())) {
								$_SESSION['erros'] = "";
								
								//if($ctrlUsuario->enviarConfirmacao($usuario->getEmail(), $usuario->getNome(), $usuario->getSobrenome(), $endereco)) {
								if($ctrlUsuario->confirmarUsuario($endereco)) {
									if($_COOKIE['lang'] == "pt-BR"){
										echo "<script>alert('Agora faça login na página inicial.');window.location.assign('index.php');</script>";
									}else {
										echo "<script>alert('Now log on the homepage.');window.location.assign('index.php');</script>";
									}
								}else {
									if($_COOKIE['lang'] == "pt-BR"){
										echo "<script>alert('Erro de Cadastro.');</script>";
									}else {
										echo "<script>alert('Register Error.');</script>";
									}
								}
								
							}else {
								$_SESSION['erros'] = "Cadastro inválido! Verifique os campos";
								echo "<script>alert('Cadastro inválido! Verifique os campos')</script>";
							}
						}else{
							$_SESSION['erros'] = "Falha no upload de foto!";
							echo "<script>alert('Falha no upload de foto!')</script>";
						}
					}else{
						$_SESSION['erros'] = "Falha no upload de foto!";
						echo "<script>alert('Falha no upload de foto!')</script>";
					}
				}else{
					
					if(isset($_POST["create_profile"])){
						if($_SESSION['palavra'] != $_POST['captcha']) {
							$_SESSION["erros"] = "Invalid Captcha";
							echo "<script>alert('Invalid Captcha')</script>";
						}else {
							$_SESSION["erros"] = "Invalid Photo";
							echo "<script>alert('Invalid Photo')</script>";
						}
						header("location:index.php?ref=Register");
						
					}else {
						if($_SESSION['palavra'] != $_POST['captcha']){
							$_SESSION["erros"] = "Captcha invalido";
							echo "<script>alert('Captcha invalido')</script>";
						}else {
							$_SESSION["erros"] = "Foto invalida";
							echo "<script>alert('Foto invalida')</script>";
						}
							header("location:index.php?ref=Cadastro");
							
					}
					
				}
					
			}
		}else {
			if(isset($_POST["create_profile"])){
					$_SESSION["erros"] = "Invalid Data";
					echo "<script>alert('Invalid Data')</script>";
					header("location:index.php?ref=Register");
				}else {
					$_SESSION["erros"] = "Dados Inválidos";
					echo "<script>alert('Dados Inválidos')</script>";
					header("location:index.php?ref=Cadastro");
			}
		}
	}
	
	/* Chamada para as páginas fatiadas (continuacao) */
	require_once($footer);
	
	//$_SESSION["erros"] = "";
?>