<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post">
						<fieldset>
							<legend>Presentation</legend>
								<p><?php echo $ctrlUsuario->apresentacao(htmlentities($_GET['addr']))?></p>
						</fieldset>
						<fieldset>
							<legend>Interest</legend>
							<p><?php echo $ctrlUsuario->interesses(htmlentities($_GET['addr']))?></p>
						</fieldset>
						<fieldset>
							<legend>Options</legend>
							<?php if($_SESSION['endereco'] != $_GET['addr']){
								
							 if($ctrlUsuario->isSolicitado($_SESSION['endereco'], htmlentities($_GET['addr']))) {
							 ?>
							<input type="submit" name="remove_solicitacao" value="Remove Request" />
							<?php }elseif($ctrlUsuario->isAmigo($_SESSION['endereco'], htmlentities($_GET['addr']))) { ?>
							
							<input type="submit" name="remove_amizade" value="Undo Friendship" />
							<a class="btn5" href="index.php?ref=Bulletin&addr=<?php echo $_GET['addr']; ?>" />View Bulletins</a><br /><br /><br />
							<input type="submit" name="den_perfil" value="Report Profile" />
							<?php
								if($_SESSION['endereco'] == $_GET['addr']){
							?>
							<a class="btn5" href="index.php?ref=Bulletin&addr=<?php echo $_GET['addr']; ?>">View my Bulletins</a><br /><br /><br />
							<a class="btn5" href="index.php?ref=Configuracoes">Ir para configurações</a><br /><br /><br />
							
							<?php } }else { 
								if($ctrlUsuario->isSolicitado($_SESSION['endereco'], htmlentities($_GET['addr']))) {
							?>
							<p>Aguarde a solicitação.
							<input type="hidden" name="addr" value="<?php echo $_GET['addr']; ?>" />
							<input type="submit" name="den_perfil" value="Report Profile" /></p>
							<?php }else { ?>
							<input type="submit" name="solicita_amizade" value="Request Friendship" />
							
							<input type="hidden" name="addr" value="<?php echo $_GET['addr']; ?>" />
							<input type="submit" name="den_perfil" value="Report Profile" />
							<?php }}}else { ?>
							<a class="btn5" href="index.php?ref=Settings">Go to Settings</a><br /><br /><br />
							<a class="btn5" href="index.php?ref=Bulletin&addr=<?php echo $_GET['addr']; ?>">View my Bulletins</a><br /><br /><br />
							<br /><br />
							<?php } ?>
						</fieldset>
					</form>
					<div style="clear: both;"></div>
				</article>
				<?php if($ctrlUsuario->isAmigo($_SESSION['endereco'], htmlentities($_GET['addr']))) {
					$dados2 = $ctrlUsuario->infoBasico(htmlentities($_GET['addr']));
				?>
				<article class="content white">
					<h1>About</h1>
					<span class="btn1" onclick="abrirAba(1);"></span>
					<div class="show">
						<span>Name: </span><?php echo $dados2[0]; ?><br />
						<span>Surname: </span><?php echo $dados2[1]; ?><br />
						<span>Nickname: </span><?php echo $dados2[2]; ?><br />
						<span>Age: </span><?php echo $ctrlUsuario->idadePessoa(htmlentities($_GET['addr'])); ?><br />
						<span>Gender: </span><?php echo $dados2[3]; ?><br />
						<span>City or province: </span><?php echo $dados2[4]; ?><br />
						<span>Country: </span><?php echo $dados2[5]; ?><br />
						</div>
				</article>
				
				<article class="content green">
					<h1>Friends</h1>
					<span class="btn1" onclick="abrirAba(2);"></span>
					<div style="display: none;" class="hide">
						<div class="box-main">
							
							<?php echo $ctrlUsuario->meusAmigos(htmlentities($_GET['addr'])); ?>
							
						</div>
					</div>
					<div style="clear: both;"></div>
				</article>
				<!-- article class="content blue">
					<h1>Albuns</h1>
					<span class="btn1" onclick="abrirAba(2);"></span>
					<div style="display: none;" class="hide">
					
						<a href="#"><div class="album-photo">
							<figure>
								<img src="img/bg.jpg" alt="">
								<figcaption>
									Album 001
								</figcaption>
							</figure>
						</div></a>
						
						<a href="#"><div class="album-photo">
							<figure>
								<img src="img/bg.jpg" alt="">
								<figcaption>
									Album 001
								</figcaption>
							</figure>
						</div></a>
						
						<a href="#"><div class="album-photo">
							<figure>
								<img src="img/bg.jpg" alt="">
								<figcaption>
									Album 001
								</figcaption>
							</figure>
						</div></a>
						
						<a href="#"><div class="album-photo">
							<figure>
								<img src="img/bg.jpg" alt="">
								<figcaption>
									Album 001
								</figcaption>
							</figure>
						</div></a>
						
						<a href="#"><div class="album-photo">
							<figure>
								<img src="img/bg.jpg" alt="">
								<figcaption>
									Album 001
								</figcaption>
							</figure>
						</div></a>
					</div>
					<div style="clear: both;"></div>
				</article>
				
				<article class="content red">
					<h1>Filmes</h1>
					<span class="btn1" onclick="abrirAba(4);"></span>
					<div style="display: none;" class="hide">
						<div class="box-main">
						
							<a href="#"><figure>
								<img src="img/perfil.jpg" alt="">
								<figcaption>
									Victor Carlos (OverHead)
								</figcaption>
							</figure></a>
							
							<a href="#"><figure>
								<img src="img/perfil.jpg" alt="">
								<figcaption>
									Victor Carlos (OverHead)
								</figcaption>
							</figure></a>
							
						</div>
					</div>
					<div style="clear: both;"></div>
				</article>
				
				<article class="content orange">
					<h1>Acontecimentos</h1>
					<span class="btn1" onclick="abrirAba(5);"></span>
					<div style="display: none;" class="hide">
						<div class="box-main">
						
							<a href="#"><figure>
								<img src="img/perfil.jpg" alt="">
								<figcaption>
									Victor Carlos (OverHead)
								</figcaption>
							</figure></a>
							
							<a href="#"><figure>
								<img src="img/perfil.jpg" alt="">
								<figcaption>
									Victor Carlos (OverHead)
								</figcaption>
							</figure></a>
							
						</div>
					</div>
					<div style="clear: both;"></div>
				</article>
				
				<article class="content white">
					<h1>Academicos</h1>
					<span class="btn1" onclick="abrirAba(6);"></span>
					<div style="display: none;" class="hide">
						<div class="box-main">
						
							<a href="#"><figure>
								<img src="img/perfil.jpg" alt="">
								<figcaption>
									Victor Carlos (OverHead)
								</figcaption>
							</figure></a>
							
							<a href="#"><figure>
								<img src="img/perfil.jpg" alt="">
								<figcaption>
									Victor Carlos (OverHead)
								</figcaption>
							</figure></a>
							
						</div>
					</div>
					<div style="clear: both;"></div>
				</article>
				
				<article class="content blue">
					<h1>Páginas</h1>
					<span class="btn1" onclick="abrirAba(7);"></span>
					<div style="display: none;" class="hide">
						<div class="box-main">
						
							<a href="#"><figure>
								<img src="img/perfil.jpg" alt="">
								<figcaption>
									Victor Carlos (OverHead)
								</figcaption>
							</figure></a>
							
							<a href="#"><figure>
								<img src="img/perfil.jpg" alt="">
								<figcaption>
									Victor Carlos (OverHead)
								</figcaption>
							</figure></a>
							
						</div>
					</div>
					<div style="clear: both;"></div>
				</article -->
				<?php } ?>
			</div>
		</section>