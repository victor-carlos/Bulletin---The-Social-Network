<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
	<!-- Robots -->
	<meta name="robots" content="index, follow">
	
	<!-- JQuery -->
	<script src="_js/jquery.js"></script>
	
	<!-- Meta Infos -->
	<meta name="description" content="A new social network for new users." />
	<meta name="author" content="Victor Carlos" />
	<meta http-equiv="content-language" content="<?php echo $lang; ?>">
	<meta name="reply-to" content="victor.carlos1395@gmail.com">
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="keywords" content="social, network, bulletin, post, friend, frienship"/>
	
	<!-- Title -->
	<title><?php echo ((isset($_SESSION['id']))?$ctrlNotificacao->getNotificacoes($_SESSION['id']) != 0:false) ?"(".((isset($_SESSION['id']))?$ctrlNotificacao->getNotificacoes($_SESSION['id']):0).") ".$ref:$ref;?></title>

	<!-- Favicon -->
	<link href="_img/favicon.png" rel="shortcut icon">
	
	<!-- Custom -->
	<link href="_css/style.css" rel="stylesheet" />
	<script src="_js/script.js" ></script>
	<!-- script type="text/javascript">
	var xmlHttp = createXMLHTTPObject();
	function marcar(id) {
		if (xmlHttp == null) {
			alert ("Seu browser não suporta AJAX!");
			return;
		}else{
			xmlHttp.open("POST","index.php",true);
			xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xmlHttp.onreadystatechange = function () {
				if (xmlHttp.readyState == 4){
					xmlHttp.send("check=true&id_post="+id);
					alert('ok');
				}
				
				if (xmlHttp.status != 200 || xmlHttp.status != 304) {
					alert('HTTP error ' + xmlHttp.status);
				}
			}
		}
		
		return false;
	}
	
	
	function createXMLHTTPObject() {
		var xmlhttp;
		if (window.XMLHttpRequest) xmlhttp = new XMLHttpRequest();
		else if(window.ActiveXObject) xmlhttp = new ActiveXObject("MSXML2.XMLHTTP.3.0");
		else throw "AJAX não suportado!";
		return xmlhttp;
	}
</script -->
</head>
</head>