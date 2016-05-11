		<section class="wrap">
			<div class="container about">
				<?php
					if(isset($_GET['boletim'])){
						echo $ctrlPublicacao->listarPost(htmlentities($_GET['boletim']));
					}else{
						echo $ctrlPublicacao->listarPostsUmUser(htmlentities($_GET['addr']));
					}
				?>
			</div>
		</section>