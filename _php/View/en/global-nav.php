	<?php if($_SESSION['logado'] == true) {?>
	<body style="background: url('<?php echo (isset($_GET['addr']))?$ctrlUsuario->fotoCapa($_GET['addr']):$ctrlUsuario->fotoCapa($_SESSION['endereco']);?>') no-repeat;background-size: cover; background-attachment: fixed;">
	<?php }else { ?>
	<body style="background: url('_img/bg.jpg') no-repeat;background-size: cover; background-attachment: fixed;">
			<?php
		}
				if($_SESSION['logado'] == true) {
			?>
			<nav class="global-nav">
			<a href="index.php?ref=Profile&addr=<?php echo (isset($_GET['addr']))?$_GET['addr']:$_SESSION['endereco'];?>" >
				<div id="perfil">
					<img src="<?php echo (isset($_GET['addr']))?$ctrlUsuario->fotoPerfil($_GET['addr']):$ctrlUsuario->fotoPerfil($_SESSION['endereco']);?>" alt="">
					<?php //echo $_SESSION["logado"]; ?>
				</div>
			</a>
			<a href="index.php?ref=Home Page" >
				<div id="bulletim" class="blue">
					<span>b</span><?php echo ($ctrlPublicacao->bulletinNaoVistos($_SESSION['id']) < 50)?(($ctrlPublicacao->bulletinNaoVistos($_SESSION['id']) > 0)?'<div class="red">'.$ctrlPublicacao->bulletinNaoVistos($_SESSION['id']).'</div>':''):'+50'; ?>
				</div>
			</a>
			
			
			<div id="global-menu">
				<div class="bar-menu1"></div>
				<div class="bar-menu2"></div>
				<div class="bar-menu3"></div>
			</div>
				
				
			<div class="global-main-menu">
				<ul>
					<li><form class="search" action="" method="get"><input type="hidden" name="ref" value="Search" /><input type="text" name="rq" id="rq" placeholder="Search"/><input class="btn3" type="submit" value="" /></form></li>
					
					<?php if($ctrlUsuario->isAmigo($_SESSION['endereco'], (isset($_GET['addr']))?$_GET['addr']:"")) {?>
						<?php if($addr != $_SESSION['endereco'] && isset($_GET['addr'])) {?>
							<li><a href="index.php">Talk</a></li>
					<?php }}else {
						if($_GET['ref'] == "Perfil") {
							?><li><a href="index.php">Request friendship</a></li>
					<?php }} ?>
					<li><a href="index.php?ref=Notifications">Notifications<?php echo ($ctrlNotificacao->getNotificacoes($_SESSION['id']) != 0 )?"(".$ctrlNotificacao->getNotificacoes($_SESSION['id']).")":''; ?></a></li>
					<li><a href="index.php?ref=Home Page">Bulletins <?php echo ($ctrlPublicacao->bulletinNaoVistos($_SESSION['id']) != 0 )?"(".$ctrlPublicacao->bulletinNaoVistos($_SESSION['id']).")":''; ?></a></li>
					<li><a href="index.php?ref=Settings">Settings</a></li>
					<li><a href="index.php?ref=Exit">Exit</a></li>
				</ul>
			</div>
				
				<div class="user-name"><?php echo $text_center; ?></div>
				<div id="scrollUp" onclick="$('.global-nav').css('height', '100px');$('.container, #scrollUp, .user-name').css('display', 'none');$('.container').slideDown(500)"></div>
				
		</nav>
			<?php
				}else {
			?>
			<nav class="global-nav">
			<a href="index.php?lang=<?php echo $lang; ?>" >
				<div id="bulletim" class="blue">
					<span>b</span>
				</div>
			</a>
				
				<div class="user-name"><?php echo $text_center; ?></div>
				<div id="scrollUp" onclick="$('.global-nav').css('height', '100px');$('.container, #scrollUp, .user-name').css('display', 'none');$('.container').slideDown(500)"></div>
				
			</nav>
			<?php
				}
			?>
			
		