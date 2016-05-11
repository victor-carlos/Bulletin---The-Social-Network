<section class="wrap">
			<div class="container about">
				
				<article class="content white">
					<form class="bulletin" action="" method="post" enctype="multipart/form-data" >
						<fieldset>
							<legend>Search</legend>
							
							<?php
								echo $ctrlUsuario->searchUser(htmlentities($_GET['rq']));
							?>
								
						</fieldset>
				
			</div>
		</section>