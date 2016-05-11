<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post" enctype="multipart/form-data" >
						<fieldset>
							<legend>Notifications</legend>
							
							<?php 
								echo $ctrlNotificacao->listNotifications($_SESSION['id']);
							?>
							
						</fieldset>
					</form>
					<div style="clear: both;"></div>
				</article>
				
			</div>
		</section>