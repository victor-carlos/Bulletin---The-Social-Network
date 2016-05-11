<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post">
						<fieldset>
							<legend>Pesquisa</legend>
							
							<?php
								echo $ctrlUsuario->pesquisarUsuario(htmlentities($_GET['rq']));
							?>
								
						</fieldset>
					</form>
				</article>
			</div>
		</section>