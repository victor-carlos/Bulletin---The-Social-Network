<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post" enctype="multipart/form-data" >
						<fieldset>
							<legend>Publication</legend>
							
							<textarea name="post" placeholder="Say something"></textarea>
							
							<br />
							
							<div style="color: red;"><?php echo (isset($_SESSION['erros']))?$_SESSION['erros']:'';?></div>
							
							<br />
								
							<label class="float-right"><p>Background color: </p></label><br />
							<select name="color" class="float-right">
								<option value="white" selected="selected">White</option>
								<option value="blue" >Blue</option>
								<option value="green" >Green</option>
								<option value="orange" >Orange</option>
							</select>
							<input type="submit" style="float-left" class="float-left" name="public_post" value="Publish" />
						</fieldset>
						<fieldset>
							<legend>Attach</legend>
							<span class="btn2" onclick="abrirAba(0);"></span>
							<div class="hide" style="display: none;">
								<p>Photo: <br /><input type="file" name="public_foto" /></p><br /><br />
								<!-- p>Vídeo (file): <br /><input type="file" name="public_video" /></p><br /><br / -->
								<!-- p>Vídeo (YouTube - Incorporate): <br /><input type="text" name="incorporate_video" /></p><br /><br / -->
							</div>
							
						</fieldset><br />
					</form>
					<div style="clear: both;"></div>
				</article>
				
				<?php
					echo $ctrlPublicacao->listPosts($_SESSION['id']);
				?>
				
			</div>
		</section>