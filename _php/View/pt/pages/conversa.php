		<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post" id="conversa" enctype="multipart/form-data" >
						<fieldset>
							<legend>Conversa</legend>
							<textarea name="conversa" placeholder="Diga algo" required="required"></textarea>
						</fieldset>
						<fieldset>
							<legend>Foto</legend>
							<input type="file" name="foto" />
						</fieldset>
						<input type="submit" name="env_conversa" id="env_conversa" value="Enviar" />
						<br /><br />
						<div style="color: red;"><?php echo (isset($_SESSION["erros"]))?$_SESSION["erros"]:""; ?></div>
					</form>
					<div style="clear: both;"></div>
				</article>
				
				<?php 
					$chat = $ctrlConversa->listarConversa(htmlentities($_GET['addr']));
					
					for($i = 0; $i < count($chat); $i++) {
						echo '<article class="content white">
									<div class="identification">
										<img src="'.$ctrlUsuario->fotoPerfil($chat[$i][1]).'" alt="">
										<img src="'.$ctrlUsuario->fotoPerfil($chat[$i][2]).'" alt="">
									</div>
									'.(($chat[$i][1] == $_SESSION['endereco'])?'<a class="float-right" href="index.php?ref=Deletar&addr='.$chat[$i][2].'&id='.$chat[$i][0].'">Deletar</a>':'').'
									<div class="bulletin">
									<textarea>'.$chat[$i][3].'</textarea>
									
									<a>
										<figure>
											'.(($chat[$i][4] != "")?'<img src="'.$chat[$i][4].'" alt="">':'').'
										</figure>
									</a>
									<div style="clear: both;"></div>
								</article>';
					}
				?>
				
							
			</div>
		</section>