<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post" enctype="multipart/form-data" >
						<fieldset>
							<legend>Publicação</legend>
							
							<textarea name="post" placeholder="Fale algo"></textarea>
							
							<div style="color: red;"><?php echo (isset($_SESSION['erros']))?$_SESSION['erros']:''; $_SESSION["erros"] = ""; ?></div>
							
							<br /><br />
								
							<label class="float-right"><p>Cor de Fundo: </p></label><br />
							<select name="color" class="float-right">
								<option value="white" selected="selected">Branco</option>
								<option value="blue" >Azul</option>
								<option value="green" >Verde</option>
								<option value="orange" >Laranja</option>
							</select>
							<input type="submit"  class="float-left" name="public_post" value="Publicar" />		
						</fieldset>
						<fieldset>
							<legend>Anexar</legend>
							<span class="btn2" onclick="abrirAba(0);"></span>
							<div class="hide" style="display: none;">
								<p>Foto: <br /><input type="file" name="public_foto" /></p><br /><br />
								<!-- p>Vídeo (arquivo): <br /><input type="file" name="public_video" /></p><br /><br / -->
								<!-- p>Vídeo (YouTube - Incorporar): <br /><input type="text" name="incorporate_video" /></p><br /><br / -->
							</div>
							
						</fieldset><br />
						
					</form>
					<div style="clear: both;"></div>
				</article>
				
				<?php
					echo $ctrlPublicacao->listarPosts($_SESSION['id']);
				?>
				
			</div>
		</section>