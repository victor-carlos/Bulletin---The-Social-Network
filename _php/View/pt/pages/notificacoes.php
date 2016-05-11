<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post" enctype="multipart/form-data" >
						<fieldset>
							<legend>Notificações</legend>
							
							<?php 
								echo $ctrlNotificacao->listarNotificacoes($_SESSION['id']);
							?>
							
						</fieldset>
					</form>
					<div style="clear: both;"></div>
				</article>
				
			</div>
		</section>